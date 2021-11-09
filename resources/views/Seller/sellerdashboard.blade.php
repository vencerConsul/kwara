@extends('layouts.app')

@if($STATUS == "not-approve")

@section('title')
Make appointment
@endsection

@section('makeappointmentcss')
<link rel="stylesheet" href="{{ asset('css/seller/datedropdown.css') }}">
<link rel="stylesheet" href="{{ asset('css/seller/timedropper.css') }}">
<link rel="stylesheet" href="{{ asset('css/seller/makeappointment.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div id="make__appointment">
        <div class="row">
            <div class="col-lg-6 column__one col-sm-6">
                <div class="column__one__content">
                    <div class="column__one__upper">
                        <h1>Great!</h1>
                        <p>Make your schedule now!</p>
                    </div>
                    <img class="img-fluid" src="{{ asset('/images/sellers/appointment.png') }}">
                </div>
            </div>
            <div class="col-lg-6 column__two col-sm-6">
                <div class="card mt-5">
                    <div class="card-body">
                    <h5>Welcome <span class="text-capitalize font-weight-bold">{{Auth::user()->firstname}}</span>, Make an schedule to meet our admins for your payment</h5>

                        <form method="POST" action="{{route('make.appointment')}}">
                            @csrf
                            <div class="form-group mt-4">
                                <div class="md-form input-with-post-icon">
                                    <i class="fas fa-calendar-alt input-prefix text-white"></i>
                                    <input placeholder="dd/mm/yyyy" type="text" id="date-input"
                                    name="schedule_date"
                                    class="form-control datepicker text-white mt-1">
                                    <label for="date-picker-example">Schedule date</label>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <div class="md-form input-with-post-icon">
                                    <i class="fas fa-clock input-prefix text-white"></i>
                                    <input placeholder="Selected time" type="text" id="alarm"
                                    name="schedule_time"
                                    class="form-control timepicker text-white mt-1">
                                    <label for="inputalarm_starttime">Schedule time</label>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <div class="md-form input-with-post-icon">
                                    <i class="fas fa-paper-plane input-prefix text-white"></i>
                                    <textarea id="form21" class="md-textarea form-control text-white"
                                    rows="2"
                                    name="schedule_message"></textarea>
                                    <label for="form21">Some message(optional)</label>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label class="text-white">Place to meet</label>
                            </div>
                            <div class="form-group ">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input mt-1" id="place" name="schedule_place" value="Seven Eleven">
                                    <label class="form-check-label" for="place">Seven Eleven</label>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input mt-1" id="place" name="schedule_place" value="Complex">
                                    <label class="form-check-label" for="place">Complex</label>
                                </div>
                            </div>
                            <div class="login-footer text-center">
                                <button type="submit" class="btn mt-2 btn-sm">Submit</button>
                                <br />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('makeappointment')
<script src="{{ asset('js/seller/datedropper.pro.min.js') }}"></script>
<script src="{{ asset('js/seller/makeappointment.js') }}"></script>
<script src="{{ asset('js/seller/timedropper.js') }}"></script>
@endsection

@elseif($STATUS === "pending")

@section('title')
Pending appointment
@endsection

@section('appointmentinfo')
<link rel="stylesheet" href="{{ asset('css/seller/appointmentinfo.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 column__one">
            <img class="img-fluid" src="{{asset('images/sellers/pending.png')}}" alt="Pending appointment">
        </div>
        <div class="col-lg-6 column__two">
            <div class="column__two__content">
                <h4 class="mb-2">Hello <span class="font-weight-bold text-capitalize">{{Auth::user()->firstname}}!</h4></span>
                <h5>
                    Just a reminder from Kwara about your appointment on <span class="font-weight-bold">{{ date("F j, Y", strtotime($pendingAppointment->schedule_date)) }}</span> at <span class="font-weight-bold">{{$pendingAppointment->schedule_place}}, {{$pendingAppointment->schedule_time}}</span>. Please note, this is valid until <span class="font-weight-bold">{{date('F j, Y, g:i a', Auth::user()->expiration_date)}}.</span>  If you need to reschedule, contact <a href="tel:09618382290" class="font-weight-bold text-white">09618382290</a>, Thanks!
                </h5>

                <button class="btn btn-sm ml-0 btn-light my-3" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Sign out</button>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@else

@section('title')
Dashboard
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
@endsection

@section('content')
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-top">
        <!-- Left navbar linkss -->
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
    <aside class="main-sidebar sidebar-light-light elevation-4 position-fixed">

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
                        <a href="{{route('product.buyer')}}" class="nav-link">
                            <i class="fas fa-users nav-icon"></i>
                            <p>
                                Buyer
                                <i class="fas fa-long-arrow-alt-right right"></i>
                            </p>
                        </a>
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
                                <h5 class="font-weight-bold">455</h5>
                                <small>Total Sales</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-coins"></i>
                            </div>
                            <a href="#" class="small-box-footer">View</i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-light mb-3">
                            <div class="inner">
                                <h5 class="font-weight-bold" id="count__product">0</h5>
                                <small>Total Products</small>
                            </div>
                            <div class="icon">
                                <i class="fab fa-product-hunt"></i>
                            </div>
                            <a href="#tableProducts" class="small-box-footer">View </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-light mb-3">
                            <div class="inner">
                                <h5 class="font-weight-bold">65</h5>
                                <small>Product Visitors</small>
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
                                <h5 class="font-weight-bold">53</h5>
                                <small>Reports</small>
                            </div>
                            <div class="icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <a href="#" class="small-box-footer">view</i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card dashboard__table" id="tableProducts">
                            <div class="card-header">
                                <small class="card-title"><small>Products</small></small>
                            <a href="{{ route('seller.addProduct') }}" class="btn float-right btn-sm"><i class="fa fa-plus"></i> <small>product</small></a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive table-buttons">

                                <table id="sellerTable" class="table dt-responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th><small>Product</small></th>
                                            <th><small>Action</small></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sellerProducts as $sp)
                                            <tr id="t__row{{ $sp->id}}">
                                                <td class="d-flex">
                                                    @php $productImageFirst = explode("|", $sp->product_image_url);
                                                    @endphp
                    <img src="{{$productImageFirst[0]}}" style="width: 70px;height:70px; object-fit:cover;" alt="{{$sp->product_name}}">
                                                    <div class="ml-2 d-flex justify-content-center align-items-center">
                                                        <div class="row">
                                                            <div class="col-lg-6 d-flex flex-column">
                                                                <small class="text-capitalize p-name">{{$sp->product_name}}</small>
                                                                <small>&#8369 {{number_format($sp->product_price)}}</small>
                                                                <small>Stock: {{$sp->product_stock}}</small>
                                                            </div>
                                                            <div class="col-lg-6 d-flex flex-column">
                                                                <small>
                                                                    {{$sp->product_type}}
                                                                @if(!empty($sp->product_size && !empty($sp->product_color)))
                                                                        <br />
                                                                        {{str_replace("|", ", ", $sp->product_size)}}
                                                                        <br />
                                                                        {{str_replace("|", ", ", $sp->product_color)}}
                                                                @endif
                                                                </small>
                                                                <small>
                                                                    @if($sp->product_discount === 100)
                                                                    No discount
                                                                @else
                                                                    {{$sp->product_discount}}%
                                                                @endif
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm">
                                                        <a href="edit-product/{{ encrypt($sp->id) }}"><i class="fa fa-edit"></i>
                                                        </a>
                                                    </button>
                                                    <button class="btn"
                                                        id="{{ $sp->id}}"
                                                        onclick="trash(this.id)">
                                                        <i class="fa fa-times text-danger"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <!-- /.card-body -->
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
<script src="{{ asset('/dashboard/js/demo.js') }}"></script>>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ asset('/js/seller/dashboard.js') }}"></script>
@endsection
@endif
