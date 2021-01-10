@extends('layouts.app')
@section('title')
Edit Product
@endsection

@section('sellerstyle')
<link rel="stylesheet" href="{{ asset('/dashboard/css/adminlte.min.css') }}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('/dashboard/css/OverlayScrollbars.min.css') }}">
<link rel="stylesheet" href="{{ asset('/dashboard/seller/css/sellerdashboard.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/seller/editproduct.css') }}">
@endsection

@section('content')
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-top">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-align-left"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
            <a href="{{ route('seller.dashboard') }}" title="back to dashboard" class="nav-link">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-light elevation-4">

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex  align-items-center">
                <div class="image">
                    <img src="{{ asset('images/admin/venz.jpg') }}" class="img-circle elevation-2" alt="seller profile" style="object-fit: cover; height: 40px; width:40px;">
                </div>
                <div class="info">
                    <a class="d-block text-capitalize">{{ Auth::user()->store_name }} Store</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Charts
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/charts/chartjs.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>ChartJS</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tree"></i>
                            <p>
                                UI Elements
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/UI/ribbons.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ribbons</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Forms
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/forms/general.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>General Elements</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Tables
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/tables/simple.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Simple Tables</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">EXAMPLES</li>
                    <li class="nav-item">
                        <a href="pages/calendar.html" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Calendar
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon fas fa-biohazard"></i>
                            <p>
                                Covid Update
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Account
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                    <i class="nav-icon fas fa-sign-in-alt "></i>
                                    <p>Sign out</p>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">
        <section class="content p-3">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-lg-4 column__one">
                                <h4>EDIT PRODUCT</h4>
                                <img class="img-fluid my-3" src="{{ asset('images/seller-img/edit-product.png') }}" alt="edit product">
                                <h5>Date Created</h5>
                                <small>{{ date('F j, Y h:i a', strtotime($products->created_at)) }}</small>
                                </div>
                                <div class="col-lg-8 column__two">
                                <form action="{{ URL('update-product/'.$products->id.'') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <div class="md-form md-outline input-with-post-icon">
                                                        <i class="fas fa-check-circle  input-prefix"></i>
                                                        <input type="text" name="product__name"
                                                        value="{{ old('product__name') ?? $products->product_name }}"
                                                        id="product__name" class="form-control">
                                                        <label for="product__name">Product name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <div class="md-form md-outline input-with-post-icon">
                                                        <i class="fas fa-hand-holding-usd  input-prefix"></i>
                                                        <input type="text"
                                                        name="product__price"
                                                        value="{{ old('product__price') ?? $products->product_price }}" id="product__price" class="form-control"
                                                        onkeypress="return isNumber(event)">
                                                        <label for="product__price">Product price</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <div class="md-form md-outline input-with-post-icon">
                                                        <i class="fas fa-archive  input-prefix"></i>
                                                        <input type="text"
                                                        name="product__stock"
                                                        value="{{ old('product__stock') ?? $products->product_stock }}"  id="product__stock" class="form-control"
                                                        onkeypress="return isNumber(event)">
                                                        <label for="product__stock">Product stock</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <div class="md-form md-outline input-with-post-icon">
                                                        <i class="fas fa-percent  input-prefix"></i>
                                                        <input type="text"
                                                        name="product__discount"
                                                        value="{{ old('product__discount') ?? $products->product_discount }}"
                                                        id="product__discount" class="form-control"
                                                        onkeypress="return isNumber(event)">
                                                        <label for="product__discount">Add discount (optional)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <textarea class="form-control bg-transparent" rows="2"
                                                    name="product__description"
                                                    value="{{ old('product__description') }}"
                                                    placeholder="Product description">{{ $products->product_description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="bg-white">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <i class="fas fa-images upload__image mt-3 mb-2" title="upload image" onclick="document.getElementById('files').click()"></i><br />
                                                    @php
                                                    $productImg = explode("|", $products->product_image)
                                                    @endphp
                                                    <input type="file" id="files" name="files[]" multiple>
                                                    @foreach($productImg as $img)
                                                    <input type="hidden" class="img{{str_replace(".", "_", $img)}}" name="old__files[]" value="{{$img}}">
                                                    <span class="container__multiple"><img class="imageThumb" src="{{ asset('ResizeProductImg/'.$img.'') }}"><br><span class="remove" onclick="del(this)" id="{{str_replace(".", "_", $img)}}"><i class="fa fa-times"></i></span></span>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mt-3">
                                                    <select class="form-control"
                                                    name="product__type"
                                                    id="select__product__type" style="width: 100%; height: 100%;" onchange="changeProductType(this)">
                                                        <option class="text-white" value="" selected>Product type</option>
                                                        <option value="Foods">Foods</option>
                                                        <option value="Clothes">Clothes</option>
                                                        <option value="Foot wears">Foot wears</option>
                                                        <option value="Accessories">Accessories</option>
                                                        <option value="Home Appliances">Home Appliances</option>
                                                        <option value="Hardware">Hardware</option>
                                                        <option value="Bike">Bike</option>
                                                        <option value="Gadgets">Gadgets</option>
                                                        <option value="Groceries">Groceries</option>
                                                        <option value="Make up & Fragrances">Make up & Fragrances</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="attribute">
                                                {{-- if the product type is clothes or foot wears then display input attributes --}}

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn ml-0 mt-3">update product</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer class="main-footer">
        <div class="text-center">
            Gotchu 2020
        </div>
    </footer>
</div>
<!-- ./wrapper -->
@endsection

@section('sellerscript')
<script src="{{ asset('/dashboard/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/adminlte.js') }}"></script>
<script src="{{ asset('/dashboard/js/demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ asset('/js/seller/editproduct.js') }}"></script>
@endsection

