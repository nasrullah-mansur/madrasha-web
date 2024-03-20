<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::all();
        return view('back.sections.training.index', compact('trainings'));
    }

    public function create()
    {
        return view('back.sections.training.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $training = new Training();

        $training->title = $request->title;
        $training->status = $request->status;
        $training->description = $request->description;
        $training->image = ImageUpload($request->image, TRAINING_PATH);
        $training->save();

        return redirect()->route('training.index')->with('success', 'Training added successfully');
    }

    public function edit($id)
    {
        $training = Training::where('id', $id)->firstOrFail();

        return view('back.sections.training.edit', compact('training'));
    }

    public function update(Request $request, $id)
    {
        $training = Training::where('id', $id)->firstOrFail();

        $request->validate([
            'image' => 'nullable|mimes:png,jpg',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $training->title = $request->title;
        $training->status = $request->status;
        $training->description = $request->description;

        if ($request->hasFile('image')) {
            $training->image = ImageUpload($request->image, TRAINING_PATH, $training->image);
        }

        $training->save();

        return redirect()->route('training.index')->with('success', 'Training updated successfully');
    }

    public function delete(Request $request)
    {
        $training = Training::where('id', $request->id)->first();

        if ($training) {
            removeImage($training->image);
            $training->delete();
            return 'success';
        } else {
            return 'error';
        }
    }
}
