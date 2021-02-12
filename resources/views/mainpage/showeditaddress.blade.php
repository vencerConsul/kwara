@extends('layouts.app')

@section('title')
Edit address
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
                                <a href="{{route('user.order')}}">
                                    <li class="list-group-item">
                                        <div class="md-v-line"></div><i class="fas fa-shopping-bag mr-4"></i>My Order
                                    </li>
                                </a>
                                <a href="{{route('user.mypurchases')}}">
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
            <div class="col-lg-9 col-md-7 column__two pr-1 pl-1">
                <p class="mt-5 mb-3">My Shipping Address</p>
                {{-- form --}}
                <form method="post" action="{{ route('update_shippingaddress')}}">
                    @csrf
                <div class="card mb-2">
                    <div class="card-body">
                        <input type="hidden" name="shipping_id" value="{{ $editshippingaddress->id }}">
                        <div class="form-group p-2">
                            <div class="form-group">
                                <div class="md-form">
                                    <input type="text" id="firstname" class="form-control" name="firstname" value="{{ $editshippingaddress->firstname }}" autocomplete="off">
                                    <label for="firstname">Firstname</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group p-2">
                            <div class="md-form mt-3">
                                <input type="text" id="lastname" class="form-control" name="lastname" value="{{ $editshippingaddress->lastname }}" autocomplete="off">
                                <label for="lastname">Lastname</label>
                            </div>
                        </div>
                        <div class="form-group p-2">
                            <select class="mdb-select mt-3 md-form form-control" id="country" name="country" value="{{ $editshippingaddress->country }}" autocomplete="off">
                                <option value="Philippines" selected>Philippines</option>
                            </select>
                        </div>
                        <div class="form-group p-2">
                            <div class="form-group">
                                <div class="md-form mt-3">
                                    <input type="text" id="address" class="form-control" name="address" value="{{ $editshippingaddress->address }}" autocomplete="off">
                                    <label for="address">Address(house #, Brgy )</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group p-2">
                            <div class="form-group">
                                <div class="md-form mt-3">
                                    <input type="text" id="postal_code" class="form-control" name="postal_code" value="{{ $editshippingaddress->postal_code }}" maxlength="4" onkeypress="return isNumber(event)" autocomplete="off">
                                    <label for="postal_code">Postal code</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group p-2">
                            <div class="form-group">
                                <div class="md-form mt-3">
                                    <input type="text" id="phone_number" class="form-control" maxlength="11" name="phone_number" value="{{ $editshippingaddress->phone_number }}" autocomplete="off" onkeypress="return isNumber(event)">
                                    <label for="phone_number">Phone (number)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-sm ml-0 mb-2" onClick="this.form.submit(); this.disabled=true; this.value='updating....'; document.getElementById('firstname').disabled=true;document.getElementById('lastname').disabled=true;document.getElementById('country').disabled=true;document.getElementById('address').disabled=true;document.getElementById('postal_code').disabled=true;document.getElementById('phone_number').disabled=true;" value="update address">
                </form>
                {{-- end form --}}
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
