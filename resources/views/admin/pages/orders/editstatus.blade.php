@extends('admin.layouts.app')
@section('title')
    All Products
@endsection
@push('css')
    <style>
        .form-check-input {
            height: 1.3em;
        }
    </style>
@endpush

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h6 class="mb-0 text-uppercase">Edit Orders</h6>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="table table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Order No</th>
                                        <th>Product Details</th>
                                        <th>Customer Details</th>
                                        <th>Total's</th>
                                        <th>Delivery Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $order->order_no }}</td>
                                        @foreach ($order->OrderDetails as $details)
                                            <td>Name: {{ $details->product_name }} <br> Quantity: {{ $details->quantity }}<small>x</small> <br> Size: {{ $details->size ?? '' }} <br> Color:
                                                <div class="form-check form-check-inline" style="position: relative">
                                                    <label class="form-check-label" for="">
                                                        <div style="height: 15px;width: 15px;background-color:{{ $colorMap[$details->color] ?? 'null' }}"></div>
                                                    </label>
                                                </div>
                                            </td>
                                        @endforeach
                                        <td>{{ $order->customer_name }} <br>{{ $order->customer_phone }} <br>{{ $order->shipping_address }}</td>
                                        <td>&#2547; {{ $order->total }}</td>

                                        <td>
                                            <form method="POST" action="{{ route('admin.order.updateStatus', $order->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <select name="delivery_status" required style="height: 35px; border-color:red">
                                                    <option value="Pending" {{ $order->delivery_status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Approved" {{ $order->delivery_status === 'Approved' ? 'selected' : '' }}>Approved</option>
                                                    <option value="Shipping" {{ $order->delivery_status === 'Shipping' ? 'selected' : '' }}>Shipping</option>
                                                    <option value="Delivered" {{ $order->delivery_status === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                                    <option value="Cancelled" {{ $order->delivery_status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Add CSRF token to the headers for POST requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle form submission
            $('.form-check-input').on('change', function() {
                var isChecked = $(this).is(':checked'); // Get checked status (true or false)
                // var checkboxId = $(this).attr('id'); // Get dynamic ID of the checkbox
                var itemId = $(this).data('id'); // Optionally send an item ID (or other data)

                $.ajax({
                    url: '{{ route('admin.product.update.status') }}', // URL to your route
                    type: 'POST',
                    data: {
                        status: isChecked, // Send checked status
                        id: itemId // Optionally send item ID
                    },

                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                        } else {
                            toastr.warning(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('An error occurred: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#example').DataTable();

            // Handle Select All Checkbox
            $('#selectAll').on('click', function() {
                var rows = table.rows({
                    'search': 'applied'
                }).nodes();
                $('input[type="checkbox"].select-row', rows).prop('checked', this.checked);
            });

            // Handle Row Checkbox Selection
            $('#example tbody').on('change', '.select-row', function() {
                if (!this.checked) {
                    var el = $('#selectAll').get(0);
                    if (el && el.checked && ('indeterminate' in el)) {
                        el.indeterminate = true;
                    }
                }
            });

            // // Handle Update Button Click (AJAX Request)
            // $('#updateSelected').on('click', function() {
            //     var selectedIds = [];
            //     // Get all selected checkboxes
            //     $('.select-row:checked').each(function() {
            //         selectedIds.push($(this).val());
            //     });

            //     if (selectedIds.length === 0) {
            //         toastr.warning('No rows selected!');
            //         return;
            //     }

            //     // Send AJAX request with selected IDs
            //     $.ajax({
            //         url: '{{ route('admin.product.review') }}', // Update with your route
            //         type: 'POST',
            //         data: {
            //             ids: selectedIds
            //         },
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         success: function(response) {
            //             if (response.success) {
            //                 toastr.success('Selected rows updated successfully!');
            //             } else {
            //                 toastr.error('Failed to update selected rows.');
            //             }
            //         },
            //         error: function(xhr, status, error) {
            //             toastr.error('An error occurred: ' + xhr.responseText);
            //         }
            //     });
            // });
        });
    </script>
@endpush
