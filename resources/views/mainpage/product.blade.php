@extends('layouts.app')

@section('title')
Product
@endsection

@section('mainpagestyle')
<link rel="stylesheet" href="{{ asset('css/mainpage/product.css') }}">
@endsection

@section('content')
@include('layouts.nav')

    <div class="container container__product my-4">

        <div class="image__container">
            <div class="row">
                <div class="col-lg-6 column__one">
                    @php $image = explode("|", $data->product_image_url); @endphp
                    <div class="main__image">
                        <img id="index-image" data-src="{{ $image[0] }}" src="https://lawnsolutionsaustralia.com.au/wp-content/themes/lsamaster/images/ajax-loader.gif" alt="{{$data->product_name}}" class="img-fluid p__image">
                    </div>
                    @if(count($image) > 1)
                        <div class="main__image__button my-2">
                            @foreach($image as $img)
                            <a id="{{$img}}" class="fa fa-circle @if ($img == reset($image)) active @endif" onclick="btnCirle(this)"></a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="col-lg-6 column__two">
                    <div class="d-flex align-items-center product__store">
                        <a href="{{$data->sel_id}}">
                            <h5 class="font-weight-normal text-capitalize"><i class="fas fa-store"></i> {{$data->store_name}}</h5>
                        </a>
                    </div>

                    <small><span>Main ></span> {{$data->product_type}}</small>
                    <h4 class="text-capitalize font-weight-bold my-2 product__name">{{$data->product_name}}</h4>
                    <h5 class="my-1">&#8369; {{number_format($data->product_price, 2)}}</h5>
                    <form id="cart_form">
                    @csrf
                    <input type="hidden" id="cart_id" name="id" value="{{$data->pro_id}}">
                    @if(!empty($data->product_size) && !empty($data->product_color))
                        @php
                            $size = explode('|', $data->product_size)
                        @endphp
                        @php
                            $color = explode('|', $data->product_color)
                        @endphp
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group my-1">
                                    <label><h5 class="font-weight-bold mb-3">Color</h5></label>
                                    <div class="color__container">
                                        @foreach($color as $c)
                                            <input class="checkbox-attr" type="radio" name="product_color" id="{{$c}}" @if ($c == reset($color)) checked @endif value="{{$c}}">
                                            <label class="for-checkbox-attr" for="{{$c}}">
                                                <span data-hover="{{$c}}">{{$c}}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group my-1">
                                    <label><h5 class="font-weight-bold mb-3">Size</h5></label>
                                    <div class="size__container">
                                        @foreach($size as $s)
                                            <input class="checkbox-attr" type="radio" name="product_size" id="{{$s}}" @if ($s == reset($size)) checked @endif value="{{$s}}">
                                            <label class="for-checkbox-attr" for="{{$s}}">
                                                <span data-hover="{{$s}}">{{$s}}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                        <div class="form-group d-flex justify-content-left align-items-center quantity_parent_control my-2">
                            <div class="quantity-controls">
                                <a id="add" class="fa fa-plus"></a>
                                <strong>quantity</strong>
                                <a id="remove" class="fa fa-minus"></a>
                            </div>
                                <input type="text" value="1" name="product_quantity" id="cart_quantity" class="ml-4 disabled" onchange="if(this.value == 0) this.value = 1">
                        </div>
                        @if($data->status == 'resumed')
                            <button class="btn my-3 ml-0 btn-sm" disabled>Not available</button>
                        @else
                            <input type="submit" class="btn my-3 ml-0 btn-md btn-add-to-cart" value="Add to cart &#8594;">
                        @endif
                        <hr>
                        <h5 class="text-uppercase font-weight-bold my-2">Product Description</h5>
                        <p>{{$data->product_description}}</p>
                    </form>
                </div>
            </div>
            <div class="text-center m-5">
                <div class="d-flex justify-content-center
                ">
                    <a href="https://www.facebook.com/sharer.php?u={{URL::to('/')}}/products/{{$data->pro_id}}" class="text-dark mr-3"><i class="fab fa-facebook"></i> Share</a>
                    <a href="" class="text-dark mr-3"><i class="fab fa-twitter"></i> Twitter</a>
                    <a class="text-dark mr-3"><i class="fa fa-heart"></i> 0</a>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="related__products">
            <h5 class="my-4 font-weight-normal text-center">Other Related Products</h5>
            <div class="row d-flex justify-content-center">
                @if($relatedProduct->count() > 0)
                    @foreach($relatedProduct as $rp)
                        @php
                            $relatedImg = explode("|", $rp->product_image);
                        @endphp
                        <div class="col-lg-2 col-sm-4 col-6 related__pro_col">
                            <a href="{{$rp->id}}">
                                <div class="card mb-2">
                                    <img class="card-img-top" src="{{asset('/storage/images/products/'.$relatedImg[0].' ')}} " />
                                    <div class="card-body">
                                        <p class="card-title text-capitalize p-name">{{$rp->product_name}}</p>
                                        <p class="card-text">&#8369; {{number_format($rp->product_price, 2)}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <a href="" class="btn btn-sm">Continue shopping</a>
                @endif
            </div>
        </div>
        <div class="feedback__suggestions">
            <h5 class="my-4 font-weight-normal">Reviews &#9829;</h5>
            <div class="box__feedback">
                <p class="font-weight-bold">Vencer Olermo</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis recusandae rerum obcaecati architecto, eos ex delectus officia inventore error perspiciatis.</p>
                <div class="feedback__rate">1/5 <i class="fa fa-star"></i> <small>January 21, 2020</small></div>
                <hr>
            </div>
            <div class="box__feedback">
                <p class="font-weight-bold">Vencer Olermo</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, laboriosam?</p>
                <div class="feedback__rate">1/5 <i class="fa fa-star"></i> <small>January 21, 2020</small></div>
                <hr>
            </div>
        </div>
        <div class="my-2">
            <h5 class="font-weight-bold"></h5>
        </div>
    </div>

    @include('layouts.footer')

@endsection
@section('product')
    <script type="text/javascript">

            $(document).ready(function() {
                const quantity = document.querySelector("#cart_quantity");
                $('#cart_form').on('submit', function(e){
                    e.preventDefault();


                    let data = $(this).serializeArray();
                    let productName = document.querySelector('.product__name').innerHTML;

                    $.ajax({
                        type: 'post',
                        url: '{{route("add.cart")}}',
                        data: data,
                        dataType: 'json',
                        beforeSend: function(){
                            $('.btn-add-to-cart').attr('value', 'loading..').addClass('disabled');
                        },
                        success: function(data){
                            if(data.status == 'ok'){
                                $('.btn-add-to-cart').attr('value', 'add to cart').removeClass('disabled');
                                getCart()
                                countCart()
                                Swal.fire({
                                    icon: 'success',
                                    title: productName + ' added to your cart'
                                })
                                quantity.value = 1
                            }else{
                                $('.btn-add-to-cart').attr('value', 'add to cart').removeClass('disabled');
                                getCart()
                                Swal.fire({
                                    icon: 'success',
                                    title: productName + ' added to your cart'
                                })
                                quantity.value = 1
                            }
                        }
                    });
                });

                var counter = 1;

                $('#add').click(function() {
                    if (counter < 100) {
                        counter++;
                        $('#cart_quantity').val(counter);
                        $('#cart_quantity').attr('value', counter);
                    };
                });
                $('#remove').click(function() {
                    if (counter > 1) {
                        counter--;
                        $('#cart_quantity').val(counter);
                        $('#cart_quantity').attr('value', counter);
                    };
                });


            });

            function btnCirle(btn) {
                let Iimg = document.getElementById("index-image");
                let current = document.getElementsByClassName("active");

                current[0].className = current[0].className.replace(" active", "");
                btn.className += " active";

                Iimg.src = btn.id
            }

            var slideIndex = 0;
            showSlides();

            function showSlides() {
                var i;
                var indexImg = document.querySelector("#index-image");
                var dots = document.getElementsByClassName("fa-circle");

                slideIndex++;
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                if (slideIndex > dots.length) {slideIndex = 1}
                dots[slideIndex-1].className += " active";
                indexImg.src = dots[slideIndex-1].getAttribute("id")

                setTimeout(showSlides, 4000);
            }

            document.addEventListener("DOMContentLoaded", function() {
                countCart()
            });
    </script>
@endsection
