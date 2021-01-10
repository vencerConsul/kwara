@extends('layouts.app')

@section('title')
Administrator
@endsection

@section('adminstyle')
<link rel="stylesheet" href="{{ asset('/dashboard/css/adminlte.min.css') }}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('/dashboard/css/OverlayScrollbars.min.css') }}">
<link rel="stylesheet" href="{{ asset('/dashboard/admin/css/admin.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/seller/dashboard.css') }}">
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
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ asset('images/admin/venz.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ asset('images/admin/venz.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ asset('images/admin/venz.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
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
                    <a class="d-block text-capitalize">{{ Auth::user()->name }}</a>
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

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-light mb-3">
                            <div class="inner">
                                <h3>{{$total_user->count()}}</h3>
                                <p>Total Users</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <a href="{{ route('show.tableForUsers') }}" class="small-box-footer">View</i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-light mb-3">
                            <div class="inner">
                                <h3>{{$total_seller->count()}}</h3>
                                <p>Total Sellers</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <a href="{{ route('show.tableForSellers') }}" class="small-box-footer">View </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-light mb-3">
                            <div class="inner">
                                <h3>65</h3>
                                <p>Product Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-eye"></i>
                            </div>
                            <a href="#" class="small-box-footer">View</i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-light mb-3">
                            <div class="inner">
                                <h3>53</h3>
                                <p>Reports</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <a href="#" class="small-box-footer">view</i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <section class="col-lg-6 connectedSortable">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Users</h3>

                                <div class="card-tools">
                                    <span class="badge badge-danger">{{$total_user->count()}} Members</span>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="users-list clearfix" id="posts">
                                    @if($user->count() == 0)
                                    <div class="text-center my-4">
                                        no users yet
                                    </div>
                                    @else
                                    @foreach($user as $u)
                                    <li>
                                        @if($u->profile == 0)
                                        <img src="{{asset('images/icons/avatar.svg')}}" alt="User Image">
                                        @else
                                        <img src="profile_images/{{ $u->profile }}" alt=" User Image">
                                        @endif
                                        <small class="users-list-name text-capitalize">{{ $u->firstname .' '.  $u->lastname}}</small>
                                        <small class="users-list-date">{{ $u->created_at->diffForHumans() }}</small>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ route('show.tableForUsers') }}">View all</a>
                            </div>
                        </div>
                    </section>

                    <section class="col-lg-6 connectedSortable">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Seller</h3>

                                <div class="card-tools">
                                    <span class="badge badge-danger">{{$total_seller->count()}} Members</span>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="users-list clearfix">
                                    @if($seller->count() == 0)
                                    <div class="text-center my-4">
                                        no seller yet
                                    </div>
                                    @else
                                    @foreach($seller as $s)
                                    <li>
                                        <div class="image__container">
                                            <img src="{{asset('images/icons/avatar.svg')}}" alt="User Image">
                                            @if($s->status == "approved")<i class="fa fa-check text-white"></i>@elseif($s->status == "pending")<i 1class="fas fa-calendar-times text-white"></i>@else<i class="fa fa-times text-white"></i>@endif
                                        </div>
                                        <a class="users-list-name text-capitalize" href="#">{{$s->firstname .' ' . $s->lastname}} </a>
                                        <span class="users-list-date">{{$s->created_at->diffForHumans()}}</span>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ route('show.tableForSellers') }}">View Seller</a>
                            </div>
                        </div>
                    </section>
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
@section('adminscript')
<script src="{{ asset('/dashboard/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/adminlte.js') }}"></script>
<script src="{{ asset('/dashboard/js/demo.js') }}"></script>
@endsection
