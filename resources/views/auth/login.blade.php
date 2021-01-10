@extends('layouts.app')

@section('title')
Sign in
@endsection

@section('userlogin')
<link rel="stylesheet" href="{{ asset('css/user/login.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div id="user__login">
        <div class="row">
            <div class="col-lg-6 col-sm-6 column__one">
                <div class="column__content">
                    <div class="column__upper">
                        <h1>NEW TO US?</h1>
                        <p>Create your account now</p>
                        <a class="btn btn-sm" href="{{ route('register') }}">Sign up</a>
                    </div>
                    <img class="img-fluid" src="{{ asset('/images/login-image.svg') }}">
                </div>
            </div>
            {{-- column 1 --}}
            <div class="col-lg-6 col-sm-6 column__two">
                <div class="card">
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card-body">
                        <h1>Sign In</h1>
                        <div class="form-group">
                            <div class="md-form mt-3">
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off">
                                <label for="email">Email Address</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="md-form mt-3">
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="form-group">
                            @if (Route::has('password.request'))
                                <a class="forgot__password" href="{{ route('password.request') }}">
                                    <i class="fas fa-info-circle my-4"></i> Forgot password?
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn">Sign in</button>
                        <div class="card__footer__signin__with mb-3">
                            <p class="my-3">or sign in with</p>
                            <div class="signin__with__content">
                                <a href="">
                                <div class="signin__circle mr-4">
                                        <i class="fab fa-facebook-f"></i>
                                </div>
                                </a>
                                <a href="">
                                <div class="signin__circle">
                                        <i class="fab fa-google"></i>
                                </div>
                                </a>
                            </div>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="not__yet__member" href="{{ route('register') }}">
                                not yet a member? <i class="fas fa-caret-right"></i>
                            </a>
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