@extends('layouts.app')

@section('title')
Account on hold
@endsection

@section('showalltablesstyle')

<style>
    .resumed__account .column__one{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: var(--semi-grey);
    }
    .resumed__account .column__two{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .resumed__account .column__two .btn{
        box-shadow: none;
        border-radius: 0;
        color: #ffffff;
        background: var(--semi-grey) !important;
    }
</style>

@section('content')
    <div class="container-fluid resumed__account">
        <div class="row">
            <div class="col-lg-6 column__one">
                <img class="img-fluid" src="{{asset('images/seller-img/resumed.png')}}" alt="account on hold">
            </div>
            <div class="col-lg-6 column__two">
                <div class="message container">
                    <h4>Hello <span class="text-capitalize font-weight-bold">{{ Auth::user()->firstname . ' ' .Auth::user()->lastname}},</span> <br /><br /> Your membership has expired on {{date('l, F d y', strtotime(Auth::user()->expiration_date))}}, renew your membership to continue using this app.<br /><br /> Thank you. </h4>
                    <button class="btn btn-md ml-0 mt-2">Renew membership</button>
                    <a href="{{route('seller.dashboard')}}" class="btn btn-md ml-0 mt-2">back to dashboard</a>
                </div>
            </div>
        </div>
    </div>
@endsection

