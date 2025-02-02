@extends('admin.layouts.app')
@section('title')
    Blog Category
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h6 class="mb-0 text-uppercase">Blog Category</h6>
        </div>
        <div>
            @if (isset($data))
                <a class="btn btn-dark" href="{{ route('admin.blogCategory.index') }}"><i class="fadeIn animated bx bx-plus"></i> Add New</a>
            @endif
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @if ($item->status == 'active')
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Inactive</span>
                                            @endif
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.blogCategory.edit', $item->id) }}"><i class="fadeIn animated bx bx-pencil"></i></a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('admin.blogCategory.delete', $item->id) }}"><i class="fadeIn animated bx bx-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    @if (isset($data))
                        <form method="POST" action="{{ route('admin.blogCategory.update', $data->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="border p-4 rounded">
                                <div class="form-group mb-3">
                                    <label for="inputPhoneNo2" class="col-form-label">Category Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Section name" value="{{ $data->name }}">
                                    @error('name')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="inputEmailAddress2" class="col-form-label">Status <span class="text-danger">*</span></label>
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

                                <div class="form-group">
                                    <label class="col-form-label"></label>
                                    <button type="submit" class="btn btn-dark px-5">Update</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.blogCategory.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="border p-4 rounded">
                                <div class="form-group mb-3">
                                    <label for="inputPhoneNo2" class="col-form-label">Category Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Section name" value="{{ old('name') }}">
                                    @error('name')
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
