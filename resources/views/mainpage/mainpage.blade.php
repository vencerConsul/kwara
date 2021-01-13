@extends('layouts.app')

@section('title')
Kwara
@endsection

@section('mainpagestyle')
<link rel="stylesheet" href="{{ asset('css/mainpage/mainpage.css') }}">
@endsection

@section('content')
@include('layouts.nav')

<!-- hero -->
<div id="hero__main" class="container">
    <div class="row">
        <div class="col-lg-6 my-3 hero__column__first">
            <div class="hero__content">
                <h1>Manage your online business</h1>
                <h2>Be one of our seller!</h2>
                <p>Sell your product all over (Bolinao Pangasinan)</p>
                <a href="{{ route('login.seller') }}" class="btn ml-0 mt-2">Sign in as seller</a>
            </div>
        </div>
        <div class="col-lg-6 my-3 hero__column__second">
            <div class="hero__image">
                <img class="img-fluid" src="{{ asset('/images/hero.png') }}">
            </div>
        </div>
        <div class="col-lg-6 my-3 hero__column__third">
            <div class="hero__small__screen">
                <p>Wanted to sell your product online?</p>
                <a href="{{ route('login.seller') }}" class="btn ml-0 mt-2">Sign in as seller</a>
            </div>
        </div>
    </div>
</div>

<!-- section 2 -->
<div id="section__two">
    <div class="container">
        <hr class="my-4">
        <div class="row text-center">
            <div class="col-6">
                <i class="fas fa-location-arrow"></i>
                <h5>LOCATION BASE</h5>
                <small>This app can only be access within Bolinao Pangasinan</small>
            </div>
            <div class="col-6">
                <i class="fas fa-truck"></i>
                <h5>DELIVERY</h5>
                <small>Your product will be delivered on time</small>
            </div>
        </div>
    </div>
</div>

<!-- section 3 -->
<div id="section__three">
    <div class="container">
        <br />
        {{-- @if($products->count() > 0)
            <div class="section__three__title text-center">
                <h5>All Products</h5>
            </div>
        @else
            <div class="section__three__title text-center">
                <h5>There is no product yet</h5>
            </div>
        @endif --}}
        <br />
        <div class="my-4">
            <div class="row d-flex justify-content-center products">

            </div>
        </div>
        {{-- <div class="section__three__pagination text-center"  style="display: flex;align-items: center;justify-content: center;margin-bottom: 1em !important;">
            {{ $products->links() }}
        </div> --}}
    </div>
</div>
<!-- section 4 -->
<div id="section__four">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-6 d-flex justify-content-center align-items-center my-4">
            <img src="{{ asset('images/feature/christmas-tree.png') }}" class="img-fluid" />
            </div>
            <div class="col-lg-6 col-sm-6 d-flex justify-content-center align-items-center my-4">
                <div class="s4-info text-center">
                    <p class="display-4">Make your dream come through</p>
                    <h4>Merry Christmas!</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- section5 -->
<div id="section__five">
    <div class="container">
        <br />
        {{-- @if($products->count() > 0)
            <div class="section__five__title text-center">
                <h5>Gadgets</h5>
            </div>
        @else
            vowala
        @endif --}}
        <br />
        <div class="row d-flex justify-content-center">
            @foreach($gadgets as $gad)
            <div class="col-lg-2 col-sm-4 col-6 section__five__col">
                <a href="">
                    <div class="card mb-2">
                        @php
                            $image = explode('|', $gad->product_image)
                        @endphp
                        <img class="card-img-top" src="{{asset('/storage/images/products/'.$image[0].'')}}" />
                        <div class="card-body">
                            <p class="card-title p-name">{{ $gad->product_name}}</p>
                            <p class="card-text">&#8369; {{number_format($gad->product_price)}}</p>
                            <div class="section__five__viewers">
                                    <small>(21 views)</small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        {{-- <div class="section__three__pagination text-center"  style="display: flex;align-items: center;justify-content: center;margin-bottom: 1em !important;">
            {{ $products->links() }}
        </div> --}}
    </div>
</div>
@include('layouts.footer')
@endsection

@section('mainpagescript')
    <script src="{{asset('js/mainpage/main.js')}}"></script>
@endsection
