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
            <h6 class="mb-0 text-uppercase">All Orders</h6>
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
                                    <th><input type="checkbox" id="selectAll"></th>
                                    <th>Order No</th>
                                    <th>Product Qty</th>
                                    <th>Product Name</th>
                                    <th>Product Size</th>
                                    <th>Product color</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Delivery Status</th>
                                    <th>Payment Method</th>
                                    {{-- <th>Payment Status</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $product)

                                    <tr>
                                        <td><input type="checkbox" class="select-row" value="{{ $product->id }}"></td>
                                        <td>{{ $product->order_no }}</td>

                                        @foreach ($product->OrderDetails as $details)
                                            <td>{{ $details->quantity }} <small>x</small> </td>
                                            <td>{{ $details->product_name }}</td>
                                            <td>{{ $details->size ? $details->size : '' }}</td>


                                            {{-- <td>{{ $colorMap[$details->color] ?? 'Unknown' }}</td> --}}
                                            <td>
                                                <div class="form-check form-check-inline" style="position: relative">
                                                    <label class="form-check-label" for="">
                                                        <div style="height: 25px;width: 25px;background-color:{{ $colorMap[$details->color] ?? 'null' }}"></div>
                                                    </label>
                                                </div>
                                            </td>
                                            {{-- <td>{{ $details->color ? $details->color : '0' }}</td> --}}


                                        @endforeach

                                        <td>{{ $product->customer_name }} <br>{{ $product->customer_phone }} <br>{{ $product->shipping_address }}</td>

                                        <td>&#2547; {{ $product->total }}</td>
                                        <td>{{ $product->delivery_status }}</td>
                                        <td>{{ $product->payment_status }}</td>

                                        <td>
                                            {{-- <a class="btn btn-sm btn-warning px-1" title="view" href="{{ route('admin.order.details',$product->id) }}"><i class="fadeIn animated bx bx-show-alt"></i></a> --}}

                                            <a class="btn btn-sm btn-info px-1" title="edit" href="{{ route('admin.order.editstatus', $product->id) }}"><i class="fadeIn animated bx bx-pencil"></i></a>
                                            <a class="btn btn-sm btn-success px-1" title="download" href="#"><i class="fadeIn animated bx bx-download"></i></a>
                                            {{-- <a class="btn btn-sm btn-danger px-1" title="delete" href="{{ route('admin.product.delete', $product->id) }}"><i class="fadeIn animated bx bx-trash-alt"></i></a> --}}
                                        </td>
                                    </tr>
                                    {{-- @endforeach --}}
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                    {{-- <button type="button" id="updateSelected" class="btn btn-primary mt-3">Update Selected</button> --}}
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
