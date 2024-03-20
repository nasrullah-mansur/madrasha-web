<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Time;
use App\Models\Chamber;
use App\Models\DayTime;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ChamberController extends Controller
{
    public function index()
    {
        $chambers = Chamber::all();

        return view('back.chamber.index', compact('chambers'));
    }

    public function create()
    {
        $days = Day::all();
        $times = Time::all();
        return view('back.chamber.create', compact('days', 'times'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'chamber_name' => 'required',
            'fee' => 'required|numeric',
            'chamber_time' => 'required',
            'image' => 'required|mimes:png,jpg',
            'address' => 'required',
        ]);

        $chamber = new Chamber();
        $chamber->chamber_name = $request->chamber_name;
        $chamber->slug = Str::slug($request->chamber_name);
        $chamber->image = ImageUpload($request->image, CHAMBER_PATH);
        $chamber->address = $request->address;
        $chamber->chamber_time = $request->chamber_time;
        $chamber->google_location = $request->google_location;
        $chamber->serial_number = $request->serial_number;
        $chamber->fee = $request->fee;
        $chamber->btn_link = $request->btn_link;
        



        $chamber->save();

        // $chamber->times()->attach($request->times);
        // $chamber->days()->attach($request->days);

        return redirect()->route('chamber.index')->with('success', 'Chamber added successfully');
    }

    public function edit($id)
    {
        $chamber = Chamber::where('id', $id)->firstOrFail();
        $days = Day::all();
        $times = Time::all();

        $active_days = [];

        foreach ($chamber->days as $t) {
            array_push($active_days, $t->id);
        }

        $active_times = [];

        foreach ($chamber->times as $s) {
            array_push($active_times, $s->id);
        }

        return view('back.chamber.edit', compact('chamber', 'days', 'times', 'active_days', 'active_times'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
             'chamber_name' => 'required',
            'fee' => 'required|numeric',
            'chamber_time' => 'required',
            'image' => 'nullable|mimes:png,jpg',
            'address' => 'required',
        ]);

        $chamber = Chamber::where('id', $id)->firstOrFail();
        $chamber->chamber_name = $request->chamber_name;
        $chamber->slug = Str::slug($request->chamber_name);
        if ($request->hasFile('image')) {
            $chamber->image = ImageUpload($request->image, CHAMBER_PATH);
        }
        $chamber->chamber_time = $request->chamber_time;
        $chamber->address = $request->address;
        $chamber->google_location = $request->google_location;
        $chamber->serial_number = $request->serial_number;
        $chamber->fee = $request->fee;
        $chamber->btn_link = $request->btn_link;

        
        $chamber->save();
        
        // $chamber->times()->sync($request->times);
        // $chamber->days()->sync($request->days);

        return redirect()->route('chamber.index')->with('success', 'Chamber added successfully');
    }

    public function delete(Request $request)
    {
        $chamber = Chamber::where('id', $request->id)->firstOrFail();
        removeImage($chamber->image);

        $dayTimes = DayTime::where('chamber_id', $chamber->id)->get();

        foreach ($dayTimes as $day) {
            $day->delete();
        }

        $chamber->delete();
    }
}
