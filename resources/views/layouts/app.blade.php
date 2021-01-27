<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="shortcut icon" href="/images/title-icon.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.2/sweetalert2.min.css" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- mainpage style --}}
    @yield('navbar_sidenavtyle')
    @yield('mainpagestyle')
    @yield('footerstyle')
    @yield('mycart')

    {{-- user style --}}
    @yield('userlogin')
    @yield('userregister')

    {{-- seller --}}
    @yield('sellerlogin')
    @yield('sellerregister')
    @yield('sellerstyle')
    @yield('appointmentinfo')

    {{-- admin style --}}
    @yield('adminstyle')
    @yield('showalltablesstyle')
    @yield('login_register')
    @yield('makeappointmentcss')
</head>

<body>
    <div id="app">
        @yield('content')
    </div>

    <!-- scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
    @yield('NavbarScript')
    @yield('myaccount')
    @yield('mainpagescript')
    @yield('product')
    @yield('shipping')
    @yield('validation')
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@10"])
    @yield('adminscript')
    @yield('sellerscript')
    @yield('sellerlogAndreg')
    @yield('makeappointment')
    @yield('showalltablesscript')

    @if(Auth::guard('web')->check())
        <script type="text/javascript">
        window.addEventListener("load", function () {
            setCookie()
            checkAbandonCart()

            async function setCookie(){
                await fetch('{{route("set.cookie")}}', {
                        method: "GET",
                    })
                    .then(result => {
                        return result.json()
                    }).then(data =>{
                        if(data.status === 'ok'){
                            Swal.fire(
                                'Allow cookies for better performance'
                            )
                        }
                })
            }
            async function checkAbandonCart(){
                await fetch('{{route("check.AbandonCart")}}', {
                        method: "GET",
                    });
            }
        });
    </script>
    @endif

</body>
</html>
