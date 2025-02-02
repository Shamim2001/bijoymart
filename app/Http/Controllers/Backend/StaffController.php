<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $datas = User::where('user_type', 'staff')->get();
        return view('admin.pages.staff.index', compact('datas'));
    }
    public function create()
    {
        return view('admin.pages.staff.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email:rfc,dns|unique:users',
            'phone'    => 'required|regex:/^(01[3-9]\d{8})$/',
            'password' => 'required|string',
            // 'image'       => 'required',
            'status'      => 'required'
        ]);
        try {
            // if ($request->file('image')) {
            //     $image = $request->file('image');
            //     $img = Image::read($image->getRealPath());
            //     $img->resize(200, 200);
            //     $imageName = date('YmdHis') . '_' . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();

            //     $img->save(public_path('uploads/' . $imageName));
            //     $file_image = 'uploads/' . $imageName;
            // }

            User::create([
                'name'      => $request->name,
                'user_type' => 'staff',
                'email'     => $request->email,
                'phone'     => $request->phone,
                'password'  => Hash::make($request->password),
                'status'    => $request->status,
            ]);

            return redirect()->route('admin.staff.index')->with('success', 'Created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('admin.pages.staff.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email:rfc,dns|unique:users,id,' . $id,
            'phone'    => 'required|regex:/^(01[3-9]\d{8})$/',
            'password' => 'nullable|string',
            'status'   => 'required'
        ]);


        try {

            $staff         = User::find($id);

            // if ($request->file('image')) {
            //     // Check if the file exists
            //     if (file_exists($item->image)) {
            //         // Delete the file
            //         unlink($item->image);
            //     }

            //     $image = $request->file('image');
            //     $img = Image::read($image->getRealPath());
            //     $img->resize(200, 200);
            //     $imageName = date('YmdHis') . '_' . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();

            //     $img->save(public_path('uploads/' . $imageName));
            //     $file_image = 'uploads/' . $imageName;
            // } else {
            //     $file_image = $item->image;
            // }
            if ($staff) {

                $dataUpdate = [
                    'name'      => $request->name,
                    'user_type' => 'staff',
                    'email'     => $request->email,
                    'phone'     => $request->phone,
                    'status'    => $request->status,
                ];
                if ($request->password != '') {
                    $dataUpdate['password'] = Hash::make($request->password);
                }
                $staff->update($dataUpdate);
            }


            return redirect()->route('admin.staff.index')->with('success', 'Updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }
    public function delete($id)
    {
        try {
            $staff = User::find($id);
            if ($staff) {
                $staff->update(['status' => 'suspend']);
            }

            return redirect()->route('admin.staff.index')->with('success', 'Staff deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Somethng going wrong. try later.');
        }
    }
}
