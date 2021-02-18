@extends('layouts.app')

@section('title')
Kwara
@endsection

@section('mainpagestyle')
<link rel="stylesheet" type="text/css" href="{{ asset('css/mainpage/mainpage.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/mainpage/swiper-bundle.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/mainpage/swiper-bundle.min.css') }}">
@endsection

@section('content')
@include('layouts.nav')

<section class="bg_loader">
    <div class="loader"></div>
    <div class="count"></div>
</section>

<!-- hero -->
<div id="hero__main" class="container-fluid">
    <div class="hero__content container">
        <h1>Manage your online business</h1>
        <h2>Be one of our seller</h2>
        <p>Sell your product all over (Bolinao Pangasinan)</p>
        <a href="{{ route('register.seller') }}" class="btn ml-0 mt-2">Register as seller</a>
    </div>
</div>

<section id="categories">
    <div class="container my-4 swiper-container">
        <h5 class="font-weight-normal ml-3 my-4">Categories</h5>
        <div class="swiper-wrapper">
            <a href="" class="swiper-slide">
                <div class="card text-center">
                    <div class="card-body text-center">
                        <h4 class="card-title"><i class="fas fa-mobile fa-lg"></i></h4>
                        <small>Mobile & Gadgets</small>
                    </div>
                </div>
            </a>
            <a href="" class="swiper-slide">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-blender-phone"></i></h4>
                        <small>Home Appliances</small>
                    </div>
                </div>
            </a>
            <a href="" class="swiper-slide">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-tshirt"></i></h4>
                        <small>Clothes</small>
                    </div>
                </div>
            </a>
            <a href="" class="swiper-slide">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-shopping-basket"></i></h4>
                        <small>Foods & Groceries</small>
                    </div>
                </div>
            </a>
            <a href="" class="swiper-slide">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-bicycle"></i></h4>
                        <small>Bicycle & Accessories</small>
                    </div>
                </div>
            </a>
            <a href="" class="swiper-slide">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-shoe-prints"></i></h4>
                        <small>Shoes & slippers</small>
                    </div>
                </div>
            </a>
            <a href="" class="swiper-slide">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-tools"></i></h4>
                        <small>Hardwares</small>
                    </div>
                </div>
            </a>
            <a href="" class="swiper-slide">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-pen"></i></h4>
                        <small>Make up & Fragrances<</small>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- section 3 -->
<section id="section__three">
    <div class="container">
        <br />
        <div>
            <h5 class="font-weight-normal">All Products</h5>
        </div>
        <br />

        <div class="my-4">
            <div class="row d-flex justify-content-center products">

            </div>
        </div>
    </div>
</section>
<!-- section 4 -->

@include('layouts.footer')
@endsection

@section('mainpagescript')
    <script type="text/javascript" src="{{asset('js/mainpage/main.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/mainpage/swiper-bundle.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/mainpage/swiper-bundle.min.js')}}"></script>
    <script>
        window.onload = function(){

            var swiper = new Swiper('.swiper-container', {
                normalizeSlideIndex: true,
                breakpoints: {
                    // when window width is >= 320px
                    320: {
                    slidesPerView: 3,
                    spaceBetween: 20
                    },
                    // when window width is >= 480px
                    480: {
                    slidesPerView: 3,
                    spaceBetween: 30
                    },
                    // when window width is >= 640px
                    640: {
                    slidesPerView: 3,
                    spaceBetween: 40
                    },
                    800: {
                    slidesPerView: 4,
                    spaceBetween: 40
                    },
                    1000: {
                    slidesPerView: 6,
                    spaceBetween: 40
                    }
                }
            });
        }
    </script>
@endsection
