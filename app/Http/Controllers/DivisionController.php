<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    function index() {
        $divisions = Division::orderBy('created_at', 'DESC')->get();
        return view('back.division.index', compact('divisions'));
    }

    function create() {
        return view('back.division.create');
    }

    function store(Request $request) {
        $request->validate([
            'image' => 'required|mimes:png,jpg',
            'title' => 'required',
            'alt' => 'required'
        ]);

        $division = new Division();
        $division->title = $request->title;
        $division->slug = Str::slug($request->title);
        $division->content = $request->content;
        $division->alt = $request->alt;
        
        if($request->hasFile('image')) {
            $division->image = ImageUpload($request->image, SLIDER_PATH);
        }
        
        $division->save();

        return redirect()->route('division.index')->with('success', 'Division added successfully');
    }

    function edit($id) {
        $division = Division::where('id', $id)->firstOrFail();

        return view('back.division.edit', compact('division'));
    }

    function update(Request $request, $id) {
         $request->validate([
            'image' => 'nullable|mimes:png,jpg',
            'title' => 'required',
            'alt' => 'required'
        ]);

        $division = Division::where('id', $id)->firstOrFail();
        $division->title = $request->title;
        $division->slug = Str::slug($request->title);
        $division->content = $request->content;
        $division->alt = $request->alt;
        
        if($request->hasFile('image')) {
            $division->image = ImageUpload($request->image, SLIDER_PATH);

        }
        
        $division->save();
        return redirect()->route('division.index')->with('success', 'Division updated successfully');
    }


    function delete(Request $request) {
        $division = Division::where('id', $request->id)->firstOrFail();

        removeImage($division->image);

        $division->delete();
        return redirect()->route('division.index')->with('success', 'Division removed successfully');
    }
}
