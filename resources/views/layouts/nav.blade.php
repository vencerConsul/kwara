@section('navbar_sidenavtyle')
<link rel="stylesheet" href="{{ asset('css/layout/navbar_sidenav.css') }}">
@endsection

<nav class="navbar__content navbar sticky-top navbar-expand-lg scrolling-navbar">
    <div class="container">
        <a href="{{ URL::to('/') }}" class="navbar-brand"><span class="symbol">&#128615;</span> KWARA</a>

        @if (Route::current()->getName() == 'Main' || Route::current()->getName() == 'product' || Route::current()->getName() == 'view.cart')
        <div class="ml-auto d-flex navbar__left__icons ">

            <button class="btn btn-sm text-white search_button">
                <i class="fas fa-search"></i>
            </button>

            <button class="btn btn-sm text-white cart_button" onclick="cart()">
                <i class="fab fa-opencart" title="cart"></i>
                <span class="cart_text">cart</span>
                <span id="cart__count"></span>
            </button>
        </div>
        @endif
        <div class="auth-menu d-flex">
            @guest
            <a class="nav-link" href="{{ route('login') }}">Sign in</a>
            @endguest
            @auth
                @if(Route::current()->getName() == 'Main')
                    <a class="nav-link mr-2" href="{{ route('user.myaccount') }}">My account</a>
                @else
                    <a class="nav-link mr-2" href="{{ route('Main') }}">Home</a>
                @endif
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Sign out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
            @endauth
        </div>

        <div class="ml-auto navbar__menu__humberger">
            <div class="navbar__menu__humberger__burger"></div>
        </div>

    </div>
</nav>

{{-- cart --}}
<div class="cart__overlay"></div>
<div class="cart__container">
    <div class="cart__header d-flex justify-content-center align-items-center">
        <h5 class="text-uppercase font-weight-normal my-4">My cart</h5>
        <div class="close__cart" style="font-size: 20px">
            &#215;
        </div>
    </div>
    <hr>
    <div class="cart__body my-3 p-2 text-white">

    </div>
    <div class="cart__footer">
        <h5>Subtotal: &#8369; <span id="Subtotal"> </span></h5>
        <hr>
        <a href="{{route('view.cart')}}" class="btn btn-md mt-3 btn-block">View cart &#8594;</a>
    </div>
</div>

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
                    <input type="submit" class="btn btn-sm" onClick="this.form.submit(); this.disabled=true; this.value='uploading..';" value="upload" style="box-shadow:none;background:#333;color:#fff;text-transform:capitalize;">
                </form>
            </div>
        </div>
        @endif
        @endauth
        <div class="my-2 sidebar__header">
            <div class="sidebar__profile">
                @auth
                @if(Auth::user()->profile == 0)
                <img class="img-fluid @if(Route::current()->getName() != 'user.myaccount') mt-5 @endif" src="{{ asset('/images/users/avatar.png') }}">
                @else
                <img class="img-fluid @if(Route::current()->getName() != 'user.myaccount') mt-5 @endif" src="{{ asset('/profile_images/'.Auth::user()->profile.'') }}">
                @endif
                @endauth
                @guest
                <img class="img-fluid @if(Route::current()->getName() != 'user.myaccount') mt-5 @endif" src="{{ asset('/images/users/avatar.png') }}">
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
<script>

    document.addEventListener("DOMContentLoaded", function() {
        @if(Route::current()->getName() == 'Main' || Route::current()->getName() == 'view.cart' || Route::current()->getName() == 'product')
            countCart()
            getCart()
            getSubtotal()
        @endif
        @if(Route::current()->getName() == 'Main')
            document.querySelector('.products').innerHTML = '<div class="text-center big "><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';
        @endif
        @if(Route::current()->getName() == 'view.cart')
            document.querySelector(".container__cart").innerHTML = '<div class="text-center big "><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';
        @endif
    });

    async function getCart(){
        const cartBody = document.querySelector(".cart__body")
        const cartFooter = document.querySelector(".cart__footer")

        await fetch('{{route("get.cart")}}', {
                method: "GET",
            })
            .then(result => {
                return result.text()
            }).then(data =>{
                cartBody.innerHTML = data
                getSubtotal()
                if(data == '<h5 class="text-center">Your cart is empty</h5>'){
                    cartFooter.style.display = 'none';
                }else{
                    cartFooter.style.display = 'block';
                }
        })
    }

    async function countCart(){
        let countCart = document.querySelector('#cart__count');

        await fetch('{{route("count.cart")}}', {
                method: "GET",
            })
            .then(result => {
                return result.json()
            }).then(data =>{
                countCart.innerHTML = data.count
        })
    }


    async function getSubtotal(){
        const cartSubtotal = document.querySelector("#Subtotal")

        await fetch('{{route("get.cartSubtotal")}}', {
                method: "GET",
            })
            .then(result => {
                return result.text()
            }).then(data =>{
                cartSubtotal.innerHTML = data
        })
    }

    function removeCart(id) {
        let parent = document.querySelector("#parent" + id);

        $.ajax({
            url: '{{ URL("remove-cart") }}/'+id,
            type: "get",
            dataType: "JSON",
            success: function(data){
                if(data.status == 'ok'){
                    Swal.fire({
                        icon: 'success',
                        title: 'cart deleted'
                    })
                    parent.remove()
                    getCart()
                    countCart()
                    @if(Route::current()->getName() == 'view.cart')
                        getRowCart()
                    @endif
                }
            }
        });
    }

</script>
@endsection
