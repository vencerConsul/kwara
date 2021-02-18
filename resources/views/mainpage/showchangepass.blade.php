@extends('layouts.app')

@section('title')
My Account
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
                        <img class="img-fluid ml-5 mr-5 mx-auto column__one__profile mt-4" src="/profile_images/{{ Auth::user()->profile }}">
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
                                <a href="{{route('user.orderHistory')}}">
                                    <li class="list-group-item">
                                        <div class="md-v-line"></div><i class="fas fa-money-bill-alt mr-3"></i>Order History
                                    </li>
                                </a>
                                <a class="disabled">
                                    <li class="list-group-item list__group__active">
                                        <div class="md-v-line"></div><i class="fas fa-unlock mr-3"></i> Change password
                                    </li>
                                </a>
                                <a href="{{ route('user.shippingaddress') }}">
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
                <p class="mt-5 mb-3">Change my password</p>
                {{-- form --}}
                <form method="post" action="{{ route('changepassword')}}">
                        @csrf
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="form-group p-2">
                            <div class="md-form">
                                <input type="password" name="oldpassword" value="{{ old('oldpassword') }}" id="oldpass" class="form-control" autocomplete="off">
                                <label for="oldpass">Old password</label>
                            </div>
                        </div>
                        <div class="form-group p-2">
                            <div class="md-form">
                                <input type="password" name="newpassword" id="newpass" class="form-control">
                                <label for="newpass">New password</label>
                            </div>
                        </div>
                        <div class="form-group p-2">
                            <div class="md-form">
                                <input type="password" name="confirmpassword" id="confirmpass" class="form-control">
                                <label for="confirmpass">Confirm password</label>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-sm ml-0 mb-2" onClick="this.form.submit(); this.disabled=true; this.value='updating....'; document.getElementById('oldpass').disabled=true;document.getElementById('newpass').disabled=true;document.getElementById('confirmpass').disabled=true;" value="update password &#10230;">
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
