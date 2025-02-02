@extends('admin.layouts.app')
@section('title')
    Update Client Reviews
@endsection

@section('content')
    <hr />
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="mb-0 text-uppercase">Update Client Reviews</h6>
                </div>
                <div>
                    <a class="btn btn-dark" href="{{ route('admin.clientReview.index') }}"> All Client Reviews</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.clientReview.update', $data->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="border p-4 rounded">
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-lg-3 col-form-label">Client Name <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="name" class="form-control" placeholder="Client name" value="{{ $data->name }}">
                                </div>
                                @error('name')
                                    <p class="mb-0 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-lg-3 col-form-label">Designation <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="designation" class="form-control" placeholder="Designation" value="{{ $data->designation }}">
                                </div>
                                @error('designation')
                                    <p class="mb-0 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-lg-3 col-form-label">Review <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <textarea name="review" cols="30" rows="4" class="form-control" placeholder="Review text">{{ $data->review }}</textarea>
                                </div>
                                @error('review')
                                    <p class="mb-0 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-lg-3 col-form-label">Image (200X200) <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="file" name="image" class="form-control">
                                    <img src="{{ asset('') . $data->image }}" alt="" style="width: 60px">
                                </div>
                                @error('image')
                                    <p class="mb-0 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmailAddress2" class="col-md-3 col-form-label">Status <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="active" {{ $data->status == 'active' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio1">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="inactive" {{ $data->status == 'inactive' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio2">Inactive</label>
                                    </div>
                                    @error('status')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label"></label>
                                <button type="submit" class="btn btn-dark px-5">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
