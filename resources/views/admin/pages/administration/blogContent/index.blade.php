@extends('admin.layouts.app')
@section('title')
    Blog Contents
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h6 class="mb-0 text-uppercase">Blog Contents</h6>
        </div>
        <div>
            <a class="btn btn-dark" href="{{ route('admin.blogContent.create') }}"><i class="fadeIn animated bx bx-plus"></i> Add New</a>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogContents as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td><img src="{{ asset('') . $item->image }}" alt="" style="width: 100px"></td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->BlogCategory?->name }}</td>
                                        <td class="text-wrap">{!! $item->description !!}</td>
                                        <td>
                                            @if ($item->status == 'active')
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Inactive</span>
                                            @endif
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.blogContent.edit', $item->id) }}"><i class="fadeIn animated bx bx-pencil"></i></a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('admin.blogContent.delete', $item->id) }}"><i class="fadeIn animated bx bx-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
