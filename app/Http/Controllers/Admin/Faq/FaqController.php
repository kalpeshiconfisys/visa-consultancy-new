<?php

namespace App\Http\Controllers\Admin\Faq;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(){
        $faq = Faq::latest()->paginate(10);
        return view('admin.faq.index', compact('faq'));
    }

    public function create(){
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $input = $request->only("question","answer");
        $input = [
            'question' => $request->question,
            'answer' => $request->answer,
        ];
        Faq::create($input);
        return redirect()->route('admin.faq.index')->with('success', 'FAQ Created Successfully');
    }

    public function edit($encodedId)
    {
        $id = base64_decode($encodedId);
        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, $encodedId)
    {
        $id = base64_decode($encodedId);
        $faq = Faq::findOrFail($id);

        $input = [
            'question' => $request->question,
            'answer' => $request->answer,
        ];


        $faq->update($input);
        return redirect()->route('admin.faq.index')->with('success', 'FAQ Updated Successfully');
    }

    public function destroy($encodedId)
    {
        $id = base64_decode($encodedId);
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->route('admin.faq.index')->with('success', 'Faq Deleted Successfully');
    }

    public function show($encodedId)
    {
        $id = base64_decode($encodedId);
        $faq = Faq::findOrFail($id);
        return view('admin.faq.show', compact('faq'));
    }


}
