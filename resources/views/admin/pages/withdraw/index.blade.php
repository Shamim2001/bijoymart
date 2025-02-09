@extends('admin.layouts.app')
@section('title')
    Withdrawals
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h6 class="mb-0 text-uppercase">Withdrawals</h6>
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
                                    <th>Email</th>
                                    <th>Amount</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdrawals as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->customer?->name }}</td>
                                        <td>{{ $item->customer?->email }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>{{ $item->customer?->phone }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.withdraw.approve', $item->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <select name="delivery_status" required style="height: 35px; border-color:red">
                                                    <option value="pending" {{ $item->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="approved" {{ $item->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                                    <option value="cancelled" {{ $item->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                            {{-- <span class="badge text-bg-warning">Inactive</span> --}}
                                            {{-- <span class="badge text-capitalize {{ $item->status == 'approved' ? 'text-success' : 'text-bg-danger' }}">{{ $item->status }}</span> --}}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.withdraw.edit', $item->id) }}"><i class="fadeIn animated bx bx-pencil"></i></a>
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
