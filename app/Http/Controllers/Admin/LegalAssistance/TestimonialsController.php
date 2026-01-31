<?php

namespace App\Http\Controllers\Admin\LegalAssistance;

use App\Http\Controllers\Controller;
use App\Models\CompanyAdvantage;
use Illuminate\Http\Request;
use App\Models\ConsultationMethod;
use App\Models\OurTeam;
use App\Models\Testimonial;
use Illuminate\Support\Facades\File;

class TestimonialsController extends Controller
{
    public function index()
    {
        $data = Testimonial::paginate(10);
        return view('admin.testimonial.index', compact('data'));
    }

    public function create()
    {
        return view('admin.testimonial.create');
    }

    public function store(Request $request)
    {
        $input = [
            'name' => $request->name,
            'description' => $request->description
        ];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/testimonial'), $imgName);
            $input['image'] = $imgName;
        }
        Testimonial::create($input);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonials created successfully!');
    }

    public function show($id)
    {
        $id = base64_decode($id);
        $data = Testimonial::findOrFail($id);
        return view('admin.testimonial.show', compact('data'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $data = Testimonial::findOrFail($id);


        return view('admin.testimonial.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $id = base64_decode($id);
        $data = Testimonial::findOrFail($id);
        $input = [
            'name' => $request->name,
            'description' => $request->description
        ];
        if ($request->hasFile('image')) {
            if ($data->image && File::exists(public_path('uploads/testimonial/' . basename($data->image)))) {
                File::delete(public_path('uploads/testimonial/' . basename($data->image)));
            }
            $file = $request->file('image');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/testimonial'), $imgName);
            $input['image'] = $imgName;
        }
        $data->update($input);
        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonials updated successfully!');
    }

    public function destroy($id)
    {
        $id = base64_decode($id);
        $data = Testimonial::findOrFail($id);
        if ($data->image && File::exists(public_path('uploads/testimonial/' . basename($data->image)))) {
            File::delete(public_path('uploads/testimonial/' . basename($data->image)));
        }
        $data->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonials deleted successfully!');
    }
}
