@extends('frontend.components.layout')

@section('title')
    Withdraw Balance
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
                                    <p class="px-4 pb-0 mb-0"><strong>Withdrawal</strong></p>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <form action="{{ route('customer.withdraw.request') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                                            <label class="form-label" for="amount">Enter Amount (Minimum 100 Tk):</label>
                                            <input type="number" class="form-control" name="amount" required min="100">
                                            <button type="submit" class="btn btn-success px-5 py-3 rounded-pill">Withdraw</button>
                                        </form>

                                    </div>
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

@endpush
