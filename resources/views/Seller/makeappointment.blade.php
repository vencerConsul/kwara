@extends('layouts.app')

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
                    <img class="img-fluid" src="{{ asset('/images/appointment.svg') }}">
                </div>
            </div>
            <div class="col-lg-6 column__two col-sm-6">
                <div class="card mt-5">
                    <div class="card-body">
                    <p>Welcome <span class="text-capitalize"></span>, feel free to make an schedule, to meet our admins for your payment</p>

                        <form method="POST" >
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
                                    <input type="radio" class="form-check-input mt-1" id="place" name="schedule_place" value="town-propper">
                                    <label class="form-check-label" for="place">Bolinao(Town propper)</label>
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
