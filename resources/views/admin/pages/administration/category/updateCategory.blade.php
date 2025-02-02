@extends('admin.layouts.app')
@section('title')
    Update Category
@endsection

@section('content')
    <hr />
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="mb-0 text-uppercase">Category</h6>
                </div>
                <div>
                    <a class="btn btn-dark" href="{{ route('admin.category.index') }}"> All Category</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.category.update', $data->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="border p-4 rounded">
                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-sm-3 col-form-label">Root Category</label>
                                <div class="col-sm-9">
                                    <select class="single-select" class="form-control" name="root">
                                        <option value="0">Select Root Category</option>
                                        {!! getCategory($categories, 2, $data->root) !!}
                                    </select>
                                    @error('root')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-sm-3 col-form-label">category Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" placeholder="Category name" value="{{ $data->name }}">
                                    @error('name')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" class="form-control">
                                    @error('image')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                    <img src="{{ $data->image }}" alt="" style="width: 60px">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
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

                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-dark px-5">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
