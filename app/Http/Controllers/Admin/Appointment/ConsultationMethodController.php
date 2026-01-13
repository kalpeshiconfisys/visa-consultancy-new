<?php

namespace App\Http\Controllers\Admin\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConsultationMethod;

class ConsultationMethodController extends Controller
{
    public function index()
    {
        $methods = ConsultationMethod::paginate(10);
        return view('admin.consultation_method.index', compact('methods'));
    }

    public function create()
    {
        return view('admin.consultation_method.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        ConsultationMethod::create($request->only('title'));

        return redirect()->route('admin.consultation-method.index')
                         ->with('success', 'Consultation Method created successfully!');
    }

    public function show($id)
    {
              $id = base64_decode($id);
        $method = ConsultationMethod::findOrFail($id);
        return view('admin.consultation_method.show', compact('method'));
    }

    public function edit($id)
    {
              $id = base64_decode($id);
        $method = ConsultationMethod::findOrFail($id);
        return view('admin.consultation_method.edit', compact('method'));
    }

    public function update(Request $request, $id)
    {
              $id = base64_decode($id);
        $method = ConsultationMethod::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $method->update($request->only('title'));

        return redirect()->route('admin.consultation-method.index')
                         ->with('success', 'Consultation Method updated successfully!');
    }

    public function destroy($id)
    {
              $id = base64_decode($id);
        $method = ConsultationMethod::findOrFail($id);
        $method->delete();

        return redirect()->route('admin.consultation-method.index')
                         ->with('success', 'Consultation Method deleted successfully!');
    }
}
