<?php

namespace App\Http\Controllers;

use App\Models\Glance;
use Illuminate\Http\Request;

class GlanceController extends Controller
{
    function edit() {
        $glance = Glance::first();

        // return $glance;
        return view('back.glance.edit', compact('glance'));
    }

    function update(Request $request) {
        
        $glance = glance::first();

        if(!$glance) {
            $glance = new glance();
        }

        $glance->content = $request->content;
        $glance->list = json_encode($request->list);
        
        
        $glance->save();
        return redirect()->route('glance.edit')->with('success', 'Glance updated successfully');
    }

}
