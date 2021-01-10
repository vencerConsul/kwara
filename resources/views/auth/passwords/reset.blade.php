@extends('layouts.app')

@section('title')
Sign in
@endsection

@section('content')
<div class="container-fluid">
    <div id="reset">
        <div class="row">
            <div class="col-lg-6 column-1 col-sm-6">
                <div class="col-2-content">
                    <div class="upper">
                        <h1>Your good to go</h1>
                        <a class="btn btn-sm" href="{{ url()->previous() }}">Go back</a>
                    </div>
                    <img class="img-fluid" src="{{ asset('/images/reset-password.png') }}">
                </div>
            </div>
            <div class="col-lg-6 column-2 col-sm-6">
                <div class="card my-5">
                    <div class="card-body">
                        <h1 class="text-center">Update password</h1>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <div class="md-form mt-3">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    <label for="email">Email address</label>
                                </div>
                                <div class="md-form mt-3">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <label for="email">New password</label>
                                </div>
                                <div class="md-form mt-3">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <label for="email">Confirm password</label>
                                </div>
                            </div>
                            <div class="login-footer text-center">
                                <button type="submit" class="btn">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
