<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        // dd($colors);
        return view('admin.pages.administration.color.index', compact('colors'));
    }
    public function create()
    {
        return view('admin.pages.administration.color.addColor');
    }

    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name'   => 'required|string',
            'code'   => 'required',
            'status' => 'required'
        ]);
        try {

            Color::create($request->all());

            return redirect()->route('admin.color.index')->with('success', 'Item created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
            // return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }


    public function edit($id)
    {
        $data = Color::find($id);

        return view('admin.pages.administration.color.updateColor', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required|string|unique:brands,id,' . $id,
            'code'   => 'required|string',
            'status' => 'required'
        ]);


        try {
            $item = Color::find($id);

            $item->name      = $request->name;
            $item->code      = $request->code;
            $item->status    = $request->status;
            $item->update();

            return redirect()->route('admin.color.index')->with('success', 'Updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }

    public function delete($id)
    {

        try {
            Color::findOrFail($id)->delete();

            return redirect()->route('admin.color.index')->with('success', 'Item deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }
}
