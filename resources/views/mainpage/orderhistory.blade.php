@extends('layouts.app')

@section('title')
My Orders
@endsection

@section('userlogin')
<link rel="stylesheet" href="{{ asset('css/mainpage/myaccount.css') }}">
@endsection

@section('content')
@include('layouts.nav')

<!-- hero -->
<div id="my__account" class="container-fluid">
    {{-- cintainer --}}
    <div class="container">
        {{-- row --}}
        <div class="row">
            {{-- column 1 --}}
            <div class="col-lg-3 col-md-5 column__one pr-1 pl-1">
                <div class="column__one__content sticky-top mb-2">
                    <div class="card my-5">
                        @if(Auth::user()->profile == 0)
                        <img class="img-fluid ml-5 mr-5 mx-auto column__one__profile mt-4" src="/images/users/avatar.png">
                        @else
                        <img class="img-fluid ml-5 mr-5 mx-auto column__one__profile" src="/profile_images/{{ Auth::user()->profile }}">
                        @endif
                        <small class="text-capitalize text-center my-3">{{ Auth::user()->firstname .' '. Auth::user()->lastname }}</small>
                        <div class="card-body p-0">
                            <ul class="list-group">
                                <a href="{{ route('user.myaccount') }}">
                                    <li class="list-group-item">
                                        <div class="md-v-line"></div><i class="fas fa-user-edit mr-3"></i>Manage profile
                                    </li>
                                </a>
                                <a href="{{route('user.order')}}">
                                    <li class="list-group-item">
                                        <div class="md-v-line"></div><i class="fas fa-shopping-bag mr-4"></i>My Order
                                    </li>
                                </a>
                                <a class="disabled">
                                    <li class="list-group-item list__group__active">
                                        <div class="md-v-line"></div><i class="fas fa-money-bill-alt mr-3"></i>Order History
                                    </li>
                                </a>
                                <a href="{{ route('user.changepassword') }}">
                                    <li class="list-group-item">
                                        <div class="md-v-line"></div><i class="fas fa-unlock mr-3"></i> Change password
                                    </li>
                                </a><a href="{{ route('user.shippingaddress') }}">
                                    <li class="list-group-item">
                                        <div class="md-v-line"></div><i class="fas fa-address-card mr-3"></i>Shipping Address
                                    </li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end column 1 --}}

            {{-- column 2 --}}
            <div class="col-lg-9 col-md-7 column__two pr-1 pl-1">
                <p class="mt-5 mb-3">Order History</p>
                @if($orderProduct->count() > 0)
                    @foreach($orderProduct as $order)
                    <div class="card mb-2">
                        <div class="card-header">
                            <small>Tracking number: <span class="font-weight-bold">{{$order->order_number}}</span></small>
                        </div>
                        <div class="card-body order__details">
                            <div class="row">
                                <div class="col-lg-4 d-flex flex-column align-items-center justify-content-center">
                                    <img src="{{ asset("/storage/images/products/$order->product_image")}}" alt="{{$order->product_name}}" style="width: 100px; height: 100px; object-fit:cover;">
                                </div>
                                <div class="col-lg-4 d-flex flex-column align-items-start justify-content-center">
                                    <small>Product Name: <span>{{$order->product_name}}</span></small>
                                    <small>Product Price: <span>&#8369; {{number_format($order->product_price, 2)}}</span></small>
                                    <small>Product Quantity: <span>{{$order->product_quantity}}</span></small>
                                    @if($order->product_size && $order->product_color)
                                    <small>Product Size: <span>{{$order->product_size}}</span></small>
                                    <small>Product Color: <span>{{$order->product_color}}</span></small>
                                    @endif
                                </div>
                                <div class="col-lg-4 d-flex flex-column justify-content-center">
                                    <small>Order Status: <span class="bg-success text-white p-1 rounded">{{$order->status}}</span></small>
                                    <small>Created: <span>{{date('F d, y, h:i', strtotime($order->created_at))}}</span></small>
                                    <small>Total Price: <span>&#8369; {{number_format($order->product_price * $order->product_quantity, 2)}}</span></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="my-2">No Order History</p>
                @endif
                <a href="{{ URL::to('/') }}" class="btn ml-0 btn-sm mb-2"><small>&#8617; Continue shopping</small></a>
            </div>
            {{-- end column 2 --}}
        </div>
        {{-- end row --}}
    </div>
    {{-- end container --}}
</div>

@include('layouts.footer')
@endsection

@section('myaccount')
<script src="{{ asset('/js/mainpage/myaccount.js') }}" defer></script>
@endsection
