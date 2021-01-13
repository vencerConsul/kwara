@extends('layouts.app')

@section('title')
Shipping Address
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
            <div class="col-lg-3 col-md-5 column__one">
                <div class="column__one__content">
                    <div class="card my-5">

                        @if(Auth::user()->profile == 0)
                        <img class="img-fluid ml-5 mr-5 mx-auto column__one__profile mt-4" src="/images/users/avatar.png">
                        @else
                        <img class="img-fluid ml-5 mr-5 mx-auto column__one__profile mt-4" src="/profile_images/{{ Auth::user()->profile }}">
                        @endif
                        <h5 class="text-capitalize text-center my-3">{{ Auth::user()->firstname .' '. Auth::user()->lastname }}</h5>
                        <div class="card-body p-0">
                            <ul class="list-group">
                            <a href="{{ route('user.myaccount') }}">
                                    <li class="list-group-item">
                                        <div class="md-v-line"></div><i class="fas fa-user-edit mr-3"></i>Manage profile
                                    </li>
                                </a>
                                <a href="">
                                    <li class="list-group-item">
                                        <div class="md-v-line"></div><i class="fas fa-money-bill-alt mr-3"></i>My purchases
                                    </li>
                                </a>
                                <a href="{{ route('user.changepassword') }}">
                                    <li class="list-group-item">
                                        <div class="md-v-line"></div><i class="fas fa-unlock mr-3"></i> Change password
                                    </li>
                                </a>
                                <a class="disabled">
                                    <li class="list-group-item list__group__active">
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
            <div class="col-lg-9 col-md-7 column__two">
                @if($shippingAddress->count())
                    <div class="card my-5" id="addshippingaddress">
                        <div class="card-header">
                            <h6 class="float-left font-weight-bold mt-2">My Shipping Address</h6>
                            <div class="dropdown">

                                <i class="float-right fa fa-bars" data-toggle="dropdown"></i>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="edit-address/{{ encrypt($shippingAddress[0]->shipping_id) }}">Edit</a>
                                    <a class="dropdown-item" href="delete-address/{{ $shippingAddress[0]->shipping_id }}">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 ">
                                    <div class="center">
                                        <p class="text-capitalize">Ship to {{$shippingAddress[0]->firstname .' '.$shippingAddress[0]->lastname }}</p>
                                        <p>{{ $shippingAddress[0]->address }}</p>
                                        <p>{{ $shippingAddress[0]->country }}</p>
                                        <p>{{ $shippingAddress[0]->postal_code }}</p>
                                        <p>{{ $shippingAddress[0]->phone_number }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                                    <img class="img-fluid d-none d-lg-block" src="{{ asset('/images/users/shipping.png') }}" alt="address">
                                </div>
                            </div>
                            <hr>
                            <small class="float-left">Date created: {{ date('F j, Y', strtotime($shippingAddress[0]->created_at)) }}</small>
                        </div>
                    </div>
                    @else
                    <div class=" card mb-3  mt-5">
                        <div class="card-body">No Shipping Address yet, fill up the form below</div>
                            </div>
                                <div class="card" id="shippingcard">
                                    <div class="card-body">
                                        <h4 class="card-title">Add Shipping Address</h4>
                                        <form action="{{ route('addaddress') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <div class="md-form mt-3">
                                                            <input type="text" id="firstname" class="form-control" name="firstname" value="{{ old('firstname') }}" autocomplete="off">
                                                            <label for="firstname">Firstname</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <div class="md-form mt-3">
                                                            <input type="text" id="lastname" class="form-control" name="lastname" value="{{ old('lastname') }}" autocomplete="off">
                                                            <label for="lastname">Lastname</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <select class="mdb-select mt-3 md-form form-control" name="country" value="Philippines" autocomplete="off">
                                                            <option value="Philippines" selected>Philippines</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <div class="md-form mt-3">
                                                            <input type="text" id="address" class="form-control" name="address" value="{{ old('address') }}" autocomplete="off">
                                                            <label for="address">Address(house #, Brgy )</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <div class="md-form mt-3">
                                                            <input type="text" id="postal_code" class="form-control" name="postal_code" value="{{ old('postal_code') }}" maxlength="4" onkeypress="return isNumber(event)" autocomplete="off">
                                                            <label for="postal_code">Postal code</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <div class="md-form mt-3">
                                                            <input type="text" id="phone_number" class="form-control" maxlength="11" name="phone_number" value="{{ old('phone_number') }}" autocomplete="off" onkeypress="return isNumber(event)">
                                                            <label for="phone_number">Phone (number)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-sm ml-0 mt-3" onClick="this.form.submit(); this.disabled=true; this.value='processing....'; document.getElementById('oldpass').disabled=true;document.getElementById('newpass').disabled=true;document.getElementById('confirmpass').disabled=true;" value="add address">
                                        </form>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
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
