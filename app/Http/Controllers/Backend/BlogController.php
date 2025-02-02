<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogContent;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class BlogController extends Controller
{
    public function blogCategory_index()
    {
        $datas = BlogCategory::get();
        return view('admin.pages.administration.blogCategory', compact('datas'));
    }
    // public function homeSection_create()
    // {
    //     $sections = section::get();
    //     $mood = 'create';
    //     return view('admin.pages.website.sections', compact('sections', 'mood'));
    // }
    public function blogCategory_store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|unique:blog_categories',
            'status' => 'required'
        ]);
        try {

            BlogCategory::create([
                'name'   => $request->name,
                'slug'   => slugify($request->name),
                'status' => $request->status,
            ]);

            return redirect()->route('admin.blogCategory.index')->with('success', 'Item created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }

    public function blogCategory_edit($id)
    {
        $data = BlogCategory::find($id);
        $datas = BlogCategory::get();
        return view('admin.pages.administration.blogCategory', compact('data', 'datas'));
    }

    public function blogCategory_update(Request $request, $id)
    {

        $request->validate([
            'name'   => 'required|string|unique:blog_categories,id,' . $id,
            'status' => 'required'
        ]);


        try {

            $item = BlogCategory::find($id);

            $item->name   = $request->name;
            $item->slug   = slugify($request->name);
            $item->status = $request->status;
            $item->update();

            return redirect()->route('admin.blogCategory.index')->with('success', 'Updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }
    public function blogCategory_delete($id)
    {
        try {
            blogCategory::findOrFail($id)->delete();

            return redirect()->route('admin.blogCategory.index')->with('success', 'Item deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }





    // ...........................................................................................................



    public function blogContent_index()
    {
        $blogContents = BlogContent::get();
        return view('admin.pages.administration.blogContent.index', compact('blogContents'));
    }
    public function blogContent_create()
    {
        $blogCategories = BlogCategory::where('status', 'active')->get();
        return view('admin.pages.administration.blogContent.create', compact('blogCategories'));
    }
    public function blogContent_store(Request $request)
    {
        $request->validate([
            'blog_category_id' => 'required',
            'title'            => 'required|string',
            'description'      => 'required|string',
            'image'            => 'required',
            'status'           => 'required'
        ]);
        try {
            if ($request->file('image')) {
                $image = $request->file('image');
                $img = Image::read($image->getRealPath());
                $img->resize(400, 250);
                $imageName = date('YmdHis') . '_' . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();

                $img->save(public_path('uploads/' . $imageName));
                $file_image = 'uploads/' . $imageName;
            }

            BlogContent::create([
                'blog_category_id' => $request->blog_category_id,
                'title'            => $request->title,
                'slug'             => slugify($request->title),
                'description'      => $request->description,
                'image'            => $file_image,
                'status'           => $request->status,
            ]);

            return redirect()->route('admin.blogContent.index')->with('success', 'Item created successfully.');
        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }

    public function blogContent_edit($id)
    {
        $data = BlogContent::find($id);
        $blogCategories = BlogCategory::where('status', 'active')->get();
        return view('admin.pages.administration.blogContent.update', compact('data', 'blogCategories'));
    }

    public function blogContent_update(Request $request, $id)
    {

        $request->validate([
            'blog_category_id' => 'required',
            'title'            => 'required|string',
            'description'      => 'required|string',
            // 'image'            => 'required',
            'status'           => 'required'
        ]);


        try {

            $item = BlogContent::find($id);

            if ($request->file('image')) {
                // Check if the file exists
                if (file_exists($item->image)) {
                    // Delete the file
                    unlink($item->image);
                }

                $image = $request->file('image');
                $img = Image::read($image->getRealPath());
                $img->resize(400, 250);
                $imageName = date('YmdHis') . '_' . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();

                $img->save(public_path('uploads/' . $imageName));
                $file_image = 'uploads/' . $imageName;
            } else {
                $file_image = $item->image;
            }

            $item->blog_category_id = $request->blog_category_id;
            $item->title            = $request->title;
            $item->slug             = slugify($request->title);
            $item->description      = $request->description;
            $item->image            = $file_image;
            $item->status           = $request->status;
            $item->update();

            return redirect()->route('admin.blogContent.index')->with('success', 'Updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }
    public function blogContent_delete($id)
    {
        try {
            BlogContent::findOrFail($id)->delete();

            return redirect()->route('admin.blogContent.index')->with('success', 'Item deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }
}