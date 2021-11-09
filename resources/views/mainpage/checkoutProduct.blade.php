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
    <div class="container my-4">
        <form action="{{route('place.order')}}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Choose payment method
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-6 p-1">
                                <input type="radio" id="paypal" style="display: none;" name="payment_method" value="paypal">
                                <button type="button" class="btn btn-block" onclick="document.getElementById('paypal').checked = true; selected('paypal')">
                                    <i class="fab fa-paypal"></i>
                                    <p>PAYPAL</p>
                                </button>
                            </div>
                            <div class="col-lg-6 col-6 p-1">
                                    <input type="radio" id="creditCard" style="display: none;" name="payment_method" value="Credit / debit card">
                                <button type="button" class="btn btn-block" onclick="document.getElementById('creditCard').checked = true; selected('creditCard')">
                                    <i class="fas fa-credit-card"></i>
                                    <p>Credit / debit card</p>
                                </button>
                            </div>
                            <div class="col-lg-6 col-6 p-1">
                                    <input type="radio" id="cod" style="display: none;" name="payment_method" value="Cash On Delivery">
                                <button type="button" class="btn btn-block" onclick="document.getElementById('cod').checked = true; selected('cod')">
                                    <i class="fas fa-truck"></i>
                                    <p>CASH ON DELIVERY</p>
                                </button>
                            </div>
                            <div class="col-lg-6 col-6 p-1">
                                    <input type="radio" id="otc" style="display: none;" name="payment_method" value="Over the Counter">
                                <button type="button" class="btn btn-block" onclick="document.getElementById('otc').checked = true; selected('otc')">
                                    <i class="far fa-building"></i>
                                    <p>Over the Counter</p>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="cashOnDelivery">

                </div>
            </div>
            <div class="col-lg-4">
                <div class="card rounded-0 summary">
                    <div class="card-header">
                        Summary
                    </div>
                    <div class="card-body">
                        <div class="address">
                            <h6>Shipping Address</h6>
                            <small>{{$shippingAddress['firstname'] . ' ' . $shippingAddress['lastname']}}</small><br />
                            <small>{{$shippingAddress['address']}}</small><br />
                            <small>{{$shippingAddress['country']}}</small><br />
                            <small>{{$shippingAddress['postal']}}</small><br />
                            <small>{{$shippingAddress['phone']}}</small><br />

                            <div class="d-none">
                                <input type="hidden" name="firstname" value="{{$shippingAddress['firstname']}}">
                                <input type="hidden" name="lastname" value="{{$shippingAddress['lastname']}}">
                                <input type="hidden" name="address" value="{{$shippingAddress['address']}}">
                                <input type="hidden" name="country" value="{{$shippingAddress['country']}}">
                                <input type="hidden" name="postal" value="{{$shippingAddress['postal']}}">
                                <input type="hidden" name="phone" value="{{$shippingAddress['phone']}}">
                            </div>
                        </div>
                        <hr class="my-3">
                        <h6>Product</h6>
                        @php
                            $total = 0;
                        @endphp
                        @foreach($orders as $order)
                        @php
                            $total = $total + ($order->product_quantity * $order->product_price);
                        @endphp
                        <div class="box-order w-100">
                            <img class="img-fluid" src="{{ $order->product_image_url }}" alt="{{$order->product_name}}" style="width: 70px;height:70px; object-fit:cover;">
                            <div class="box-order-content">
                                <p>{{$order->product_name}}</p>
                                <p>&#8369; {{number_format($order->product_price, 2)}}</p>
                                <p>Quantity: {{$order->product_quantity}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                            <p>Subtotal: &#8369; {{number_format($total, 2)}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-sm btn-block mt-2 place__order">Place order</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    @include('layouts.footer')
@endsection

@section('checkoutProductJs')
    <script src="{{asset('/js/mainpage/checkoutProduct.js')}}" defer></script>
@endsection
