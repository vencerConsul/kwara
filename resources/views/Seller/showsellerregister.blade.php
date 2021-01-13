@extends('layouts.app')

@section('title')
Sign up
@endsection

@section('userregister')
<link rel="stylesheet" href="{{ asset('css/seller/sellerregister.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div id="seller__register">
        <div class="row">
            <div class="col-lg-6 col-sm-6 column__one">
                <div class="column__content">
                    <div class="column__upper">
                        <h1>One of us?</h1>
                        <p>login your existing account</p>
                        <a class="btn btn-sm" href="{{ route('login.seller') }}">Sign in</a>
                    </div>
                    <img class="img-fluid" src="{{ asset('/images/sellers/login-image.png') }}">
                </div>
            </div>
            {{-- column 1 --}}
            <div class="col-lg-6 col-sm-6 column__two">
                <div class="card">
                    <form method="POST" action="{{ route('seller.register') }}">
                    @csrf
                    <div class="card-body">
                        <h1>Sign Up</h1>
                        <div class="form-group">
                            <div class="md-form mt-3">
                                <input
                                type="text"
                                id="firstname" class="form-control"
                                name="firstname"
                                value="{{ old('firstname') }}" onkeyup="chkCase(this)" autocomplete="off">
                                <label for="firstname">Firstname</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="md-form mt-3">
                                <input type="text" id="lastname" class="form-control" name="lastname" value="{{ old('lastname') }}" onkeyup="chkCase(this)" autocomplete="off">
                                <label for="lastname">Lastname</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="md-form mt-3">
                                <input type="text" id="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="off">
                                <label for="email">Email Address</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="md-form mt-3">
                                <input type="text" id="store_name" class="form-control" name="store_name" value="{{ old('store_name') }}" autocomplete="off">
                                <label for="store_name">Store name</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="md-form mt-3">
                                <input type="password" id="password" class="form-control" name="password" autocomplete="current-password">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="md-form mt-3">
                                <input type="password" id="password-confirmation" class="form-control" name="password_confirmation" autocomplete="new-password">
                                <label for="password-confirmation">Confirm Password</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="text-white">Choose payment</span>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="paypal" name="payment" value="paypal" onclick="showPaymentInfo(this.id)">
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="meet_developer" name="payment" value="Meet Admins" onclick="showPaymentInfo(this.id)">
                                <label class="custom-control-label" for="meet_developer">Meet Admins</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" class="btn ml-0 mt-3" onClick="this.form.submit(); this.disabled=true; this.value='loading..'; document.getElementById('firstname').disabled=true;document.getElementById('lastname').disabled=true;document.getElementById('email').disabled=true;document.getElementById('store_name').disabled=true;document.getElementById('password').disabled=true;document.getElementById('password-confirmation').disabled=true;document.getElementById('paypal').disabled=true;document.getElementById('meet_developer').disabled=true;" value="Sign in">
                        @if (Route::has('register'))
                            <div class="mt-3">
                                    <a class="not__yet__member" href="{{ route('login') }}">
                                    One of us? &nbsp; <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                    </form>
                </div>
            </div>
            {{-- end column 2 --}}
        </div>
    </div>
</div>
@endsection

@section('sellerlogAndreg')
<script src="{{ asset('js/seller/sellerlogAndreg.js') }}"></script>
@endsection
