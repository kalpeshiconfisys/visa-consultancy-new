<?php

namespace App\Http\Controllers\Admin\VisaCategory;

use App\Http\Controllers\Controller;
use App\Models\SubCategoryTableOfContent;
use App\Models\VisaCategory;
use App\Models\VisaSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
class VisaSubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = VisaSubCategory::with('category')->latest()->paginate(10);
        return view('admin.visa-sub-category.index', compact('subCategories'));
    }

    public function create()
    {
        $categories = VisaCategory::all();
        return view('admin.visa-sub-category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "category_id"   => "required|exists:visa_categories,id",
            "title"         => "required|array",
            "title.*"       => "required|string|max:255",
            "description"   => "nullable|array",
            "publish_is"    => "required|in:1,2"
        ]);

        $subContent = $this->processEditorImages($request->sub_description, $request);
        $visaSubCategory = VisaSubCategory::create([
            "category_id"   => $request->category_id,
            "title"         => $request->sub_title,
            "description"   => $subContent,
            "publish_is"    => $request->publish_is,
            'content_type'  => $request->content_type  ?? 'both',
            'date_modified' => Carbon::now()->toDateTimeString(),
        ]);

        foreach ($request->title as $key => $value) {
                 $content = $this->processEditorImages($request->description[$key], $request);
            SubCategoryTableOfContent::create([
                "visa_sub_category_id" => $visaSubCategory->id,
                "title"                => $request->title[$key],
                "description"          => $content ?? null,
                // "bullets"              => is_array($request->bullets[$key] ?? null) && count($request->bullets[$key]) === 1 && $request->bullets[$key][0] === null  ? [] : ($request->bullets[$key] ?? []),
                "bullets"              => [],
                'type'                 => 'sub_category'
            ]);
        }

        return redirect()->route('admin.visa-sub-category.index')->with('success', 'Visa Sub Categories Added Successfully');
    }

    public function edit($category_id)
    {
        $id = base64_decode($category_id);
        $categories = VisaCategory::all();
        $subCategories = VisaSubCategory::with('table_of_content')->where('id', $id)->first();
        return view('admin.visa-sub-category.edit', compact('categories', 'subCategories'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            "category_id"   => "required|exists:visa_categories,id",
            "title"         => "required|array",
            "title.*"       => "required|string|max:255",
            "description"   => "nullable|array",
            "publish_is"    => "required|in:1,2",
            // "content_type"  => "required|in:description,bullets,both",
            "toc_id"        => "nullable|array"
        ]);

        $visaSubCategory = VisaSubCategory::findOrFail($id);
        $subContent = $this->processEditorImages($request->sub_description, $request);
        $visaSubCategory->update([
            "category_id"   => $request->category_id,
            "title"         => $request->sub_title,
            "description"   => $subContent,
            "publish_is"    => $request->publish_is,
            "content_type"  => $request->content_type ?? 'both',
            "date_modified" => now(),
        ]);

        $existingTocIds = SubCategoryTableOfContent::where('visa_sub_category_id', $id)->pluck('id')->toArray();
        $submittedTocIds = $request->toc_id ?? [];
        $toDelete = array_diff($existingTocIds, $submittedTocIds);
        if (!empty($toDelete)) {
            SubCategoryTableOfContent::whereIn('id', $toDelete)->delete();
        }
        foreach ($request->title as $key => $title) {
            $content = $this->processEditorImages($request->description[$key], $request);
            $tocId = $submittedTocIds[$key] ?? null;
            $data = [
                "visa_sub_category_id" => $visaSubCategory->id,
                "title"                => $title,
                "description"          => $content ?? null,
                //  "bullets"              => is_array($request->bullets[$key] ?? null) && count($request->bullets[$key]) === 1 && $request->bullets[$key][0] === null  ? [] : ($request->bullets[$key] ?? []),
                "bullets"              => [],
                'type'                 => 'sub_category'
            ];
            if ($request->content_type == 'description') {
                $data['bullets'] = NULL;
            }
            if ($request->content_type == 'bullets') {
                $data['description'] = NULL;
            }
            if ($tocId) {
                $toc = SubCategoryTableOfContent::find($tocId);
                if ($toc) {
                    $toc->update($data);
                }
            } else {
                SubCategoryTableOfContent::create($data);
            }
        }
        return redirect()->route('admin.visa-sub-category.index')->with('success', 'Visa Sub Category Updated Successfully');
    }

     function processEditorImages($html, $request)
    {
        $content = html_entity_decode($html ?? '');

        // Find all base64 images
        $pattern = '/<img[^>]+src="data:image\/([^;]+);base64,([^"]+)"[^>]*>/i';
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {

            $imageFormat = strtolower($match[1]);   // jpeg, png, webp etc
            $base64Image = $match[2];

            // Allow only safe formats
            $allowed = ['jpeg', 'jpg', 'png', 'gif', 'webp'];
            if (!in_array($imageFormat, $allowed)) {
                continue;
            }

            // Decode
            $imageData = base64_decode($base64Image);
            if ($imageData === false) {
                continue;
            }

            // Unique name
            $filename = 'image_' . uniqid() . '.' . $imageFormat;

            // Folder
            $destinationPath = public_path('uploads/content_img');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Save image
            file_put_contents($destinationPath . '/' . $filename, $imageData);

            // Full public URL (API + LIVE SAFE)
            $publicImageUrl = $request->getSchemeAndHttpHost() . '/uploads/content_img/' . $filename;

            // Replace base64 with URL
            $content = str_replace(
                'data:image/' . $imageFormat . ';base64,' . $base64Image,
                $publicImageUrl,
                $content
            );
        }

        return $content;
    }

    public function destroy($id)
    {
        $id = base64_decode($id);
        $sub = VisaSubCategory::findOrFail($id);
        SubCategoryTableOfContent::where('visa_sub_category_id',$sub->id)->delete();
        $sub->delete();
        return redirect()->route('admin.visa-sub-category.index')->with('success', 'Visa Sub Category Deleted Successfully');
    }

    public function show($encodedId)
    {
        $id = base64_decode($encodedId);
        $visaSubCategory = VisaSubCategory::with('table_of_content')->findOrFail($id);

        return view('admin.visa-sub-category.show', compact('visaSubCategory'));
    }
}
