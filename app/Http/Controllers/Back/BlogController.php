<?php

namespace App\Http\Controllers\Back;

use App\Models\Blog;
use App\Models\BlogTag;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\DataTables\BlogDataTable;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index(BlogDataTable $dataTable)
    {
        return $dataTable->render('back.blog.index');
    }

    public function create()
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        return view('back.blog.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'image' => 'required|mimes:png,jpg',
            'content' => 'required',
            'details' => 'required',
            'status' => 'required',
            'blog_category_id' => 'required'
        ], [
            'blog_category_id.required' => 'The blog category field is required.'
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->image = ImageUpload($request->image, BLOG_PATH);
        $blog->thumbnail = 'image thumbnail';
        $blog->content = $request->content;
        $blog->details = $request->details;
        $blog->custom_css = $request->custom_css;
        $blog->custom_js = $request->custom_js;
        $blog->seo_meta = $request->seo_meta;
        $blog->head_script = $request->head_script;
        $blog->body_script = $request->body_script;
        $blog->blog_category_id = $request->blog_category_id;
        $blog->status = $request->status;

        $blog->save();

        $tagList = [];

        if ($request->tags) {

            $tagString = $request->tags;
            if (substr($tagString, -1) === ',') {
                $tagString = substr($tagString, 0, -1);
            }
            $tags = explode(',',  $tagString);

            foreach ($tags as $t) {
                if ($t != null) {
                    $tag_exist = BlogTag::where('title', $t)->first();
                    if ($tag_exist) {
                        array_push($tagList, $tag_exist->id);
                        continue;
                    } else {
                        $tag = new BlogTag();
                        $tag->title = $t;
                        $tag->slug = Str::slug($t);

                        $tag->save();

                        array_push($tagList, $tag->id);
                    }
                }
            }
        }

        $blog->tags()->attach($tagList);

        return redirect()->route('blog.index')->with('success', 'Blog added successfully');
    }

    public function edit($id)
    {
        $blog = Blog::where('id', $id)->firstOrFail();
        $categories = BlogCategory::all();
        $tags = BlogTag::all();

        $active_tags = [];

        foreach ($blog->tags as $t) {
            array_push($active_tags, $t->title);
        }

        $active_tags = implode(', ', $active_tags);

        return view('back.blog.edit', compact('categories', 'tags', 'blog', 'active_tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|mimes:png,jpg',
            'content' => 'required',
            'details' => 'required',
            'status' => 'required',
            'blog_category_id' => 'required'
        ], [
            'blog_category_id.required' => 'The blog category field is required.'
        ]);


        $blog = Blog::where('id', $id)->firstOrFail();
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $blog->image = ImageUpload($request->image, BLOG_PATH);
            $blog->thumbnail = 'image thumbnail';
        }

        $blog->content = $request->content;
        $blog->details = $request->details;
        $blog->blog_category_id = $request->blog_category_id;
        $blog->status = $request->status;
        $blog->custom_css = $request->custom_css;
        $blog->custom_js = $request->custom_js;
        $blog->seo_meta = $request->seo_meta;
        $blog->head_script = $request->head_script;
        $blog->body_script = $request->body_script;

        $blog->save();

        $tagList = [];

        if ($request->tags) {

            $tagString = $request->tags;
            if (substr($tagString, -1) === ',') {
                $tagString = substr($tagString, 0, -1);
            }
            $tags = explode(',',  $tagString);

            foreach ($tags as $t) {
                if ($t != null) {
                    $tag_exist = BlogTag::where('title', $t)->first();
                    if ($tag_exist) {
                        array_push($tagList, $tag_exist->id);
                        continue;
                    } else {
                        $tag = new BlogTag();
                        $tag->title = $t;
                        $tag->slug = Str::slug($t);

                        $tag->save();

                        array_push($tagList, $tag->id);
                    }
                }
            }
        }

        $blog->tags()->sync($tagList);


        return redirect()->route('blog.index')->with('success', 'Blog updated successfully');
    }

    public function delete(Request $request)
    {
        $blog = Blog::where('id', $request->id)->firstOrFail();
        removeImage($blog->image);
        $blog->tags()->detach($blog->tags);
        $blog->delete();

        return redirect()->route('blog.index')->with('success', 'Blog removed successfully');
    }
}
