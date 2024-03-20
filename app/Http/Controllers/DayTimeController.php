<?php

namespace App\Http\Controllers;

use App\Models\Chamber;
use App\Models\DayTime;
use Illuminate\Http\Request;

class DayTimeController extends Controller
{
    function index() {
        $dayTimes = DayTime::with('chamber')->orderBy('created_at', 'DESC')->get();
        return view('back.daytime.index', compact('dayTimes'));
    }


    function create() {
        $chambers = Chamber::get();

        return view('back.daytime.create', compact('chambers'));
    }

    function store(Request $request) {
        $request->validate([
            'chamber_id' => 'required',
            'day' => 'required',
            'time' => 'required'
        ], [
            'chamber_id.required' => "Please select a chamber first"
        ]);

        $dayTime = new DayTime();

        $dayTime->chamber_id = $request->chamber_id;
        $dayTime->day = $request->day;
        $dayTime->time = $request->time;
        $dayTime->status = $request->status;

        $dayTime->save();

        return redirect()->route('day.time.index')->with('success', 'Day and Time added successfully');
    }


    function edit($id) {
        $daytime = DayTime::where('id', $id)->firstOrFail();

        $chambers = Chamber::get();

        return view('back.daytime.edit', compact('chambers', 'daytime'));
    }

    function update(Request $request, $id) {
        $dayTime = DayTime::where('id', $id)->firstOrFail();

        $request->validate([
            'chamber_id' => 'required',
            'day' => 'required',
            'time' => 'required'
        ], [
            'chamber_id.required' => "Please select a chamber first"
        ]);

        $dayTime->chamber_id = $request->chamber_id;
        $dayTime->day = $request->day;
        $dayTime->time = $request->time;
        $dayTime->status = $request->status;

        $dayTime->save();

        return redirect()->route('day.time.index')->with('success', 'Day and Time updated successfully');
    }

    function delete(Request $request) {
        $dayTime = DayTime::where('id', $request->id)->firstOrFail();
        $dayTime->delete();

        return redirect()->route('day.time.index')->with('success', 'Blog removed successfully');
    }
}
