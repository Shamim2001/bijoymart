<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.pages.administration.brand.index', compact('brands'));
    }
    public function create()
    {
        $brands = Brand::all();
        return view('admin.pages.administration.brand.addBrand', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string',
            'status' => 'required'
        ]);
        try {
            $request['slug']      = slugify($request->name);
            $request['create_by'] = Auth::id();
            Brand::create($request->all());

            return redirect()->route('admin.brand.index')->with('success', 'Item created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }


    public function edit($id)
    {
        $data = Brand::find($id);
        $brands = Brand::all();
        return view('admin.pages.administration.brand.updateBrand', compact('data', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required|string|unique:brands,id,' . $id,
            'status' => 'required'
        ]);


        try {
            $item = Brand::find($id);

            $item->name      = $request->name;
            $item->status    = $request->status;
            $item->create_by = Auth::id();
            $item->update();

            return redirect()->route('admin.brand.index')->with('success', 'Updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }

    public function delete($id)
    {

        try {
            Brand::findOrFail($id)->delete();

            return redirect()->route('admin.brand.index')->with('success', 'Item deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }
}
