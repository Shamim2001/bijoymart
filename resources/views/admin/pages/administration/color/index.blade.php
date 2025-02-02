@extends('admin.layouts.app')
@section('title')
    Color
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h6 class="mb-0 text-uppercase">Color</h6>
        </div>
        <div>
            {{-- <a class="btn btn-dark" href="{{ route('admin.color.create') }}"><i class="fadeIn animated bx bx-plus"></i> Add New</a> --}}
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
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($colors as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <div style="height: 30px;width:30px;background:{{ $item->code }}"></div>
                                        </td>
                                        <td>
                                            @if ($item->status == 'active')
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Inactive</span>
                                            @endif
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.color.edit', $item->id) }}"><i class="fadeIn animated bx bx-pencil"></i></a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('admin.color.delete', $item->id) }}"><i class="fadeIn animated bx bx-trash-alt"></i></a>
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
