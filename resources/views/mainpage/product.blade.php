@extends('layouts.app')

@section('title')
Product
@endsection

@section('mainpagestyle')
<link rel="stylesheet" href="{{ asset('css/mainpage/product.css') }}">
@endsection

@section('content')
@include('layouts.nav')
    <div class="container-product single-product mt-4">
        <div class="row-product">
            <div class="col-2-product">
                @php
                    $img = explode("|", $product->product_image)
                @endphp
                <img src="{{asset('/storage/images/products/'.$img[0].'')}}" alt="{{$product->product_name}}" width="100%" id="index-image" style="width:500;height:390px;">
                <div class="small-img-row">
                    @foreach($img as $smallImg)
                    <div class="small-img-col">
                        <img src="{{asset('/storage/images/products/'.$smallImg.'')}}" alt="{{$product->product_name}}" width="100%" style="width:100%;height:80px;object-fit:cover;object-position:50% 50%;" onclick="proImg(this.src)">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-2-product p-4">
                <a href="seller-store/{{$product->id}}" class="text-capitalize font-weight-normal text-dark">
                    <i class="fas fa-store"></i> {{$product->store_name}} Store
                </a>
                <p class="mt-2"><span>Main ></span> {{$product->product_type}}</p>
                <h4 class="text-capitalize my-3">{{$product->product_name}}</h4>
                <h5 class="my-1">&#8369; {{number_format($product->product_price)}}</h5>
                @if($pro->productAttributes->count() > 0)
                    @foreach($pro->productAttributes as $attr)
                        @php
                            $size = explode('|', $attr->product_size)
                        @endphp
                        @php
                            $color = explode('|', $attr->product_color)
                        @endphp
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group my-1">
                                    <label>Size</label>
                                    <select class="form-control">
                                        @foreach($size as $s)
                                            <option value="{{$s}}">{{$s}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group my-1">
                                    <label>Color</label>
                                    <select class="form-control">
                                        @foreach($color as $c)
                                            <option value="{{$c}}">{{$c}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="form-group my-1">
                    <label>Quantity</label>
                    <div class="def-number-input number-input safari_only">
                        <span onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus btn"></span>
                        <input class="quantity" min="1" name="quantity" value="1" type="number" onchange="Quantity(this.value)">
                        <span onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus btn"></span>
                    </div>
                    <small class="text-danger" id="quantity-error"></small>
                </div>
                    <input type="hidden">
                    @if($product->status == 'resumed')
                    <button class="btn my-3 ml-0 btn-sm" disabled>Not available</button>
                    @else
                    <form action="">
                        <button class="btn my-3 ml-0 btn-sm">Add to cart</button>
                    </form>
                    @endif

                <hr class="my-2">
                <p>{{$product->product_description}}</p>
            </div>
        </div>

        {{-- pfoduct reviews --}}
        <div id="product__reviews">
            <div class="container">
                <h5 class="font-weight-normal my-3">Product reviews</h5>
                <div class="box__review mb-2">
                    <p>Vencer Olermo</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ullam, provident.</p>
                    <small>January 1, 2021</small>
                    <span class="float-right">1/5 <i class="fa fa-star"></i></span>
                </div>
                <div class="box__review mb-2">
                    <p>Vencer Olermo</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ullam, provident.</p>
                    <small>January 1, 2021</small>
                    <span class="float-right">1/5 <i class="fa fa-star"></i></span>
                </div>
            </div>
        </div>
        <hr class="my-3">
        {{-- related product --}}
        <div class="container related__product">
            @if($relatedProduct->count() > 0)
            <h5 class="my-3 font-weight-normal">Related product</h5>
            @else
            <a href="{{ url()->previous() }}" class="btn btn-sm my-4">Go back</a>
            @endif
            <div class="row">
                @foreach($relatedProduct as $relatedPro)
                    <div class="col-lg-3 col-sm-4 col-6 ">
                        <a href="{{$relatedPro->id}}">
                            <div class="card mb-2">
                                @php
                                    $image = explode('|', $relatedPro->product_image)
                                @endphp
                                <img class="card-img-top" src="{{asset('/storage/images/products/'.$image[0].'')}}" />
                                <div class="card-body">
                                    <p class="card-title p-name">{{ $relatedPro->product_name}}</p>
                                    <p class="card-text">&#8369; {{number_format($relatedPro->product_price)}}</p>
                                    <div class="product__views">
                                        <small>(43 reviews)</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('layouts.footer')

@endsection
@section('product')
    <script src="{{asset('js/mainpage/product.js')}}"></script>
@endsection
