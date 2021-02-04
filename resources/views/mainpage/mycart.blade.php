@extends('layouts.app')

@section('title')
My cart
@endsection

@section('mycart')
<link rel="stylesheet" href="{{ asset('css/mainpage/mycart.css') }}">
@endsection

@section('content')
@include('layouts.nav')
    <div class="container my-4 indicator">
        <div class="progress-indicator">
            <ul class="progress-box">
                <li class="active"><i class="fab fa-opencart"></i><p>Cart</p></li>
                <li><i class="fas fa-address-card"></i><p>Billing Address</p></li>
                <li><i class="far fa-credit-card"></i><p>Payment</p></li>
            </ul>
        </div>
    </div>
    
    <div class="container container__cart my-4">
        {{-- cart table --}}

    </div>

    @include('layouts.footer')

@endsection
@section('product')
    <script type="text/javascript">

        document.addEventListener("DOMContentLoaded", function() {
            countCart()
            getRowCart()
            getCart()
            getSubtotal()
        });

        async function getRowCart(){
            let containerCart = document.querySelector(".container__cart")

            await fetch("get-row-cart", {
                    method: "GET",
                })
                .then(result => {
                    return result.text()
                }).then(data =>{
                    containerCart.innerHTML = data
            })
        }

        async function removeCartRow(id){
            let cartRow = document.querySelector("#cart__row__" + id)

            await fetch("delete-cart-row" + '/' + id, {
                    method: "GET",
                })
                .then(result => {
                    return result.json()
                }).then(res =>{
                    if(res.status == 'ok'){
                        cartRow.classList.add('fadeOutLeft')
                        setInterval(function(){cartRow.remove()},1000)
                        countCart()
                        getRowCart()
                        getCart()
                    }
            })
        }
    </script>
@endsection
