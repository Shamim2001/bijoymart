@extends('admin.layouts.app')
@section('title')
    Company Information
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h6 class="mb-0 text-uppercase">Company Information</h6>
        </div>
        <div>
        </div>
    </div>
    <hr />

    <form id="myForm" method="POST" action="{{ route('admin.website.info.update', $websiteInfo->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="form-group mb-3">
                                <label for="inputPhoneNo2" class="col-form-label">Comapny Name </label>
                                <input type="text" name="company_name" class="form-control" placeholder="Comapny name" value="{{ $websiteInfo->company_name }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="inputPhoneNo2" class="col-form-label">Address </label>
                                <input type="text" name="address" class="form-control" placeholder="Address" value="{{ $websiteInfo->address }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="inputPhoneNo2" class="col-form-label">Website</label>
                                <input type="text" name="website" class="form-control" placeholder="https://" value="{{ $websiteInfo->website }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="inputPhoneNo2" class="col-form-label">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="info@example.com" value="{{ $websiteInfo->email }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="inputPhoneNo2" class="col-form-label">Contact Number</label>
                                <input type="text" name="contact_no" class="form-control" placeholder="8801..." value="{{ $websiteInfo->contact_no }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="inputPhoneNo2" class="col-form-label">Working Hours</label>
                                <input type="text" name="working_hours" class="form-control" placeholder="Mon - Sun / 9:00AM - 8:00PM" value="{{ $websiteInfo->working_hours }}">
                            </div>
                            <div class="form-goup mb-3">
                                <label for="inputPhoneNo2" class=" col-form-label">company Logo (250X130) (.png)</label>
                                <input type="file" name="logo" class="form-control">
                                <img src="{{ asset('/') . $websiteInfo->logo }}" alt="" style="height: 80px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
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
                </div>
            </div>
            <div class="col-12">
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
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="col-form-label"></label>
                    <button type="submit" class="btn btn-dark px-5">Update</button>
                </div>
            </div>
        </div>
    </form>
@endsection


@push('css')
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
@endpush
