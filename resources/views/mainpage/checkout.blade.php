@extends('layouts.app')

@section('title')
Checkout
@endsection

@section('mainpagestyle')
<link rel="stylesheet" type="text/css" href="{{ asset('css/mainpage/checkout.css') }}">
@endsection

@section('content')
@include('layouts.nav')
    <div class="container my-4 indicator">
        <div class="progress-indicator">
            <ul class="progress-box">
                <li class="active"><i class="fab fa-opencart"></i><p>Cart</p></li>
                <li><i class="fas fa-address-card"></i><p>Billing Address</p></li>
                <li><i class="far fa-credit-card"></i><p>Payment</p></li>
            </ul>
        </div>
    </div>
    <div class="container my-4 pl-0 pr-0">
        <form action="{{route('billing.information')}}" method="post">
            @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card rounded-0">
                    <div class="card-header">
                        Set Default Biling Address
                    </div>
                    <div class="card-body">
                        <form action="">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group my-2">
                                        <input type="text" id="firstname" value="{{old('firstname')}}" name="firstname" class="form-control" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group my-2">
                                        <input type="text" id="lastname" value="{{old('lastname')}}" name="lastname" class="form-control" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group my-2">
                                        <input type="text" id="address" value="{{old('address')}}" name="address" class="form-control" placeholder="Complete Address">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group my-2">
                                        <select class="form-control" value="{{old('country')}}" name="country" id="country">
                                            <option value="Philippines">Philippines</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group my-2">
                                        <input type="text" id="phone" value="{{old('phone')}}" name="phone" class="form-control" placeholder="Phone number">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group my-2">
                                        <input type="text" id="postal" value="{{old('postal')}}" name="postal" class="form-control" placeholder="Postal code">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if($shippingAddress->count() > 0)
                    <div class="box-billing-address m-4 p-2">
                        <h6 class="font-weight-normal">Default Billing Address</h6>
                        <p>{{$shippingAddress[0]->firstname}}</p>
                        <p>{{$shippingAddress[0]->lastname}}</p>
                        <p>{{$shippingAddress[0]->address}}</p>
                        <p>{{$shippingAddress[0]->country}}</p>
                        <p>{{$shippingAddress[0]->postal_code}}</p>
                        <p>{{$shippingAddress[0]->phone_number}}</p>
                        <button type="button" class="btn btn-sm ml-0" onclick="useAddress(this)">Use Billing Address</button>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card rounded-0 ">
                    <div class="card-header">
                        Your Order
                    </div>
                    <div class="card-body">
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
                        <p>Subtotal: &#8369; {{number_format($total, 2)}}</p>
                        <button type="submit" class="btn btn-sm btn-block">Proceed</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    @include('layouts.footer')
@endsection

@section('checkoutJs')
    <script>
        async function useAddress(btn) {
            btn.innerHTML = 'loading';

            await fetch('{{route("user.useAddress")}}', {
                method: "GET"
            })
                .then(result => {
                    return result.json();
                })
                .then(data => {
                    if(data.status == 'ok'){
                        btn.disabled = true;
                        btn.innerHTML = 'address applied';
                        document.getElementById('firstname').value = data.firstname;
                        document.getElementById('lastname').value = data.lastname;
                        document.getElementById('address').value = data.address;
                        document.getElementById('country').value = data.country;
                        document.getElementById('postal').value = data.postal_code;
                        document.getElementById('phone').value = data.phone_number;
                    }
                });
        }
    </script>
@endsection
