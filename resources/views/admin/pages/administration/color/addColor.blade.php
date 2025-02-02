@extends('admin.layouts.app')
@section('title')
    Add Color
@endsection

@section('content')
    <hr />
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="mb-0 text-uppercase">Color</h6>
                </div>
                <div>
                    <a class="btn btn-dark" href="{{ route('admin.color.index') }}"> All Color</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.color.store') }}">
                        @csrf
                        <div class="border p-4 rounded">
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Color Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" placeholder="Color name" value="{{ old('name') }}">
                                    @error('name')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Color Code</label>
                                <div class="col-sm-1">
                                    <input style="height: 50px" type="color" id="favcolor" name="code" class="form-control" placeholder="Color code, ex:#000000" value="{{ old('code') }}">
                                    {{-- <input type="text" name="code" class="form-control" placeholder="Color code, ex:#000000" value="{{ old('code') }}"> --}}
                                    @error('code')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
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
