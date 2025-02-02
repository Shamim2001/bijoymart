@extends('admin.layouts.app')
@section('title')
    Add Staff
@endsection

@section('content')
    <hr />
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h6 class="mb-0 text-uppercase">Add Staff</h6>
                </div>
                <div>
                    <a style="margin-top: -10px" class="btn btn-dark" href="{{ route('admin.staff.index') }}"> All Staff</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.staff.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="border p-4 rounded">
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-lg-3 col-form-label">Name <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="name" class="form-control" placeholder="name" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <p class="mb-0 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-lg-3 col-form-label">Email <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="email" class="form-control" placeholder="email" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <p class="mb-0 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-lg-3 col-form-label">Phone <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="phone" class="form-control" placeholder="phone" value="{{ old('phone') }}">
                                </div>
                                @error('phone')
                                    <p class="mb-0 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-lg-3 col-form-label">Password <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="password" class="form-control" placeholder="password" value="{{ old('password') }}">
                                </div>
                                @error('password')
                                    <p class="mb-0 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmailAddress2" class="col-md-3 col-form-label">Status <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="active" checked>
                                        <label class="form-check-label" for="inlineRadio1">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="inactive">
                                        <label class="form-check-label" for="inlineRadio2">Inactive</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="suspend">
                                        <label class="form-check-label" for="inlineRadio3">Suspend</label>
                                    </div>
                                    @error('status')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label"></label>
                                <button type="submit" class="btn btn-dark px-5">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
