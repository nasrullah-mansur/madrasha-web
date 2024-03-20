<?php

namespace App\Http\Controllers;

use App\Models\CustomPage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CustomPageController extends Controller
{

    function index() {
        $pages = CustomPage::all();
        return view('back.custom_page.index', compact('pages'));
    }

    function create() {
        return view('back.custom_page.create');
    }

    function store(Request $request) {
        $request->validate([
            'name' => 'required|max:256',
            'content' => 'required'
        ]);

        $page = new CustomPage();

        $page->name = $request->name;
        $page->slug = Str::slug($request->name);
        $page->content = $request->content;
        $page->css = $request->css;
        $page->js = $request->js;
        $page->seo_meta = $request->seo_meta;
        $page->head_script = $request->head_script;
        $page->body_script = $request->body_script;

        $page->save();

        return redirect()->route('back.custom_page.index')->with('success', 'Custom Page Added Successfully');
    }

    function edit($id) {
        $page = CustomPage::where('id', $id)->firstOrFail();

        return view('back.custom_page.edit', compact('page'));
    }

    function update(Request $request, $id) {
        $page = CustomPage::where('id', $id)->firstOrFail();

        $request->validate([
            'name' => 'required|max:256',
            'content' => 'required'
        ]);

        $page->name = $request->name;
        $page->slug = Str::slug($request->name);
        $page->content = $request->content;
        $page->css = $request->css;
        $page->js = $request->js;
        $page->seo_meta = $request->seo_meta;
        $page->head_script = $request->head_script;
        $page->body_script = $request->body_script;

        $page->save();

        return redirect()->route('custom.page.index')->with('success', 'Custom Page updated Successfully');
    }

    function delete(Request $request) {
        $page = CustomPage::where('id', $request->id)->firstOrFail();
        $page->delete();

        return 'success';
    }
}
