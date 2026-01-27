<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Google\Service\Blogger\Resource\Blogs;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index(){

        $blogs = Blog::latest()->paginate(10);
        return view('admin.blog.index',compact('blogs'));
    }

    public function create(){
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $input = $request->only("title","description");
        $mainContent = $this->processEditorImages($request->description, $request);
        $input = [
            'title' => $request->title,
            'description' => $mainContent,
        ];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/blogs'), $imgName);
            $input['image'] = $imgName;
        }
        Blog::create($input);
        return redirect()->route('admin.blogs.index')->with('success', 'Blogs Created Successfully');
    }

    public function edit($encodedId)
    {
        $id = base64_decode($encodedId);
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, $encodedId)
    {
        $id = base64_decode($encodedId);
        $blog = Blog::findOrFail($id);
        $mainContent = $this->processEditorImages($request->description, $request);
        $input = [
            'title' => $request->title,
            'description' => $mainContent,
        ];
        if ($request->hasFile('image')) {
            if ($blog->image && File::exists(public_path('uploads/blogs/' . basename($blog->image)))) {
                File::delete(public_path('uploads/blogs/' . basename($blog->image)));
            }
            $file = $request->file('image');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/blogs'), $imgName);
            $input['image'] = $imgName;
        }
        $blog->update($input);
        return redirect()->route('admin.blogs.index')->with('success', 'Blogs Updated Successfully');
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
        $blog = Blog::findOrFail($id);
        if (!empty($blog->image) && File::exists(public_path('uploads/blogs/' . basename($blog->image)))) {
            File::delete(public_path('uploads/blogs/' . basename($blog->image)));
        }
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blogs Deleted Successfully');
    }

    public function show($encodedId)
    {
        $id = base64_decode($encodedId);
        $blog = Blog::findOrFail($id);
        return view('admin.blog.show', compact('blog'));
    }
}
