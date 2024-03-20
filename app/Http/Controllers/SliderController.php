<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    function index() {
        $sliders = Slider::orderBy('created_at', 'DESC')->get();
        return view('slider.index', compact('sliders'));
    }

    function create() {
        return view('slider.create');
    }

    function store(Request $request) {
        $request->validate([
            'image' => 'required|mimes:png,jpg'
        ]);

        
        if($request->hasFile('image')) {
            $slider = new Slider();
            $slider->image = ImageUpload($request->image, SLIDER_PATH);

            $slider->save();
        }

        return redirect()->route('slider.index')->with('success', 'Slider added successfully');
    }

    function edit($id) {
        $slider = Slider::where('id', $id)->firstOrFail();

        return view('slider.edit', compact('slider'));
    }

    function update(Request $request, $id) {
         $request->validate([
            'image' => 'required|mimes:png,jpg'
        ]);

        
        if($request->hasFile('image')) {
            $slider = Slider::where('id', $id)->firstOrFail();
            $slider->image = ImageUpload($request->image, SLIDER_PATH);

            $slider->save();
        }

        return redirect()->route('slider.index')->with('success', 'Slider updated successfully');
    }


    function delete(Request $request) {
        $slider = Slider::where('id', $request->id)->firstOrFail();

        removeImage($slider->image);

        $slider->delete();
        return redirect()->route('slider.index')->with('success', 'Slider removed successfully');
    }
}
