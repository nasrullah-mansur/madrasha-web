<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SeoController extends Controller
{
    function index() {
        $seos = Seo::all();
        return view('back.seo.index', compact('seos'));
    }

    function create() {
        return view('back.seo.create');
    }

    function store(Request $request) {
        $request->validate([
            'page_id' => 'required',
            'seo_content' => 'required',
        ]);

        $seo = new Seo();

        $seo->page_id = custom_path($request->page_id);

        $seo->seo_content = $request->seo_content;
        $seo->head_script = $request->head_script;
        $seo->body_script = $request->body_script;
        $seo->save();

        return redirect()->route('page.seo.index')->with('success', 'SEO added successfully');
    }


    function edit($id) {
        $seo = Seo::where('id', $id)->firstOrFail();
        return view('back.seo.edit', compact('seo'));
    }

    function update(Request $request, $id) {
        $seo = Seo::where('id', $id)->firstOrFail();

        $request->validate([
            'page_id' => 'required',
            'seo_content' => 'required',
        ]);

        $seo->page_id = custom_path($request->page_id);

        $seo->seo_content = $request->seo_content;
        $seo->head_script = $request->head_script;
        $seo->body_script = $request->body_script;
        $seo->save();

        return redirect()->route('page.seo.index')->with('success', 'SEO updated successfully');
    }


    function delete(Request $request) {
        $seo = Seo::where('id', $request->id)->firstOrFail();

        $seo->delete();

        return 'success';
    }

}
