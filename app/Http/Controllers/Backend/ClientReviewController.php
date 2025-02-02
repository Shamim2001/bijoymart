<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ClientReview;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class ClientReviewController extends Controller
{
    public function index()
    {
        $datas = ClientReview::get();
        return view('admin.pages.administration.ClientReview.index', compact('datas'));
    }
    public function create()
    {
        return view('admin.pages.administration.ClientReview.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string',
            'designation' => 'required',
            'review'      => 'required|string',
            // 'image'       => 'required',
            'status'      => 'required'
        ]);
        try {
            if ($request->file('image')) {
                $image = $request->file('image');
                $img = Image::read($image->getRealPath());
                $img->resize(200, 200);
                $imageName = date('YmdHis') . '_' . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();

                $img->save(public_path('uploads/' . $imageName));
                $file_image = 'uploads/' . $imageName;
            }

            ClientReview::create([
                'name'        => $request->name,
                'designation' => $request->designation,
                'review'      => $request->review,
                'image'       => $file_image,
                'status'      => $request->status,
            ]);

            return redirect()->route('admin.clientReview.index')->with('success', 'Item created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }

    public function edit($id)
    {
        $data = ClientReview::find($id);
        return view('admin.pages.administration.ClientReview.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name'        => 'required|string',
            'designation' => 'required',
            'review'      => 'required|string',
            // 'image'       => 'required',
            'status'      => 'required'
        ]);


        try {

            $item         = ClientReview::find($id);

            if ($request->file('image')) {
                // Check if the file exists
                if (file_exists($item->image)) {
                    // Delete the file
                    unlink($item->image);
                }

                $image = $request->file('image');
                $img = Image::read($image->getRealPath());
                $img->resize(200, 200);
                $imageName = date('YmdHis') . '_' . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();

                $img->save(public_path('uploads/' . $imageName));
                $file_image = 'uploads/' . $imageName;
            } else {
                $file_image = $item->image;
            }

            $item->name   = $request->name;
            $item->designation = $request->designation;
            $item->review   = $request->review;
            $item->image  = $file_image;
            $item->status = $request->status;
            $item->update();

            return redirect()->route('admin.clientReview.index')->with('success', 'Updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }
    public function delete($id)
    {
        try {
            ClientReview::findOrFail($id)->delete();

            return redirect()->route('admin.clientReview.index')->with('success', 'Item deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }
}