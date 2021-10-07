@extends('layouts.app')

@section('title')
Buyers
@endsection

@section('sellerstyle')
<link rel="stylesheet" href="{{ asset('/dashboard/css/adminlte.min.css') }}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('/dashboard/css/OverlayScrollbars.min.css') }}">
<link rel="stylesheet" href="{{ asset('/dashboard/seller/css/sellerdashboard.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/seller/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/seller/buyer.css') }}">
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
            <div class="user-panel d-flex align-items-center justify-content-center">
                <div class="logo"><span class="symbol">&#128615;</span> KWARA</div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p class="text-capitalize">
                                {{Auth::user()->firstname . ' ' . Auth::user()->lastname}}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="{{ route('logout') }}">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Manage account</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                    <i class="nav-icon fas fa-sign-in-alt "></i>
                                    <p>Sign out</p>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
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

                    @foreach($orderProduct as $o)
                        <div class="card mb-2">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <small>Buyer name: <span class="font-weight-bold text-capitalize">{{$o->firstname . ' ' . $o->lastname}}</span></small>
                                    </div>
                                    <div class="col-lg-6">
                                        <small>Tracking number: <span class="font-weight-bold">{{$o->order_number}}</span></small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 d-flex flex-column justify-content-center">
                                        <img src="{{ asset("/storage/images/products/$o->product_image")}}" alt="{{$o->product_name}}" style="width: 100px; height: 100px; object-fit:cover;">
                                    </div>
                                    <div class="col-lg-4 d-flex flex-column justify-content-center">
                                        <small>Product Name: <span>{{$o->product_name}}</span></small>
                                        <small>Product Price: <span>&#8369; {{number_format($o->product_price, 2)}}</span></small>
                                        <small>Product Quantity: <span>{{$o->product_quantity}}</span></small>
                                        @if($o->product_size && $o->product_color)
                                        <small>Product Size: <span>{{$o->product_size}}</span></small>
                                        <small>Product Color: <span>{{$o->product_color}}</span></small>
                                        @endif
                                    </div>
                                    <div class="col-lg-4 d-flex flex-column justify-content-center">
                                        <small>Order Status: <span class="@if($o->status == 'pending') text-warning @else text-info @endif font-weight-bold">{{$o->status}}</span></small>
                                        <small>Payment mode: <span>{{$o->payment_method}}</span></small>
                                        <small>Ordered: <span>{{date('F d, y, h:i', strtotime($o->created_at))}}</span></small>
                                        <small>Total Price: <span>&#8369; {{number_format($o->product_price * $o->product_quantity, 2)}}</span></small>
                                    </div>
                                </div>
                            </div>
                            @if($o->buyer_photo)
                                <div class="card-footer d-flex p-0 buyer__identity">
                                    <a class="btn btn-sm btn-block" data-original="{{ asset("/storage/images/buyer_photo/$o->buyer_photo")}}" onclick="buyerPT(this)">Buyer Photo</a>
                                    <a class="btn btn-sm btn-block" data-original="{{ asset("/storage/images/buyer_identity/$o->buyer_identity")}}" onclick="buyerID(this)">Buyer ID</a>
                                </div>
                            @endif
                        </div>
                    @endforeach
            </div>
        </section>
    </div>
    <footer class="main-footer">
        <div class="text-center">
            Gotchu 2020
        </div>
    </footer>
</div>
<div class="modal__identity" onclick="closeModal(this)">
    <img src="https://images.pexels.com/photos/1693095/pexels-photo-1693095.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="" class="full__view">
</div>
<!-- ./wrapper -->
@endsection

@section('sellerscript')
<script src="{{ asset('/dashboard/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/adminlte.js') }}"></script>
<script src="{{ asset('/dashboard/js/demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>

    function buyerPT(buyer_p){
        document.querySelector('.full__view').src = buyer_p.getAttribute('data-original');
        document.querySelector('.modal__identity').classList.add('open')
    }

    function buyerID(buyer_p){
        document.querySelector('.full__view').src = buyer_p.getAttribute('data-original');
        document.querySelector('.modal__identity').classList.add('open')
    }

    function closeModal(e){
        if(e.classList.contains('modal__identity')){
            document.querySelector('.modal__identity').classList.remove('open')
        }
    }

</script>
@endsection
