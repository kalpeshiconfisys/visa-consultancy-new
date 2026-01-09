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

        $visaSubCategory = VisaSubCategory::create([
            "category_id"   => $request->category_id,
            "title"         => $request->sub_title,
            "description"   => $request->sub_description,
            "publish_is"    => $request->publish_is,
            'content_type'  => $request->content_type,
            'date_modified' => Carbon::now()->toDateTimeString(),
        ]);

        foreach ($request->title as $key => $value) {
            SubCategoryTableOfContent::create([
                "visa_sub_category_id" => $visaSubCategory->id,
                "title"                => $request->title[$key],
                "description"          => $request->description[$key] ?? null,
                "bullets"              => $request->bullets[$key] ?? [],
                'date_modified'        => Carbon::now()->toDateTimeString(),
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
            "content_type"  => "required|in:description,bullets,both",
            "toc_id"        => "nullable|array"
        ]);

        $visaSubCategory = VisaSubCategory::findOrFail($id);
        $visaSubCategory->update([
            "category_id"   => $request->category_id,
            "title"         => $request->sub_title,
            "description"   => $request->sub_description,
            "publish_is"    => $request->publish_is,
            "content_type"  => $request->content_type,
            "date_modified" => now(),
        ]);

        $existingTocIds = SubCategoryTableOfContent::where('visa_sub_category_id', $id)->pluck('id')->toArray();
        $submittedTocIds = $request->toc_id ?? [];
        $toDelete = array_diff($existingTocIds, $submittedTocIds);
        if (!empty($toDelete)) {
            SubCategoryTableOfContent::whereIn('id', $toDelete)->delete();
        }

        foreach ($request->title as $key => $title) {
            $tocId = $submittedTocIds[$key] ?? null;
            $data = [
                "visa_sub_category_id" => $visaSubCategory->id,
                "title"                => $title,
                "description"          => $request->description[$key] ?? null,
                "bullets"              => $request->bullets[$key] ?? [],
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

        return redirect()->route('admin.visa-sub-category.index')->with('success', 'Visa Sub Category Updated Successfully');
    }

    public function destroy($id)
    {
        $id = base64_decode($id);
        $sub = VisaSubCategory::findOrFail($id);
        $sub->delete();
        return redirect()->route('admin.visa-sub-category.index')->with('success', 'Visa Sub Category Deleted Successfully');
    }

    public function show($encodedId)
    {
        $id = base64_decode($encodedId);
        $visaSubCategory = VisaSubCategory::findOrFail($id);
        return view('admin.visa-sub-category.show', compact('visaSubCategory'));
    }
}
