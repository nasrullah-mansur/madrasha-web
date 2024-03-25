<?php

namespace App\Http\Controllers\Front;

use App\Models\Glance;
use App\Models\Notice;
use App\Models\Slider;
use App\Models\Division;
use App\Models\CustomPage;
use App\Models\ImageGallery;
use Illuminate\Http\Request;
use App\Models\ContactSection;
use App\Http\Controllers\Controller;
use App\Models\ImageGalleryCategory;

class FrontController extends Controller
{
    public function index()
    {

        $sliders = Slider::orderBy('created_at', 'DESC')->get();
        $divisions = Division::all();
        $notice = Notice::first();
        $glance = Glance::first();

        return view('welcome', compact(
            'sliders',
            'divisions',
            'notice',
            'glance'
        ));
    }

    function division_view($slug) {
        $division = Division::where('slug', $slug)->firstOrFail();
        $divisions = Division::all();

        return view('front.details', compact('division', 'divisions'));
    }


    function gallery() {
        $galleries = ImageGallery::orderBy('created_at', 'DESC')->get();

        $categories = ImageGalleryCategory::all();

        return view('front.gallery', compact('galleries', 'categories'));
    }


    function contact() {
        $contact_section = ContactSection::first();

        return view('front.contact', compact('contact_section'));
    }



    function contact_form(Request $request) {
        $request->validate([
            'name' => 'required|max:256',
            'phone' => 'required|max:256',
            'subject' => 'required|max:256',
            'details' => 'required'
        ], [
            'name.required' => '* দয়া করে আপনার নাম লিখুন',
            'phone.required' => '* দয়া করে অপনার ফোন নম্বরটি দিন',
            'subject.required' => '* দয়া করে আপনার বিষয়টি লিখুন',
            'details.required' => '* দয়া করে বিস্তারিত লিখুন',
        ]);

        return redirect()->route('front.contact')->with('success', "আমাদের সাথে যোগাযোগের জন্য আপনাকে ধন্যবাদ, আমরা অতি শিঘ্রই আপনার সাথে যোগাযোগ করবো।");
    }




    function custom_page($slug) {
        
        $page = CustomPage::where('slug', $slug)->firstOrFail();

        return view('front.page', compact('page'));

    }

}