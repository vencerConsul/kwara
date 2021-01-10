@section('navbar_sidenavtyle')
<link rel="stylesheet" href="{{ asset('css/layout/navbar_sidenav.css') }}">
@endsection

<div id="home__" class="top__header">
    <div class="top__header__content d-flex justify-content-between container">
        <div class="top__header__social d-flex">
            <a href="" title="facebook"><i class="fab fa-facebook"></i></a>
            <a href="" title="twitter"><i class="fab fa-twitter"></i></a>
            <a href="" title="google"><i class="fab fa-google-plus"></i></a>
        </div>
        <div class="d-flex top__header__loginregister">
            @guest
                <a class="nav-link text-dark" href="{{ route('login') }}">
                Sign in</a>
                <a class="nav-link text-dark" href="{{ route('register') }}">Sign up</a>
            @endguest
            @auth
                @if(Route::current()->getName() == 'Main')
                    <a class="nav-link text-dark" href="{{ route('user.myaccount') }}"><i class="fa fa-user"></i> My account</a>
                @else
                    <a class="nav-link text-dark" href="{{ route('Main') }}">Home</a>
                @endif
                    <span class="divider"></span>
                    <a class="nav-link text-dark" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Sign out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
            @endauth
        </div>
    </div>
</div>
<nav class="navbar__content navbar sticky-top navbar-expand-lg navbar-light scrolling-navbar">
    <div class="container">
        <a href="{{ URL::to('/') }}" class="navbar-brand"><img class="navbar__logo" src="{{ asset('/images/logo.png') }}"></a>

        @if (Route::current()->getName() == 'Main' || Route::current()->getName() == 'product')
        <div class="ml-auto searchFor">
            <div class="input-group">
                <select class="browser-default custom-select rounded-0">
                    <option selected>Product type</option>
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
            <div class="input-group">
                <input type="text" class="form-control rounded-0" placeholder="looking for..."
                    aria-describedby="searchFor">
                <div class="input-group-append">
                    <button class="btn btn-md m-0 px-3 py-2 z-depth-0 waves-effect" type="button" id="searchFor"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        @endif

        <div class="ml-3 ml-auto d-flex navbar__left__icons justify-content-between align-items-baseline">
            <div class="icons">
                <i class="fab fa-opencart" title="cart"></i>
                <small>0</small>
            </div>

            <div class="icons">
                <i class="fas fa-search mobile__searchFor"></i>
            </div>
        </div>

        <div class="ml-auto navbar__menu__humberger">
            <div class="navbar__menu__humberger__burger"></div>
        </div>

    </div>
</nav>

<div id="sidebar__overlay"></div>
<div id="sidebar__content">
    <div class="container">
        @auth
        @if(Route::current()->getName() == 'user.myaccount')
        <div class="dropdown">
            <i class="fa fa-align-left mt-3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </i>

            <div class="dropdown-menu text-center">
                <form method="post" action="{{ route('changeSidebarProfile') }}" enctype="multipart/form-data" class="px-4 py-3">
                    @csrf
                    <label>Change profile</label>
                    <div class="form-group">
                        <input type="file" class="form-control d-none" name="sidenavprofile" id="sidebarProfile" onchange="sidebarProfileChanage()">
                    </div>
                    <img class="img-fluid" src="{{ asset('/images/icons/upload-image.png') }}" onclick="event.preventDefault(); document.getElementById('sidebarProfile').click()">
                    <button type="submit" id="upload-sidebar-pro" class="btn btn-dark btn-sm disabled">Upload</button>
                </form>
            </div>
        </div>
        @endif
        @endauth
        <div class="my-2 sidebar__header">
            <div class="sidebar__profile">
                @auth
                @if(Auth::user()->profile == 0)
                <img class="img-fluid @if(Route::current()->getName() != 'user.myaccount') mt-5 @endif" src="{{ asset('/images/icons/avatar.svg') }}">
                @else
                <img class="img-fluid @if(Route::current()->getName() != 'user.myaccount') mt-5 @endif" src="{{ asset('/profile_images/'.Auth::user()->profile.'') }}">
                @endif
                @endauth
                @guest
                <img class="img-fluid @if(Route::current()->getName() != 'user.myaccount') mt-5 @endif" src="{{ asset('/images/icons/avatar.svg') }}">
                @endguest
            </div>
            <br />
            @auth
            <div class="sidebar__user__info">
                <div class="sidebar__user__basic__info">
                    <span class="my-1 text-capitalize">{{ Auth::user()->firstname .' '. Auth::user()->lastname }}</span>
                    <br />
                    <small class="text-info">{{ Auth::user()->email}}</small>
                </div>
            </div>
            @endauth
            @guest
            <div class="sidebar__buttons">
                <a class="btn" href="{{ route('login') }}">
                    Sign in
                </a>
                <a class="btn" href="{{ route('register') }}">
                    Sign up
                </a>
            </div>
            @endguest
            <hr class="header__divider" />
        </div>
        <div class="header__body">
            <ul class="text-left">
                @auth
                <a class="@if(Route::current()->getName() == 'Main' || Route::current()->getName() == 'user')disabled @endif" href="{{ URL::to('/') }}">
                    <li>
                        <i class="fa fa-home mr-3"></i>
                        @if(Route::current()->getName() == 'Main' || Route::current()->getName() == 'user')&nbsp;Home
                        @if(Route::current()->getName() == 'Main' || Route::current()->getName() == 'user')
                        <i class="fas fa-caret-left"></i>
                        @endif
                        @else continue shopping
                        @endif
                    </li>
                </a>
                <a class="@if(Route::current()->getName() == 'user.myaccount') disabled @endif" href="{{ route('user.myaccount') }}">
                    <li>
                        <i class="fas fa-user-edit mr-3"></i>
                        My Account
                        @if(Route::current()->getName() == 'user.myaccount')
                        <i class="fas fa-caret-left"></i>
                        @endif
                    </li>
                </a>
                <a href="{{ route('user.myaccount') }}">
                    <li>
                        <i class="fas fa-archive mr-3"></i>&nbsp; My Purchases
                    </li>
                </a>
                <a class="@if(Route::current()->getName() == 'user.changepassword') disabled @endif" href="{{ route('user.changepassword') }}">
                    <li>
                        <i class="fas fa-unlock mr-3"></i>&nbsp; Change password
                        @if(Route::current()->getName() == 'user.changepassword')
                        <i class="fas fa-caret-left"></i>
                        @endif
                    </li>
                </a>
                <a class="@if(Route::current()->getName() == 'user.shippingaddress' || Route::current()->getName() == 'user.editaddress') disabled @endif" href="{{ route('user.shippingaddress') }}">
                    <li>
                        <i class="fas fa-address-card mr-3"></i>
                        Shipping Address
                        @if(Route::current()->getName() == 'user.shippingaddress' || Route::current()->getName() == 'user.editaddress')
                        <i class="fas fa-caret-left"></i>
                        @endif
                    </li>
                </a>
                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}">
                    <li>
                        <i class="fas fa-sign-out-alt mr-3"></i>&nbsp;Sign out
                    </li>
                </a>
                @endauth
            @guest
            <li>
                <i class="fas fa-home"></i>
                <a href="{{ URL::to('/') }}">Home</a>
            </li>
            <li>
                <i class="far fa-question-circle"></i>
                <a href="{{ URL::to('/') }}"> About us</a>
            </li>
            <li>
                <i class="fas fa-exclamation-triangle"></i>
                <a href="{{ URL::to('/') }}">Terms and Conditions</a>
            </li>
            @endguest
        </ul>
        </div>
    </div>
</div>


@section('NavbarScript')
<script src="{{ asset('/js/mainpage/nav.js') }}" defer></script>
@endsection
