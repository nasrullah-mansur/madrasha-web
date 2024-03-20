<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::all();
        return view('back.sections.award.index', compact('awards'));
    }

    public function create()
    {
        return view('back.sections.award.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg',
            'title' => 'required',
            'status' => 'required'
        ]);

        $award = new Award();

        $award->title = $request->title;
        $award->status = $request->status;
        $award->image = ImageUpload($request->image, AWARD_PATH);
        $award->save();

        return redirect()->route('award.index')->with('success', 'Award added successfully');
    }

    public function edit($id)
    {
        $award = Award::where('id', $id)->firstOrFail();

        return view('back.sections.award.edit', compact('award'));
    }

    public function update(Request $request, $id)
    {
        $award = Award::where('id', $id)->firstOrFail();

        $request->validate([
            'image' => 'nullable|mimes:png,jpg',
            'title' => 'required',
            'status' => 'required'
        ]);

        $award->title = $request->title;
        $award->status = $request->status;

        if ($request->hasFile('image')) {
            $award->image = ImageUpload($request->image, AWARD_PATH, $award->image);
        }

        $award->save();

        return redirect()->route('award.index')->with('success', 'Award updated successfully');
    }

    public function delete(Request $request)
    {
        $award = Award::where('id', $request->id)->first();

        if ($award) {
            removeImage($award->image);
            $award->delete();
            return 'success';
        } else {
            return 'error';
        }
    }
}
