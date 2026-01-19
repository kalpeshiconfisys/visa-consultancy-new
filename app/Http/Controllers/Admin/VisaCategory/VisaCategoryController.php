<?php

namespace App\Http\Controllers\Admin\VisaCategory;

use App\Http\Controllers\Controller;
use App\Models\SubCategoryTableOfContent;
use App\Models\VisaCategory;
use App\Models\VisaSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VisaCategoryController extends Controller
{
    public function index()
    {
        $visaCategories = VisaCategory::latest()->paginate(10);
        return view('admin.visa-category.index', compact('visaCategories'));
    }

    public function create()
    {
        return view('admin.visa-category.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            "main_title" => "required",
            "main_short_description" => "required",
            "main_description" => "required",
            "image" => "required|image|mimes:png,jpg,jpeg,webp",
            "publish_is" => "required"
        ]);

        $input = $request->only("main_title", "main_short_description", "main_description", "publish_is");
        $mainContent = $this->processEditorImages($request->main_description, $request);
        $input = [
            'title' => $request->main_title,
            'short_description' => $request->main_short_description,
            'description' => $mainContent,
            'publish_is' => $request->publish_is
        ];
        $input['date_modified'] = Carbon::now()->toDateTimeString();
        $input['bullets'] = $request->category_bullets ?? [];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/visa-category'), $imgName);
            $input['image'] = $imgName;
        }

        if ($request->hasFile('category_logo')) {
            $file = $request->file('category_logo');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/category_logo'), $imgName);
            $input['category_logo'] = $imgName;
        }
        $VisaCategory  =  VisaCategory::create($input);
        foreach ($request->title as $key => $value) { 
            $content = $this->processEditorImages($request->description[$key], $request);
            SubCategoryTableOfContent::create([
                "visa_sub_category_id" => NULL,
                "category_id"          => $VisaCategory->id,
                "title"                => $request->title[$key],
                "description"          => $content,
                // "bullets"              => is_array($request->bullets[$key] ?? null) && count($request->bullets[$key]) === 1 && $request->bullets[$key][0] === null  ? [] : ($request->bullets[$key] ?? []),
                "bullets"              => [],
                'type'                 => 'category'
            ]);
        }
        return redirect()->route('admin.visa-category.index')->with('success', 'Visa Category Created Successfully');
    }

    public function edit($encodedId)
    {

        $id = base64_decode($encodedId);
        $visaCategory = VisaCategory::with('main_table_of_content')->findOrFail($id);

        return view('admin.visa-category.edit', compact('visaCategory'));
    }

    public function update(Request $request, $encodedId)
    {

        $id = base64_decode($encodedId);
        $request->validate([
            "main_title" => "required",
            "main_short_description" => "required",
            "main_description" => "required",
            "publish_is" => "required"
        ]);
        $visa = VisaCategory::findOrFail($id);
        $mainContent = $this->processEditorImages($request->main_description, $request);
        $input = [
            'title' => $request->main_title,
            'short_description' => $request->main_short_description,
            'description' => $mainContent,
            'publish_is' => $request->publish_is
        ];
        $input['date_modified'] = Carbon::now()->toDateTimeString();
        $input['bullets'] = $request->category_bullets ?? [];
        if ($request->hasFile('image')) {
            if ($visa->image && File::exists(public_path('uploads/visa-category/' . basename($visa->image)))) {
                File::delete(public_path('uploads/visa-category/' . basename($visa->image)));
            }
            $file = $request->file('image');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/visa-category'), $imgName);
            $input['image'] = $imgName;
        }
        if ($request->hasFile('category_logo')) {
            if ($visa->category_logo && File::exists(public_path('uploads/category_logo/' . basename($visa->category_logo)))) {
                File::delete(public_path('uploads/category_logo/' . basename($visa->category_logo)));
            }
            $file = $request->file('category_logo');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/category_logo'), $imgName);
            $input['category_logo'] = $imgName;
        }
        $visa->update($input);
        $existingTocIds = SubCategoryTableOfContent::where('category_id', $id)->pluck('id')->toArray();
        $submittedTocIds = $request->toc_id ?? [];
        $toDelete = array_diff($existingTocIds, $submittedTocIds);

        if (!empty($toDelete)) {
            SubCategoryTableOfContent::whereIn('id', $toDelete)->delete();
        }

        foreach ($request->title as $key => $title) {
            // $content = html_entity_decode($request->description[$key] ?? '');

            // // Find all base64 images inside this description only
            // $pattern = '/<img[^>]+src="data:image\/(jpeg|jpg|png|gif);base64,([^"]+)"[^>]*>/i';
            // preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

            // foreach ($matches as $match) {

            //     $imageFormat = $match[1];   // jpeg / png / gif
            //     $base64Image = $match[2];   // base64 data

            //     // Decode image
            //     $imageData = base64_decode($base64Image);

            //     // Unique file name
            //     $filename = 'image_' . uniqid() . '.' . $imageFormat;

            //     // Save image
            //     $destinationPath = public_path('uploads/content_img');
            //     if (!file_exists($destinationPath)) {
            //         mkdir($destinationPath, 0777, true);
            //     }

            //     file_put_contents($destinationPath . '/' . $filename, $imageData);

            //     // Public URL
            //     // $publicImageUrl = asset('uploads/content_img/' . $filename);

            //     $publicImageUrl = $request->getSchemeAndHttpHost() . '/uploads/content_img/' . $filename;

            //     // Replace only this base64 part inside THIS description
            //     $content = str_replace(
            //         'data:image/' . $imageFormat . ';base64,' . $base64Image,
            //         $publicImageUrl,
            //         $content
            //     );
            // }

            $content = $this->processEditorImages($request->description[$key], $request);

            $tocId = $submittedTocIds[$key] ?? null;

            $data = [
                "category_id"          => $visa->id,
                "title"                => $title,
                "description"          => $content ?? null,
                // "bullets"              => is_array($request->bullets[$key] ?? null) && count($request->bullets[$key]) === 1 && $request->bullets[$key][0] === null  ? [] : ($request->bullets[$key] ?? []),
                "bullets"              => [],
                'type'                 => 'category'
            ];
            if ($tocId) {
                $toc = SubCategoryTableOfContent::find($tocId);
                if ($toc) {
                    $toc->update($data);
                }
            } else {
                SubCategoryTableOfContent::create($data);
            }
        }
        return redirect()->route('admin.visa-category.index')->with('success', 'Visa Category Updated Successfully');
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


    public function destroy($encodedId)
    {
        $id = base64_decode($encodedId);
        $visa = VisaCategory::findOrFail($id);
        if (!empty($visa->image) && File::exists(public_path('uploads/visa-category/' . basename($visa->image)))) {
            File::delete(public_path('uploads/visa-category/' . basename($visa->image)));
        }
        if (!empty($visa->category_logo) && File::exists(public_path('uploads/category_logo/' . basename($visa->category_logo)))) {
            File::delete(public_path('uploads/category_logo/' . basename($visa->category_logo)));
        }
        VisaSubCategory::where('category_id', $visa->id)->delete();
        SubCategoryTableOfContent::where('category_id', $visa->id)->delete();
        $visa->delete();
        return redirect()->route('admin.visa-category.index')->with('success', 'Visa Category Deleted Successfully');
    }

    public function show($encodedId)
    {
        $id = base64_decode($encodedId);
        $visaCategory = VisaCategory::with('main_table_of_content')->findOrFail($id);
        return view('admin.visa-category.show', compact('visaCategory'));
    }
}
