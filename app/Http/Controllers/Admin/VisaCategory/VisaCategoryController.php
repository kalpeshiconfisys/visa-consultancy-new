<?php

namespace App\Http\Controllers\Admin\VisaCategory;

use App\Http\Controllers\Controller;
use App\Models\SubCategoryTableOfContent;
use App\Models\VisaCategory;
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
        $input = [
            'title' => $request->main_title,
            'short_description' => $request->main_short_description,
            'description' => $request->main_description,
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
            SubCategoryTableOfContent::create([
                "visa_sub_category_id" => NULL,
                "category_id"          => $VisaCategory->id,
                "title"                => $request->title[$key],
                "description"          => $request->description[$key] ?? null,
                "bullets"              => $request->bullets[$key] ?? [],
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
        $input = [
            'title' => $request->main_title,
            'short_description' => $request->main_short_description,
            'description' => $request->main_description,
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
            $tocId = $submittedTocIds[$key] ?? null;

            $data = [
                "category_id"          => $visa->id,
                "title"                => $title,
                "description"          => $request->description[$key] ?? null,
                "bullets"              => $request->bullets[$key] ?? [],
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
