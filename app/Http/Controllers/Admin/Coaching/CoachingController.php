<?php

namespace App\Http\Controllers\Admin\Coaching;

use App\Http\Controllers\Controller;
use App\Models\Coaching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CoachingController extends Controller
{

    public function index()
    {
        $coaching = Coaching::latest()->paginate(10);
        return view('admin.coaching.index', compact('coaching'));
    }

    public function create()
    {
        return view('admin.coaching.create');
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
            $file->move(public_path('uploads/coaching'), $imgName);
            $input['image'] = $imgName;
        }
        Coaching::create($input);
        return redirect()->route('admin.coaching.index')->with('success', 'Country Created Successfully');
    }

    public function edit($encodedId)
    {
        $id = base64_decode($encodedId);
        $coaching = Coaching::findOrFail($id);
        return view('admin.coaching.edit', compact('coaching'));
    }

    public function update(Request $request, $encodedId)
    {
        $id = base64_decode($encodedId);
        $coaching = Coaching::findOrFail($id);
        $mainContent = $this->processEditorImages($request->description, $request);
        $input = [
            'title' => $request->title,
            'description' => $mainContent,
        ];
        if ($request->hasFile('image')) {
            if ($coaching->image && File::exists(public_path('uploads/coaching/' . basename($coaching->image)))) {
                File::delete(public_path('uploads/coaching/' . basename($coaching->image)));
            }
            $file = $request->file('image');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/coaching'), $imgName);
            $input['image'] = $imgName;
        }
        $coaching->update($input);
        return redirect()->route('admin.coaching.index')->with('success', 'Country Updated Successfully');
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
        $coaching = Coaching::findOrFail($id);
        if (!empty($coaching->image) && File::exists(public_path('uploads/coaching/' . basename($coaching->image)))) {
            File::delete(public_path('uploads/coaching/' . basename($coaching->image)));
        }
        $coaching->delete();
        return redirect()->route('admin.coaching.index')->with('success', 'Country Deleted Successfully');
    }

    public function show($encodedId)
    {
        $id = base64_decode($encodedId);
        $coaching = Coaching::findOrFail($id);
        return view('admin.coaching.show', compact('coaching'));
    }
}
