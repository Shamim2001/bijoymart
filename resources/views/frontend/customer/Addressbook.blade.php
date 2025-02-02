@extends('frontend.components.layout')

@section('title')
    Address Book
@endsection

@section('topmenu')
    @include('frontend.components.topmenu')
@endsection

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Address Book</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-last dashboard-content">
                    {{-- <h2>Address Book</h2> --}}

                    @if (Session::has('message'))
                        <div class="alert alert-{{ Session::get('status') }} text-center">{{ Session::get('message') }}
                        </div>
                    @endif

                    <div class="card" id="default" style="display: ">
                        <div class="card-header d-flex">
                            <div class="mr-auto">
                                Address Book
                            </div>
                            <div class="text-right">
                                <a href="#" class="btn btn-sm btn-primary py-1" id="shipping_button">MAKE DEFAULT SHIPPING
                                    ADDRESS</a>
                                <a href="#" class="btn btn-sm btn-primary py-1" id="billing_button">MAKE DEFAULT BILLING
                                    ADDRESS</a>
                            </div>
                        </div><!-- End .card-header -->

                        <div class="card-body">
                            <div class="row">
                                <table class="table table-border">
                                    <thead>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody style="font-size: 12px">
                                        @foreach ($customer_address as $cus_address)
                                            <tr>
                                                <td>{{ $cus_address->full_name }}</td>
                                                <td style="width: 250px">{{ $cus_address->address }}</td>
                                                <td>{{ $cus_address->phone }}</td>
                                                <td>
                                                    @if ($cus_address->default_address == 1)
                                                        Default Address
                                                    @endif
                                                    <br>
                                                    @if ($cus_address->shipping_address == 1)
                                                        Shipping Address
                                                    @endif
                                                    <br>
                                                    @if ($cus_address->billing_address == 1)
                                                        Billing Address
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- End .card-body -->
                    </div><!-- End .card -->

                    <div class="card" id="shipping_address" style="display: none">
                        <div class="card-header d-flex">
                            <div class="mr-auto">
                                MAKE DEFAULT SHIPPING ADDRESS
                            </div>
                            <div class="text-right">
                                <a href="{{ route('customer.addressbook') }}" class="btn btn-sm btn-primary py-1">Back</a>
                            </div>
                        </div><!-- End .card-header -->

                        <div class="card-body">
                            <div class="row">
                                <table class="table table-border">
                                    <thead>
                                        <th>Select</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody style="font-size: 12px">
                                        <form action="{{ route('customer.default.address') }}" method="POST">
                                            @csrf
                                            @foreach ($customer_address as $cus_address)

                                                <tr>
                                                    <td>
                                                        <input type="radio" name="s_address" id="s_address"
                                                            value="{{ $cus_address->id }}" required>
                                                        <input type="hidden" name="address" id="address"
                                                            value="shipping_address">
                                                    </td>
                                                    <td>{{ $cus_address->full_name }}</td>
                                                    <td style="width: 250px">{{ $cus_address->address }}</td>
                                                    <td>{{ $cus_address->phone }}</td>
                                                    <td>
                                                        @if ($cus_address->default_address == 1)
                                                            Default Address
                                                        @endif
                                                        <br>
                                                        @if ($cus_address->shipping_address == 1)
                                                            Shipping Address
                                                        @endif
                                                        <br>
                                                        @if ($cus_address->billing_address == 1)
                                                            Billing Address
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <button type="submit" name="submit"
                                                        class="btn btn-primary btn-sm mt-2">Update</button>
                                                </td>
                                            </tr>
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- End .card-body -->
                    </div><!-- End .card -->

                    <div class="card" id="billing_address" style="display: none">
                        <div class="card-header d-flex">
                            <div class="mr-auto">
                                MAKE DEFAULT BILLING ADDRESS
                            </div>
                            <div class="text-right">
                                <a href="{{ route('customer.addressbook') }}"
                                    class="btn btn-sm btn-primary py-1">Back</a>
                            </div>
                        </div><!-- End .card-header -->

                        <div class="card-body">
                            <div class="row">
                                <table class="table table-border">
                                    <thead>
                                        <th>Select</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody style="font-size: 12px">
                                        <form action="{{ route('customer.default.address') }}" method="POST">
                                            @csrf
                                            @foreach ($customer_address as $cus_address)

                                                <tr>
                                                    <td>
                                                        <input type="radio" name="b_address" id="b_address"
                                                            value="{{ $cus_address->id }}" required>
                                                        <input type="hidden" name="address" id="address"
                                                            value="billing_address">
                                                    </td>
                                                    <td>{{ $cus_address->full_name }}</td>
                                                    <td style="width: 250px">{{ $cus_address->address }}</td>
                                                    <td>{{ $cus_address->phone }}</td>
                                                    <td>
                                                        @if ($cus_address->default_address == 1)
                                                            Default Address
                                                        @endif
                                                        <br>
                                                        @if ($cus_address->shipping_address == 1)
                                                            Shipping Address
                                                        @endif
                                                        <br>
                                                        @if ($cus_address->billing_address == 1)
                                                            Billing Address
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <button type="submit" name="submit"
                                                        class="btn btn-primary btn-sm mt-2">Update</button>
                                                </td>
                                            </tr>
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- End .card-body -->
                    </div><!-- End .card -->
                    <div class="text-right" id="add_address">
                        <a class="btn btn-sm btn-primary" href="{{ route('customer.address') }}">Add New Address</a>
                    </div>

                </div><!-- End .col-lg-9 -->

                @include('frontend.customer.leftmenu')

            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->

@endsection
