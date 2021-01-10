@extends('layouts.app')

@section('title')
My Account
@endsection

@section('userlogin')
<link rel="stylesheet" href="{{ asset('css/mainpage/myaccount.css') }}">
@endsection

@section('content')
@include('layouts.nav')

<!-- hero -->
<div id="my__account" class="container-fluid">
    {{-- cintainer --}}
    <div class="container">
        {{-- row --}}
        <div class="row">
            {{-- column 1 --}}
            <div class="col-lg-3 col-md-5 column__one">
                <div class="column__one__content">
                    <div class="card my-5">
                        <div class="dropdown">
                            <i class="fa fa-align-left pt-2 pl-2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </i>

                            <div class="dropdown-menu text-center">
                                <form method="post" action="{{ route('chanageprofile') }}" enctype="multipart/form-data" class="px-4 py-3">
                                    @csrf
                                    <label>Upload profile</label>
                                    <div class="form-group">
                                        <input type="file" class="form-control d-none" name="file" id="profile" onchange="profileChanage()">
                                    </div>
                                    <img class="img-fluid" src="/images/icons/upload-image.png" onclick="event.preventDefault(); document.getElementById('profile').click()">
                                    <button type="submit" id="upload-pro" class="btn btn-dark btn-sm disabled">Upload</button>
                                </form>
                            </div>
                        </div>

                        @if(Auth::user()->profile == 0)
                        <img class="img-fluid ml-5 mr-5 mx-auto column__one__profile" src="/images/icons/avatar.svg">
                        @else
                        <img class="img-fluid ml-5 mr-5 mx-auto column__one__profile" src="/profile_images/{{ Auth::user()->profile }}">
                        @endif
                        <h5 class="text-capitalize text-center my-3">{{ Auth::user()->firstname .' '. Auth::user()->lastname }}</h5>
                        <div class="card-body p-0">
                            <ul class="list-group">
                                <a class="disabled">
                                    <li class="list-group-item list__group__active">
                                        <div class="md-v-line"></div><i class="fas fa-user-edit mr-3"></i>Manage profile
                                    </li>
                                </a>
                                <a href="">
                                    <li class="list-group-item">
                                        <div class="md-v-line"></div><i class="fas fa-money-bill-alt mr-3"></i>My purchases
                                    </li>
                                </a>
                                <a href="{{ route('user.changepassword') }}">
                                    <li class="list-group-item">
                                        <div class="md-v-line"></div><i class="fas fa-unlock mr-3"></i> Change password
                                    </li>
                                </a><a href="{{ route('user.shippingaddress') }}">
                                    <li class="list-group-item">
                                        <div class="md-v-line"></div><i class="fas fa-address-card mr-3"></i>Shipping Address
                                    </li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end column 1 --}}

            {{-- column 2 --}}
            <div class="col-lg-9 col-md-7 column__two">
                <div class="card my-5">
                    <p class="card-header">My account</p>
                    <div class="card-body">
                        {{-- form --}}
                        <form action="{{ route('updateInfo') }}" method="POST">
                            @csrf
                            <div class="form-group p-2">
                                <div class="md-form">
                                    <input type="email" id="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                                    <label for="email">Email Address (cannot be modified)</label>
                                </div>
                            </div>
                            <div class="form-group p-2">
                                <div class="md-form">
                                    <input type="text" id="date" class="form-control text-disabled" value="{{ date('F j, Y', strtotime(Auth::user()->created_at)) }}" disabled>
                                    <label class="disabled" for="date">Date created (cannot be modified)</label>
                                </div>
                            </div>
                            <div class="form-group p-2">
                                <div class="md-form">
                                    <input type="text" id="firstname" class="form-control" name="firstname" value="{{ Auth::user()->firstname }}">
                                    <label for="firstname">Firstname</label>
                                </div>
                            </div>
                            <div class="form-group p-2">
                                <div class="md-form">
                                    <input type="text" id="lastname" class="form-control" name="lastname" value="{{ Auth::user()->lastname }}">
                                    <label for="lastname">Lastname</label>
                                </div>
                            </div>
                            <div class="form-group p-2">
                                <button type="submit" class="btn m-0 btn-sm">Update info</button>
                            </div>
                        </form>
                        {{-- end form --}}
                    </div>
                </div>
            </div>
            {{-- end column 2 --}}
        </div>
        {{-- end row --}}
    </div>
    {{-- end container --}}
</div>

@include('layouts.footer')
@endsection

@section('myaccount')
<script src="{{ asset('/js/mainpage/myaccount.js') }}" defer></script>
@endsection