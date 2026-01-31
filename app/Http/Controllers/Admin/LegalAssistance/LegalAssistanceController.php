<?php

namespace App\Http\Controllers\Admin\LegalAssistance;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\LegalAssistance;
use Illuminate\Support\Facades\File;

class LegalAssistanceController extends Controller
{

    public function index()
    {
        $data = LegalAssistance::paginate(10);
        return view('admin.legal_assistance.index', compact('data'));
    }

    public function create()
    {
        return view('admin.legal_assistance.create');
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
            $file->move(public_path('uploads/legal-assistance'), $imgName);
            $input['image'] = $imgName;
        }
        LegalAssistance::create($input);
        return redirect()->route('admin.legal-assistance.index')->with('success', 'Legal Assistance created successfully!');
    }

    public function show($id)
    {
        $id = base64_decode($id);
        $data = LegalAssistance::findOrFail($id);
        return view('admin.legal_assistance.show', compact('data'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $data = LegalAssistance::findOrFail($id);
        return view('admin.legal_assistance.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $id = base64_decode($id);
        $data = LegalAssistance::findOrFail($id);
        $input = [
            'title' => $request->title,
            'description' => $request->description
        ];
        if ($request->hasFile('image')) {
            if ($data->image && File::exists(public_path('uploads/legal-assistance/' . basename($data->image)))) {
                File::delete(public_path('uploads/legal-assistance/' . basename($data->image)));
            }
            $file = $request->file('image');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/legal-assistance'), $imgName);
            $input['image'] = $imgName;
        }
        $data->update($input);
        return redirect()->route('admin.legal-assistance.index')
            ->with('success', 'Legal Assistance updated successfully!');
    }

    public function destroy($id)
    {
        $id = base64_decode($id);
        $data = LegalAssistance::findOrFail($id);
        if ($data->image && File::exists(public_path('uploads/legal-assistance/' . basename($data->image)))) {
            File::delete(public_path('uploads/legal-assistance/' . basename($data->image)));
        }
        $data->delete();

        return redirect()->route('admin.legal-assistance.index')
            ->with('success', 'Legal Assistance deleted successfully!');
    }
}
