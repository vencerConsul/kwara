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
                    Just a reminder from Kwara about your appointment on <span class="text-info">{{ date('l, F d y', strtotime($pendingAppointment->schedule_date)) }}</span> at <span class="text-info">{{$pendingAppointment->schedule_place}}, {{$pendingAppointment->schedule_time}}</span>. Please note, your appointment is valid until <span class="text-warning">{{date('l, F d y, h:i a', Auth::user()->expiration_date)}}.</span>  If you need to reschedule, contact <a href="tel:09618382290">09618382290 <i class="fa fa-phone"></i></a>, Thanks!
                </h5>

                <button class="btn btn-sm ml-0 btn-light" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Sign out</button>

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
    <aside class="main-sidebar sidebar-light-light elevation-4">

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex  align-items-center">
                <div class="image">
                    @if(Auth::user()->profile == 0)
                        <i class="fa fa-user"></i>
                    @else
                        <img src="{{ asset('images/admin/venz.jpg') }}" class="img-circle elevation-2" alt="seller profile" style="object-fit: cover; height: 40px; width:40px;">
                    @endif
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

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-light mb-3">
                            <div class="inner">
                                <h3>150</h3>
                                <p>Total Sales</p>
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
                                <h3 id="count__product">0</h3>
                                <p>Total Products</p>
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
                    <div class="col-lg-12">
                        <div class="card dashboard__table" id="tableProducts">
                            <div class="card-header">
                                <h3 class="card-title">Products</h3>
                            <a href="{{ route('seller.addProduct') }}" class="btn float-right"><i class="fa fa-plus"></i> product</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive table-buttons">

                                <table id="sellerTable" class="table dt-responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Product name</th>
                                            <th>Product price</th>
                                            <th>Product stocks</th>
                                            <th>Product type</th>
                                            <th>Product discount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach($sellerProducts as $sp)
                                            <tr id="t__row{{ $sp->id}}">
                                                <td>
                                                    @php $productImageFirst = explode("|", $sp->product_image);
                                                    @endphp
                                                    <img class="img-fluid" src="{{ asset('OriginalProductImg/'.$productImageFirst[0].'') }}" alt="{{$sp->product_name}}" style="width: 50px;height:50px; object-fit:cover;">
                                                </td>
                                                <td class="text-capitalize">{{$sp->product_name}}</td>
                                                <td>&#8369 {{number_format($sp->product_price)}}</td>
                                                <td>{{$sp->product_stock}}</td>
                                                <td>
                                                    {{$sp->product_type}}
                                                    @if($sp->productAttributes->count() > 0)
                                                        @foreach($sp->productAttributes as $attr)
                                                            <br />
                                                            {{str_replace("|", ", ", $attr->product_size)}}
                                                            <br />
                                                            {{str_replace("|", ", ", $attr->product_color)}}
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($sp->product_discount === 100)
                                                        No discount
                                                    @else
                                                        {{$sp->product_discount}}%
                                                    @endif
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
