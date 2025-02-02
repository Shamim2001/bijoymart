@extends('frontend.components.layout')

@section('title')
    My Account
@endsection

@push('css')
    <style>
        .form-check-input {
            height: 1.3em;
        }
        tbody, td, tfoot, th, thead, tr {
            border: 1px solid;
        }
        form {
            margin-bottom: 0;
        }
    </style>
@endpush

@section('topmenu')
    @include('frontend.components.topmenu')
@endsection

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                @include('frontend.customer.leftmenu')
                <div class="col-lg-9 order-lg-last dashboard-content">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-head">
                                    <p class="px-4 pb-0 mb-0"><strong>Wishlist</strong></p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Product Price</th>
                                                    <th>Product Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product as $item)
                                                    <tr>
                                                        @php
                                                            $final_price = ($item->selling_price - $item->discount_price);
                                                        @endphp
                                                        <td><a href="{{ route('product', $item->slug) }}">{{ $item->name }}</a></td>
                                                        <td>
                                                            <del class="text-danger px-4">৳{{ $item->selling_price }}</del>
                                                            <span class="text-success">৳ {{ $final_price }}</span>
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('customer.clearwishlist') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="productId" value="{{ $item->id }}">
                                                                <button type="submit" class="border-0" style="color: red">
                                                                    <i class="fa fa-trash fa-2x" aria-hidden="true"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                    {{-- <button type="button" id="updateSelected" class="btn btn-primary mt-3">Update Selected</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>


                </div><!-- End .col-lg-9 -->


            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->

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
        });
    </script>
@endpush
