@extends('layouts.app')

@section('title')
Reset password
@endsection

@section('content')
<div class="container-fluid">
    <div id="reset">
        <div class="row">
            <div class="col-lg-6 column-1 col-sm-6">
                <div class="col-2-content">
                    <div class="upper">
                        <h1>ARE YOU DONE?</h1>
                        <a class="btn btn-sm" href="{{ url()->previous() }}">Go back</a>
                    </div>
                    <img class="img-fluid" src="{{ asset('/images/reset-password.png') }}">
                </div>
            </div>
            <div class="col-lg-6 column-2 col-sm-6">
                <div class="card my-5">
                    <div class="card-body">
                        <h1 class="text-center">Reset Password</h1>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <div class="md-form mt-3">
                                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                                    <label for="email">Enter your email address</label>
                                </div>
                            </div>
                            <div class="login-footer text-center">
                                <button type="submit" class="btn">Send Password Reset Link</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
