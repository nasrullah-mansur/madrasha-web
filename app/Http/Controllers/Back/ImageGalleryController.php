<?php

namespace App\Http\Controllers\Back;

use App\DataTables\ImageGalleryDataTable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ImageGallery;
use App\Models\ImageGalleryCategory;

class ImageGalleryController extends Controller
{
    public function index_category()
    {
        $categories = ImageGalleryCategory::with('items')->orderBy('created_at', 'desc')->get();
        return view('back.gallery.image_category.index', compact('categories'));
    }

    public function create_category()
    {
        return view('back.gallery.image_category.create');
    }

    public function store_category(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:image_gallery_categories'
        ]);

        $category = new ImageGalleryCategory();

        $category->title = $request->title;
        $category->slug = Str::slug($request->title);
        $category->save();

        return redirect()->route('image_gallery_category.index')->with('success', 'Video gallery category added successfully');
    }

    public function edit_category($id)
    {
        $category = ImageGalleryCategory::where('id', $id)->firstOrFail();
        return view('back.gallery.image_category.edit', compact('category'));
    }

    public function update_category(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:image_gallery_categories'
        ]);

        $category = ImageGalleryCategory::where('id', $id)->firstOrFail();

        $category->title = $request->title;
        $category->slug = Str::slug($request->title);
        $category->save();

        return redirect()->route('image_gallery_category.index')->with('success', 'Video gallery category added successfully');
    }

    public function delete_category(Request $request)
    {
        $category = ImageGalleryCategory::where('id', $request->id)->firstOrFail();
        if ($category->items->count() == 0) {
            $category->delete();
            return 'success';
        } else {
            return 'Please remove gallery items first that under this category then try again';
        }
    }

    // ============ Image Gallery ===========
    public function index(ImageGalleryDataTable $dataTable)
    {
        return $dataTable->render('back.gallery.image.index');
    }

    function create()
    {
        $categories = ImageGalleryCategory::all();
        return view('back.gallery.image.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg',
            'image_gallery_category_id' => 'required'
        ]);

        $gallery = new ImageGallery();
        $gallery->image = ImageUpload($request->image, IMAGE_GALLERY_PATH);
        $gallery->image_gallery_category_id = $request->image_gallery_category_id;
        $gallery->status = $request->status;
        $gallery->save();

        return redirect()->route('image_gallery.index')->with('success', 'Gallery item added successfully');
    }

    public function edit($id)
    {
        $categories = ImageGalleryCategory::all();
        $gallery = ImageGallery::where('id', $id)->firstOrFail();
        return view('back.gallery.image.edit', compact('categories', 'gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = ImageGallery::where('id', $id)->firstOrFail();
        $request->validate([
            'image' => 'nullable|mimes:png,jpg',
            'image_gallery_category_id' => 'required'
        ]);


        if ($request->hasFile('image')) {
            $gallery->image = ImageUpload($request->image, IMAGE_GALLERY_PATH);
        }
        $gallery->image_gallery_category_id = $request->image_gallery_category_id;
        $gallery->status = $request->status;
        $gallery->save();

        return redirect()->route('image_gallery.index')->with('success', 'Gallery item updated successfully');
    }

    public function delete(Request $request)
    {
        $gallery = ImageGallery::where('id', $request->id)->firstOrFail();
        $gallery->delete();
    }

    // ================== Front ======================;
    public function image_gallery()
    {
        $categories = ImageGalleryCategory::all();
        $galleries = ImageGallery::orderBy('created_at', 'DESC')
            ->where('status', STATUS_ACTIVE)
            ->paginate(6);

        $title = 'Image Gallery';

        return view('front.gallery.image.index', compact('categories', 'galleries', 'title'));
    }

    public function image_gallery_by_category($slug)
    {
        $category = ImageGalleryCategory::where('slug', $slug)->firstOrFail();
        $categories = ImageGalleryCategory::all();
        $galleries = ImageGallery::where('image_gallery_category_id', $category->id)
            ->where('status', STATUS_ACTIVE)
            ->orderBy('created_at', 'DESC')->paginate(6);

        $active_slug = $slug;

        $title = $category->title;

        return view('front.gallery.image.category', compact('categories', 'galleries', 'title', 'active_slug'));
    }
}
