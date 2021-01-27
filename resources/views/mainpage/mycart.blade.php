@extends('layouts.app')

@section('title')
My cart
@endsection

@section('mycart')
<link rel="stylesheet" href="{{ asset('css/mainpage/mycart.css') }}">
@endsection

@section('content')
@include('layouts.nav')

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
