@extends('admin.layouts.app')
@section('title')
    Setting
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h6 class="mb-0 text-uppercase">Setting</h6>
        </div>
        <div>
        </div>
    </div>
    <hr />

    <form id="myForm" method="POST" action="{{ route('admin.setting.update', $data->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-lg-3 col-form-label">Delivery Charge (Inside Dhaka) </label>
                                <div class="col-lg-3">
                                    <input type="number" name="d_charge_inside_dhaka" class="form-control" placeholder="Charge" value="{{ old('d_charge_inside_dhaka') }}">
                                    &#2547; {{ $data->d_charge_inside_dhaka }}
                                </div>
                                <label for="inputPhoneNo2" class="col-lg-3 col-form-label">Delivery Charge (Outside Dhaka) </label>
                                <div class="col-lg-3">
                                    <input type="number" name="d_charge_outside_dhaka" class="form-control" placeholder="Charge" value="{{ old('d_charge_outside_dhaka') }}">
                                    &#2547; {{ $data->d_charge_outside_dhaka }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                {{-- <div class="card">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="form-group mb-3">
                                <label for="inputPhoneNo2" class="col-form-label">Facebook </label>
                                <input type="text" name="facebook" class="form-control" placeholder="Facebook" value="{{ $websiteInfo->facebook }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="inputPhoneNo2" class="col-form-label">Twitter </label>
                                <input type="text" name="twitter" class="form-control" placeholder="Twitter" value="{{ $websiteInfo->twitter }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="inputPhoneNo2" class="col-form-label">Youtube</label>
                                <input type="text" name="youtube" class="form-control" placeholder="Youtube" value="{{ $websiteInfo->youtube }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="inputPhoneNo2" class="col-form-label">LinkedIn</label>
                                <input type="text" name="linkedin" class="form-control" placeholder="LinkedIn" value="{{ $websiteInfo->linkedin }}">
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            {{-- <div class="col-12">
                <div class="form-group mb-3">
                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Contact Information <span class="text-danger">*</span></label>
                    <textarea name="contact_info" id="editor">{{ $websiteInfo->contact_info }}</textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group mb-3">
                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Our History <span class="text-danger">*</span></label>
                    <textarea name="our_history" id="editor1">{{ $websiteInfo->our_history }}</textarea>
                </div>
            </div> --}}
            <div class="col-12">
                <div class="form-group">
                    <label class="col-form-label"></label>
                    <button type="submit" class="btn btn-dark px-5">Update</button>
                </div>
            </div>
        </div>
    </form>
@endsection


{{-- @push('css')
    <style>
        .cke_notifications_area {
            display: none;
        }
    </style>
@endpush
@push('js')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
        CKEDITOR.replace('editor1');
    </script>
@endpush --}}
