@extends('admin.layouts.app')
@section('title')
    Staff
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h6 class="mb-0 text-uppercase">Staff</h6>
        </div>
        <div>
            <a class="btn btn-dark" href="{{ route('admin.staff.create') }}"><i class="fadeIn animated bx bx-plus"></i> Add New</a>
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
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>User Type</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td><img src="{{ asset('') . $item->avatar }}" alt="" style="width: 60px"></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->user_type }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>
                                            @if ($item->status == 'active')
                                                <span class="text-success">Active</span>
                                            @elseif ($item->status == 'inactive')
                                                <span class="badge text-bg-warning">Inactive</span>
                                            @else
                                                <span class="badge text-bg-danger">Suspend</span>
                                            @endif
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.staff.edit', $item->id) }}"><i class="fadeIn animated bx bx-pencil"></i></a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('admin.staff.delete', $item->id) }}"><i class="fadeIn animated bx bx-trash-alt"></i></a>
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
