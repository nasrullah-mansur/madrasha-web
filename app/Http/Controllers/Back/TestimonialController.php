<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('back.sections.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('back.sections.testimonial.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg',
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
            'btn_text' => 'required',
            'btn_link' => 'required',
            'status' => 'required'
        ]);

        $testimonial = new Testimonial();

        $testimonial->title = $request->title;
        $testimonial->subtitle = $request->subtitle;
        $testimonial->status = $request->status;
        $testimonial->description = $request->description;
        $testimonial->btn_text = $request->btn_text;
        $testimonial->btn_link = $request->btn_link;
        $testimonial->image = ImageUpload($request->image, TESTIMONIAL_PATH);
        $testimonial->save();

        return redirect()->route('testimonial.index')->with('success', 'Testimonial added successfully');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::where('id', $id)->firstOrFail();

        return view('back.sections.testimonial.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = testimonial::where('id', $id)->firstOrFail();

        $request->validate([
            'image' => 'nullable|mimes:png,jpg',
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
            'btn_text' => 'required',
            'btn_link' => 'required',
            'status' => 'required'
        ]);

        $testimonial->title = $request->title;
        $testimonial->subtitle = $request->subtitle;
        $testimonial->status = $request->status;
        $testimonial->description = $request->description;
        $testimonial->btn_text = $request->btn_text;
        $testimonial->btn_link = $request->btn_link;

        if ($request->hasFile('image')) {
            $testimonial->image = ImageUpload($request->image, TESTIMONIAL_PATH, $testimonial->image);
        }

        $testimonial->save();

        return redirect()->route('testimonial.index')->with('success', 'Testimonial updated successfully');
    }

    public function delete(Request $request)
    {
        $testimonial = Testimonial::where('id', $request->id)->first();

        if ($testimonial) {
            removeImage($testimonial->image);
            $testimonial->delete();
            return 'success';
        } else {
            return 'error';
        }
    }
}
