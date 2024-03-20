<?php

namespace App\Http\Controllers;

use App\Models\Specialties;
use Illuminate\Http\Request;

class SpecialtiesController extends Controller
{
    public function index()
    {
        $specials = Specialties::all();
        return view('back.sections.specialties.index', compact('specials'));
    }

    public function create()
    {
        return view('back.sections.specialties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg',
            'title' => 'required',
            'link' => 'required',
            'status' => 'required'
        ]);

        $special = new Specialties();

        $special->title = $request->title;
        $special->status = $request->status;
        $special->link = $request->link;
        $special->image = ImageUpload($request->image, SPECIALTIES_PATH);
        $special->save();

        return redirect()->route('specialties.index')->with('success', 'Specialties added successfully');
    }

    public function edit($id)
    {
        $special = Specialties::where('id', $id)->firstOrFail();

        return view('back.sections.specialties.edit', compact('special'));
    }

    public function update(Request $request, $id)
    {
        $special = Specialties::where('id', $id)->firstOrFail();

        $request->validate([
            'image' => 'nullable|mimes:png,jpg',
            'title' => 'required',
            'link' => 'required',
            'status' => 'required'
        ]);

        $special->title = $request->title;
        $special->status = $request->status;
        $special->link = $request->link;

        if ($request->hasFile('image')) {
            $special->image = ImageUpload($request->image, SPECIALTIES_PATH, $special->image);
        }

        $special->save();

        return redirect()->route('specialties.index')->with('success', 'Specialties updated successfully');
    }

    public function delete(Request $request)
    {
        $special = Specialties::where('id', $request->id)->first();

        if ($special) {
            removeImage($special->image);
            $special->delete();
            return 'success';
        } else {
            return 'error';
        }
    }
}
