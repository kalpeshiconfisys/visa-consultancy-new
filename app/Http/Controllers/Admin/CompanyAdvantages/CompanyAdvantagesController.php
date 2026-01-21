<?php

namespace App\Http\Controllers\Admin\CompanyAdvantages;

use App\Http\Controllers\Controller;
use App\Models\CompanyAdvantage;
use Illuminate\Http\Request;
use App\Models\ConsultationMethod;
use Illuminate\Support\Facades\File;

class CompanyAdvantagesController extends Controller
{
    public function index()
    {
        $data = CompanyAdvantage::paginate(10);
        return view('admin.company_advantages.index', compact('data'));
    }

    public function create()
    {
        return view('admin.company_advantages.create');
    }

    public function store(Request $request)
    {



        $input = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/company-advantages'), $imgName);
            $input['image'] = $imgName;
        }


        CompanyAdvantage::create($input);

        return redirect()->route('admin.company-advantages.index')
                         ->with('success', 'Company Advantages  created successfully!');
    }

    public function show($id)
    {
        $id = base64_decode($id);
        $data = CompanyAdvantage::findOrFail($id);
        return view('admin.company_advantages.show', compact('data'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $data = CompanyAdvantage::findOrFail($id);
        return view('admin.company_advantages.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $id = base64_decode($id);
        $data = CompanyAdvantage::findOrFail($id);

        $input = [
            'title' => $request->title,
            'description' => $request->description
        ];

        if ($request->hasFile('image')) {
            if ($data->image && File::exists(public_path('uploads/company-advantages/' . basename($data->image)))) {
                File::delete(public_path('uploads/company-advantages/' . basename($data->image)));
            }
            $file = $request->file('image');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/company-advantages'), $imgName);
            $input['image'] = $imgName;
        }

        $data->update($input);

        return redirect()->route('admin.company-advantages.index')
                         ->with('success', 'Company Advantages updated successfully!');
    }

    public function destroy($id)
    {
              $id = base64_decode($id);
        $data = CompanyAdvantage::findOrFail($id);
        if ($data->image && File::exists(public_path('uploads/company-advantages/' . basename($data->image)))) {
                File::delete(public_path('uploads/company-advantages/' . basename($data->image)));
            }
        $data->delete();

        return redirect()->route('admin.company-advantages.index')
                         ->with('success', 'Company Advantages deleted successfully!');
    }
}
