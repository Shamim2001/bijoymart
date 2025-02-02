<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.pages.administration.category.index', compact('categories'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.administration.category.addCategory', compact('categories'));
    }

    // public function create()
    // {
    //     return view('backend.administration.department.create');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'root'   => 'required|string|max:255',
            'name'   => 'required|string',
            // 'image' => 'nullable',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required'
        ]);

        try {
            // Category::create($request->all());

            // if ($request->file('image')) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $img = Image::read($image->getRealPath());
                $img->resize(300, 300);
                $imageName = date('YmdHis') . '_' . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();

                $img->save(public_path('uploads/' . $imageName));
                $request['image'] = 'uploads/' . $imageName;
            }

            $request['slug']      = slugify($request->name);
            $request['create_by'] = Auth::id();

            Category::create($request->all());

            return redirect()->route('admin.category.index')->with('success', 'Item created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }


    public function edit($id)
    {
        $data = Category::find($id);
        $categories = Category::all();
        return view('admin.pages.administration.category.updateCategory', compact('data', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'root'   => 'required|string',
            'name'   => 'required|string|unique:categories,id,' . $id,
            'status' => 'required'
        ]);


        try {
            $item = Category::find($id);


            if ($request->file('image')) {
                // Check if the file exists
                if (file_exists($item->image)) {
                    // Delete the file
                    unlink($item->image);
                }

                $image = $request->file('image');
                $img = Image::read($image->getRealPath());
                $img->resize(300, 300);
                $imageName = date('YmdHis') . '_' . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();

                $img->save(public_path('uploads/' . $imageName));
                $file_name = 'uploads/' . $imageName;
            } else {
                $file_name = $item->image;
            }

            $item->root      = $request->root;
            $item->name      = $request->name;
            $item->slug      = slugify($request->name);
            $item->image     = $file_name;
            $item->status    = $request->status;
            $item->create_by = Auth::id();
            $item->update();

            return redirect()->route('admin.category.index')->with('success', 'Updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }

    public function delete($id)
    {

        try {
            Category::findOrFail($id)->delete();

            return redirect()->route('admin.category.index')->with('success', 'Item deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }

    public function updateCategoryStatus(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required',
            'id' => 'required|integer'
        ]);
        try {
            $category = Category::find($request->id);
            if ($category && $request->status == 'true') {
                Category::where('id', $request->id)->update(['home_category' => 'active']);
            } else {
                Category::where('id', $request->id)->update(['home_category' => 'inactive']);
            }

            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Item not found'], 404);
        }
    }
}
