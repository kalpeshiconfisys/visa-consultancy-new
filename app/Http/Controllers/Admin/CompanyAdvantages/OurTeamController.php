<?php

namespace App\Http\Controllers\Admin\CompanyAdvantages;

use App\Http\Controllers\Controller;
use App\Models\CompanyAdvantage;
use Illuminate\Http\Request;
use App\Models\ConsultationMethod;
use App\Models\OurTeam;
use Illuminate\Support\Facades\File;

class OurTeamController extends Controller
{
    public function index()
    {
        $data = OurTeam::paginate(10);
        return view('admin.our_team.index', compact('data'));
    }

    public function create()
    {
        return view('admin.our_team.create');
    }

    public function store(Request $request)
    {
        $input = [
            'name' => $request->name,
            'designation' => $request->designation,
        ];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/our-team'), $imgName);
            $input['image'] = $imgName;
        }
        OurTeam::create($input);
        return redirect()->route('admin.our-teams.index')->with('success', 'Our Teams created successfully!');
    }

    public function show($id)
    {
        $id = base64_decode($id);
        $data = OurTeam::findOrFail($id);
        return view('admin.our_team.show', compact('data'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $data = OurTeam::findOrFail($id);
        return view('admin.our_team.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $id = base64_decode($id);
        $data = OurTeam::findOrFail($id);
        $input = [
            'name' => $request->name,
            'designation' => $request->designation
        ];
        if ($request->hasFile('image')) {
            if ($data->image && File::exists(public_path('uploads/our-team/' . basename($data->image)))) {
                File::delete(public_path('uploads/our-team/' . basename($data->image)));
            }
            $file = $request->file('image');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/our-team'), $imgName);
            $input['image'] = $imgName;
        }
        $data->update($input);
        return redirect()->route('admin.our-teams.index')
            ->with('success', 'Our Teams updated successfully!');
    }

    public function destroy($id)
    {
        $id = base64_decode($id);
        $data = OurTeam::findOrFail($id);
        if ($data->image && File::exists(public_path('uploads/our-team/' . basename($data->image)))) {
            File::delete(public_path('uploads/our-team/' . basename($data->image)));
        }
        $data->delete();

        return redirect()->route('admin.our-teams.index')
            ->with('success', 'Our Teams deleted successfully!');
    }
}
