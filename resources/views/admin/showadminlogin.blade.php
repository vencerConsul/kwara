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
                    <img class="img-fluid" src="{{ asset('/images/admin/admin.png') }}">
                </div>
            </div>
            {{-- column 1 --}}
            <div class="col-lg-6 col-sm-6 column__two">
                <div class="card">
                    <form method="POST" action="{{ route('login.admin') }}">
                    @csrf
                    <div class="card-body">
                        <h1>Welcome Master</h1>
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
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn">Sign in</button>
                    </div>
                    </form>
                </div>
            </div>
            {{-- end column 2 --}}
        </div>
    </div>
</div>
@endsection
