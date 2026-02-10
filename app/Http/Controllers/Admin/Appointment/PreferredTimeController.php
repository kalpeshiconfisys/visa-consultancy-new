<?php

namespace App\Http\Controllers\Admin\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PreferredTime;

class PreferredTimeController extends Controller
{
    public function index()
    {
        $preferredTimes = PreferredTime::paginate(10);

        return view('admin.preferred_time.index', compact('preferredTimes'));
    }

    public function create()
    {
        return view('admin.preferred_time.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        PreferredTime::create($request->only('title'));

        return redirect()->route('admin.preferred-time.index')
                         ->with('success', 'Preferred time created successfully!');
    }

    public function show($id)
    {
         $id = base64_decode($id);
        $preferredTime = PreferredTime::findOrFail($id);
        return view('admin.preferred_time.show', compact('preferredTime'));
    }

    public function edit($id)
    {
         $id = base64_decode($id);
        $preferredTime = PreferredTime::findOrFail($id);
        return view('admin.preferred_time.edit', compact('preferredTime'));
    }

    public function update(Request $request, $id)
    {
        $id = base64_decode($id);

         $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $preferredTime = PreferredTime::findOrFail($id);

        $preferredTime->update($request->only('title'));

        return redirect()->route('admin.preferred-time.index')
                         ->with('success', 'Preferred time updated successfully!');
    }

    public function destroy($id)
    {
         $id = base64_decode($id);
        $preferredTime = PreferredTime::findOrFail($id);
        $preferredTime->delete();

        return redirect()->route('admin.preferred-time.index')
                         ->with('success', 'Preferred time deleted successfully!');
    }
}
