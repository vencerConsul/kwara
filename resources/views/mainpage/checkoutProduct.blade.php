@extends('layouts.app')

@section('title')
Checkout
@endsection

@section('mainpagestyle')
<link rel="stylesheet" type="text/css" href="{{ asset('css/mainpage/checkoutProduct.css') }}">
@endsection

@section('content')
@include('layouts.nav')
    <div class="container my-4 indicator">
        <div class="progress-indicator">
            <ul class="progress-box">
                <li class="active"><i class="fab fa-opencart"></i><p>Cart</p></li>
                <li class="active"><i class="fas fa-address-card"></i><p>Billing Address</p></li>
                <li><i class="far fa-credit-card"></i><p>Payment</p></li>
            </ul>
        </div>
    </div>
    <div class="container my-4 pl-0 pr-0">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Choose payment method
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 p-1">
                                <button class="btn btn-block">
                                    <i class="fab fa-paypal"></i>
                                    <p>PAYPAL</p>
                                </button>
                            </div>
                            <div class="col-lg-6 p-1">
                                <button class="btn btn-block">
                                    <i class="fas fa-credit-card"></i>
                                    <p>Credit / debit card</p>
                                </button>
                            </div>
                            <div class="col-lg-6 p-1">
                                <button class="btn btn-block">
                                    <i class="fas fa-truck"></i>
                                    <p>CASH ON DELIVERY</p>
                                </button>
                            </div>
                            <div class="col-lg-6 p-1">
                                <button class="btn btn-block">
                                    <i class="far fa-building"></i>
                                    <p>Over the Counter</p>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card rounded-0 ">
                    <div class="card-header">
                        Summary
                    </div>
                    <div class="card-body">
                        <div class="address">
                            <h6>Shipping Address</h6>
                            <small>{{$shippingAddress[0]->firstname . ' ' . $shippingAddress[0]->lastname}}</small><br />
                            <small>{{$shippingAddress[0]->address}}</small><br />
                            <small>{{$shippingAddress[0]->country}}</small><br />
                            <small>{{$shippingAddress[0]->postal_code}}</small><br />
                            <small>{{$shippingAddress[0]->phone_number}}</small><br />
                        </div>
                        <hr>
                        <h6>Product</h6>
                        @php
                            $total = 0;
                        @endphp
                        @foreach($orders as $order)
                        @php
                            $total = $total + ($order->product_quantity * $order->product_price);
                        @endphp
                        <div class="box-order">
                            <img class="img-fluid" src="{{  asset('/storage/images/products/'.$order->product_image.'') }}" alt="{{$order->product_name}}">
                            <div class="box-order-content">
                                <p>{{$order->product_name}}</p>
                                <p>&#8369; {{number_format($order->product_price, 2)}}</p>
                                <p>Quantity: {{$order->product_quantity}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Enter coupon code">
                            <div class="input-group-append">
                                <button class="btn btn-md m-0 px-3 py-2" type="button" id="button-addon2">Apply</button>
                            </div>
                        </div>
                        <p>Subtotal: &#8369; {{number_format($total, 2)}}</p>
                        <button type="submit" class="btn btn-sm btn-block">Place order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection

@section('checkoutJs')
    <script>

    </script>
@endsection
