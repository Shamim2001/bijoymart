@extends('admin.layouts.app')
@section('title')
    Add Blog Content
@endsection

@section('content')
    <hr />
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="mb-0 text-uppercase">Blog Content</h6>
                </div>
                <div>
                    <a class="btn btn-dark" href="{{ route('admin.blogContent.index') }}"> All Content</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.blogContent.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="border p-4 rounded">
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Select Category</label>
                                <div class="col-sm-9">
                                    <select name="blog_category_id" class="form-control">
                                        <option value="" selected>Select Category</option>
                                        @foreach ($blogCategories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('title')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" class="form-control" placeholder="Title of the content" value="{{ old('title') }}">
                                    @error('title')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Image [400x250]</label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" class="form-control">
                                    @error('image')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row mb-3">
                                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Description <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="description" id="editor"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="active" checked>
                                        <label class="form-check-label" for="inlineRadio1">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="inactive">
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
                                    <button type="submit" class="btn btn-dark px-5">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    </script>
@endpush
