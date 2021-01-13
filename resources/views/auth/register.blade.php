@extends('layouts.app')

@section('title')
Sign up
@endsection

@section('userregister')
<link rel="stylesheet" href="{{ asset('css/user/register.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div id="user__register">
        <div class="row">
            <div class="col-lg-6 col-sm-6 column__one">
                <div class="column__content">
                    <div class="column__upper">
                        <h1>One of us?</h1>
                        <p>login your existing account</p>
                        <a class="btn btn-sm" href="{{ route('login') }}">Sign in</a>
                    </div>
                    <img class="img-fluid" src="{{ asset('/images/users/login-image.png') }}">
                </div>
            </div>
            {{-- column 1 --}}
            <div class="col-lg-6 col-sm-6 column__two">
                <div class="card">
                    <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="card-body">
                        <h1>Sign Up</h1>
                        <div class="form-group">
                            <div class="md-form mt-3">
                                <input
                                type="text"
                                id="firstname" class="form-control"
                                name="firstname"
                                value="{{ old('firstname') }}" autocomplete="off">
                                <label for="firstname">Firstname</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="md-form mt-3">
                                <input type="text" id="lastname" class="form-control" name="lastname" value="{{ old('lastname') }}" autocomplete="off">
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
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" class="btn ml-0 mt-3" onClick="this.form.submit(); this.disabled=true; this.value='loading..'; document.getElementById('firstname').disabled=true;document.getElementById('lastname').disabled=true;document.getElementById('email').disabled=true;document.getElementById('password').disabled=true;document.getElementById('password-confirmation').disabled=true;" value="Sign up">
                        @if (Route::has('register'))
                            <div class="mt-4">
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
