@extends('admin.layouts.app')
@section('title')
    Home Section
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h6 class="mb-0 text-uppercase">Home Section</h6>
        </div>
        <div>
            @if (isset($data))
                <a class="btn btn-dark" href="{{ route('admin.home.section.index') }}"><i class="fadeIn animated bx bx-plus"></i> Add New</a>
            @endif
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>title</th>
                                    <th>Name</th>
                                    <th>Serial</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sections as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->serial }}</td>
                                        <td>
                                            @if ($item->status == 'active')
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Inactive</span>
                                            @endif
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.home.section.edit', $item->id) }}"><i class="fadeIn animated bx bx-pencil"></i></a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('admin.home.section.delete', $item->id) }}"><i class="fadeIn animated bx bx-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    @if (isset($data))
                        <form method="POST" action="{{ route('admin.home.section.update', $data->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="border p-4 rounded">
                                <div class="row mb-3">
                                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Section Title <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="single-select form-control" name="title">
                                            <option value="" selected>Select Title</option>
                                            <option value="scroll" {{ $data->title = 'scroll' ? 'selected' : '' }}>Scroll</option>
                                            <option value="new_arrival" {{ $data->title = 'new_arrival' ? 'selected' : '' }}>New Arrival</option>
                                            <option value="single_banner" {{ $data->title = 'single_banner' ? 'selected' : '' }}>Single Banner</option>
                                            <option value="single_card" {{ $data->title = 'single_card' ? 'selected' : '' }}>Single Card</option>
                                        </select>
                                        @error('title')
                                            <p class="mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Section Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control" placeholder="Section name" value="{{ $data->name }}">
                                        @error('name')
                                            <p class="mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Serial <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="serial" class="form-control" placeholder="Section serial" value="{{ $data->serial }}">
                                        @error('serial')
                                            <p class="mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Status <span class="text-danger">*</span></label>
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
                    @else
                        <form method="POST" action="{{ route('admin.home.section.store') }}">
                            @csrf
                            <div class="border p-4 rounded">
                                <div class="row mb-3">
                                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Section Title <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="single-select form-control" name="title">
                                            <option value="" selected>Select Title</option>
                                            <option value="scroll">Scroll</option>
                                            <option value="new_arrival">New Arrival</option>
                                            <option value="single_banner">Single Banner</option>
                                            <option value="single_card">Single Card</option>
                                        </select>
                                        @error('title')
                                            <p class="mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Section Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control" placeholder="Section name" value="{{ old('name') }}">
                                        @error('name')
                                            <p class="mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Serial <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="serial" class="form-control" placeholder="Section serial" value="{{ old('serial') }}">
                                        @error('serial')
                                            <p class="mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Status <span class="text-danger">*</span></label>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
