<?php

namespace App\Http\Controllers\Admin\Country;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CountryController extends Controller
{

    public function index()
    {

        $country = Country::latest()->paginate(10);
        return view('admin.country.index', compact('country'));
    }

    public function create()
    {
        return view('admin.country.create');    
    }

    public function store(Request $request)
    {
        $input = $request->only("title", "description");
        $mainContent = $this->processEditorImages($request->description, $request);
        $input = [
            'title' => $request->title,
            'description' => $mainContent,
        ];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/country'), $imgName);
            $input['image'] = $imgName;
        }
        Country::create($input);
        return redirect()->route('admin.country.index')->with('success', 'Country Created Successfully');
    }

    public function edit($encodedId)
    {
        $id = base64_decode($encodedId);
        $country = Country::findOrFail($id);
        return view('admin.country.edit', compact('country'));
    }

    public function update(Request $request, $encodedId)
    {
        $id = base64_decode($encodedId);
        $country = Country::findOrFail($id);
        $mainContent = $this->processEditorImages($request->description, $request);
        $input = [
            'title' => $request->title,
            'description' => $mainContent,
        ];
        if ($request->hasFile('image')) {
            if ($country->image && File::exists(public_path('uploads/country/' . basename($country->image)))) {
                File::delete(public_path('uploads/country/' . basename($country->image)));
            }
            $file = $request->file('image');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/country'), $imgName);
            $input['image'] = $imgName;
        }
        $country->update($input);
        return redirect()->route('admin.country.index')->with('success', 'Country Updated Successfully');
    }

    function processEditorImages($html, $request)
    {
        $content = html_entity_decode($html ?? '');
        $pattern = '/<img[^>]+src="data:image\/([^;]+);base64,([^"]+)"[^>]*>/i';
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $imageFormat = strtolower($match[1]);
            $base64Image = $match[2];
            $allowed = ['jpeg', 'jpg', 'png', 'gif', 'webp'];
            if (!in_array($imageFormat, $allowed)) {
                continue;
            }
            $imageData = base64_decode($base64Image);
            if ($imageData === false) {
                continue;
            }
            $filename = 'image_' . uniqid() . '.' . $imageFormat;
            $destinationPath = public_path('uploads/content_img');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            file_put_contents($destinationPath . '/' . $filename, $imageData);
            $publicImageUrl = $request->getSchemeAndHttpHost() . '/uploads/content_img/' . $filename;
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
        $country = Country::findOrFail($id);
        if (!empty($country->image) && File::exists(public_path('uploads/country/' . basename($country->image)))) {
            File::delete(public_path('uploads/country/' . basename($country->image)));
        }
        $country->delete();
        return redirect()->route('admin.country.index')->with('success', 'Country Deleted Successfully');
    }

    public function show($encodedId)
    {
        $id = base64_decode($encodedId);
        $country = Country::findOrFail($id);
        return view('admin.country.show', compact('country'));
    }
}
