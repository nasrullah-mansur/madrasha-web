<?php

use App\Models\Seo;
use App\Models\Blog;
use App\Models\Social;
use App\Models\MenuItem;
use App\Models\Appearance;
use Illuminate\Support\Str;
use App\Models\Advertizement;
use App\Models\Banner;
use App\Models\ContactSection;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

const ADMIN_ROLE = 'admin-role';
const PATIENT_ROLE = 'patient-role';

const STATUS_ACTIVE = 'ACTIVE';
const STATUS_INACTIVE = 'INACTIVE';
const SLIDER_PATH = 'uploaded_file/images/slider/';
const LOGO_PATH = 'uploaded_file/images/logo/';
const FAVICON_PATH = 'uploaded_file/images/favicon/';
const APPEARANCE_PATH = 'uploaded_file/images/appearance/';
const BANNER_PATH = 'uploaded_file/images/banner/';
const BLOG_PATH = 'uploaded_file/images/blog/';
const SPECIALTIES_PATH = 'uploaded_file/images/specials/';
const TRAINING_PATH = 'uploaded_file/images/training/';
const TESTIMONIAL_PATH = 'uploaded_file/images/testimonial/';
const CTA_PATH = 'uploaded_file/images/cta/';
const ADD_PATH = 'uploaded_file/images/add/';
const AWARD_PATH = 'uploaded_file/images/award/';
const CHAMBER_PATH = 'uploaded_file/images/chamber/';
const IMAGE_GALLERY_PATH = 'uploaded_file/images/gallery/';
const REMOVE_MESSAGE = 'All relevant items will be removed permanently and You will not be able to recover this imaginary file!';

// ================ Image Upload =========================== //
function ImageUpload($new_file, $path, $old_image = null)
{
    if (!file_exists(public_path($path))) {
        mkdir(public_path($path), 0777, true);
    }
    $file_name = Str::slug($new_file->getClientOriginalName()) . '_' . rand(111111, 999999) . '.' . $new_file->getClientOriginalExtension();
    $destinationPath = public_path($path);

    if ($old_image != null) {
        if (File::exists(public_path($old_image))) {
            unlink(public_path($old_image));
        }
    }

    $new_file->move($destinationPath, $file_name);

    return $path . $file_name;
};

function ResizeImageUpload($new_file, $path, $old_image, $w, $h)
{
    if (!file_exists(public_path($path))) {
        mkdir(public_path($path), 0777, true);
    }

    $destinationPath = public_path($path);
    $file_name = Str::slug($new_file->getClientOriginalName()) . '_' . rand(111111, 999999) . '.' . $new_file->getClientOriginalExtension();

    if ($old_image != null) {
        if (File::exists(public_path($old_image))) {
            unlink(public_path($old_image));
        }
    }

    Image::make($new_file)
        ->fit($w, $h)
        ->save($destinationPath . $file_name);

    return $path . $file_name;
};

function removeImage($file)
{
    if ($file != null) {
        if (File::exists(public_path($file))) {
            unlink(public_path($file));
        }
    }
}

function generateRandomString($length = 4)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString . '-';
}

function theme()
{
    return $app = Appearance::first();
}

function main_menu()
{
    $main_menu = MenuItem::with('menuItem')
        ->where('status', STATUS_ACTIVE)
        ->where('p_id', '0')
        ->orderBy('position')
        ->get();
    return $main_menu;
}

function footer_left()
{
    $footer_menu = MenuItem::where('status', STATUS_ACTIVE)
        ->where('set_location', 'footer-left')
        ->orderBy('position')
        ->get();
    return $footer_menu;
}

function footer_middle()
{
    $category_menu = MenuItem::where('status', STATUS_ACTIVE)
        ->where('set_location', 'footer-middle')
        ->orderBy('position')
        ->get();
    return $category_menu;
}

function footer_right()
{
    $category_menu = MenuItem::where('status', STATUS_ACTIVE)
        ->where('set_location', 'footer-right')
        ->orderBy('position')
        ->get();
    return $category_menu;
}

function latest_blog_gall()
{
    $blog = Blog::orderBy('created_at', 'DESC')
        ->take(6)
        ->get();

    return $blog;
}

function logo()
{
    $app = Appearance::first();
    if ($app) {
        return $app->logo;
    } else {
        return 'front/images/logo.png';
    }
}

function blog_add()
{
    $adds = Advertizement::where('position', 'blog-page')
        ->where('status', STATUS_ACTIVE)
        ->inRandomOrder()
        ->take(1)
        ->get();

    return $adds;
}

function single_blog_add()
{
    $adds = Advertizement::where('position', 'single-blog-page')
        ->where('status', STATUS_ACTIVE)
        ->inRandomOrder()
        ->take(1)
        ->get();

    return $adds;
}

function chamber_add()
{
    $adds = Advertizement::where('position', 'chamber-page')
        ->where('status', STATUS_ACTIVE)
        ->inRandomOrder()
        ->take(1)
        ->get();

    return $adds;
}

function contact_section()
{
    $contact = ContactSection::first();

    return $contact;
}

function socials()
{
    return $socials = Social::all();
}


function page_seo() {
   $currentUrl = URL::full();

    $custom_path = custom_path($currentUrl);

    return $seo_data = Seo::where('page_id', $custom_path)->first();
}


function custom_path($name) {
    $url = $name;
    $baseUrl = url('/') . '/';
    $path = str_replace($baseUrl, '', $url);
    return $path;
}

function banner() {
    return Banner::first();
}