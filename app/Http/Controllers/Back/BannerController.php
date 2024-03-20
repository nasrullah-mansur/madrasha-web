<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function edit()
    {
        $banner = Banner::first();
        return view('back.sections.banner', compact('banner'));
    }

    public function update(Request $request)
    {
        // return $request;

        $banner = Banner::first();

        if (!$banner) {
            $request->validate([
                'inner_page_image' => 'required|mimes:png,jpg',
                'title' => 'required',
                'content' => 'required',
            ], [
                'content.required' => 'Description field is required'
            ]);

            $banner = new Banner();

            if ($request->hasFile('inner_page_image')) {
                $banner->inner_page_image = ImageUpload($request->inner_page_image, BANNER_PATH);
            }
        } else {
            $request->validate([
                'inner_page_image' => 'nullable|mimes:png,jpg',
                'title' => 'required',
                'content' => 'required',
            ], [
                'content.required' => 'Description field is required'
            ]);

            if ($request->hasFile('inner_page_image')) {
                $banner->inner_page_image = ImageUpload($request->inner_page_image, BANNER_PATH);
            }
        }

        $banner->title = $request->title;
        $banner->content = $request->content;
        


        $banner->save();

        return redirect()->route('banner.edit')->with('success', 'Banner section updated successfully');
    }
}
