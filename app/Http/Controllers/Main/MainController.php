<?php

namespace App\Http\Controllers\Main;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use App\Seller;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Cookie;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class MainController extends Controller
{
    public function setCookie(Request $request)
    {
        if (empty($request->cookie('kwara_cookie'))) {
            $value = Str::random(40);
            $minutes = 60;
            Cookie::queue('kwara_cookie', $value, $minutes);
            return response()->json(['status' => 'ok']);
        } else {
            return response()->json(['status' => 'set']);
        }
    }

    public function DeleteAbandonCart()
    {
        $cookie_id = request()->cookie('kwara_cookie');
        $cart = Cart::get();
        $dateToNumber = strtotime(date("Y-m-d H:i:s"));//date ngayon na naconvert sa number
        if(Auth::guest() && empty($cart[0]->user_id)){
            Cart::where('cartExpiration', '<=', $dateToNumber)->delete();
        }// kapag na meet ni date ngayon ung expiration date,madedelete ang mga cart
    }

    public function checkPage()
    {
        if (Route::current()->getName() == 'user.myaccount' || Route::current()->getName() == 'user.changepassword' || Route::current()->getName() == 'user.shippingaddress' || Route::current()->getName() == 'product') {
            return true;
        }
    }

    public function CheckStatus()
    {
        $seller = Seller::all();

        if ($seller->count() > 0) {
            foreach ($seller as $s) {
                $EXPIRATION_DATE = $s->expiration_date;
                $STATUS = $s->status;

                date_default_timezone_set('Asia/Manila');

                date_default_timezone_set('Asia/Manila');
                // STRING
                $string_dateNow = date('y-m-d');
                $string_hourNow = date('h:i a');

                $stringDate =  $string_dateNow . ' ' . $string_hourNow;

                $DateNow = strtotime($stringDate);

                if ($DateNow >= $EXPIRATION_DATE && $STATUS == "approved") {
                    Seller::where('status', 'approved')
                        ->where('expiration_date', '<=', $DateNow)
                        ->update(['status' => 'resumed']);
                } else {
                    return false;
                }
            }
        }
    }

    public function main()
    {
        $this->CheckStatus();
        $checkPage = $this->checkPage();

        $cookie_id = request()->cookie('kwara_cookie');

        return view('mainpage.mainpage', compact(['checkPage']));
    }

    public function ShowProducts()
    {
        $products = Product::orderBy('created_at', 'desc')->get();

        if ($products->count() > 0) {
            foreach ($products as $prod) {
                $image = explode('|', $prod->product_image);

                echo '<div class="col-lg-2 col-sm-4 col-6 section__three__col">
                    <a href="product/' . $prod->id . '">
                        <div class="card mb-2">
                            <img class="card-img-top" src="' . asset("/storage/images/products/$image[0]") . '" />
                            <div class="card-body">
                                <p class="card-title p-name">' . $prod->product_name . '</p>
                                <p class="card-text">&#8369; ' . number_format($prod->product_price) . '</p>
                            </div>
                        </div>
                    </a>
                </div>';
            }
        } else {
            echo '<div class="section__three__title text-center">
                    <h5>There is no product yet</h5>
                </div>';
        }
    }

    public function ViewProduct($id)
    {
        $checkPage = $this->checkPage();
        $this->CheckStatus();
        $pro = Product::where('id', $id)->firstOrFail();

        if (!empty($pro->product_size) && !empty($pro->product_color)) {
            $data =
                Product::join('sellers', 'products.seller_id', 'sellers.id')->where('products.id', $id)->get(array(
                    'products.id as pro_id',
                    'sellers.id as sel_id',
                    'product_name',
                    'product_type',
                    'product_price',
                    'product_stock',
                    'product_discount',
                    'product_description',
                    'product_image',
                    'product_size',
                    'product_color',
                    'status',
                    'store_name',
                ))->first();
        } else {
            $data = Product::join('sellers', 'products.seller_id', 'sellers.id')->where('products.id', $id)->get(array(
                'products.id as pro_id',
                'sellers.id as sel_id',
                'product_name',
                'product_type',
                'product_price',
                'product_stock',
                'product_discount',
                'product_description',
                'product_image',
                'status',
                'store_name'
            ))->first();
        }
        // dd($data);

        // product related
        $relatedProduct = Product::orderBy('id', 'desc')->where('product_type', $pro->product_type)->where('id', '!=', $id)->get();
        $cookie_id = request()->cookie('kwara_cookie');
        $carts = Cart::where('user_id', Auth::id())->where('product_cookie_id', $cookie_id)->get();

        return view('mainpage.product', compact(['checkPage', 'data', 'pro', 'relatedProduct', 'carts']));
    }

    public function addToCart(Request $request)
    {
        $product_id = $request->id;
        $product = Product::where('id', $product_id)->first();
        $dateNow = date("Y-m-d H:i:s");

        $cookie_id = request()->cookie('kwara_cookie');

        if (Auth::check()) {
            $userId = Auth::user()->id;
        } else {
            $userId = NULL;
        }

        $image = explode("|", $product->product_image);

        if (Cart::where('product_cookie_id', $cookie_id)->where('product_id', $product_id)->exists()) {
            Cart::where('product_id', $product_id)->where('product_cookie_id', $cookie_id)->increment('product_quantity', $request->product_quantity);
            return response()->json(['status' => 'duplicate']);
        } else {
            $cartInsert = Cart::create([
                'user_id' => $userId,
                'product_cookie_id' => $cookie_id,
                'product_id' => $product_id,
                'product_name' => $product->product_name,
                'product_type' => $product->product_type,
                'product_price' => $product->product_price,
                'product_stock' => $product->product_stock,
                'product_discount' => $product->product_discount,
                'product_description' => $product->product_description,
                'product_image' => $image[0],
                'product_quantity' => $request->product_quantity,
                'product_size' => $request->product_size,
                'product_color' => $request->product_color,
                'cartExpiration' => strtotime(date('Y-m-d H:i:s', strtotime('+60 minutes', strtotime($dateNow))))
            ]);
            if ($cartInsert) {
                return response()->json(['status' => 'ok']);
            }
        }
    }

    public function CountCart()
    {
        $cookie_id = request()->cookie('kwara_cookie');
        if (Auth::check()) {
            $countCarts = Cart::where('user_id', Auth::id())->orwhere('product_cookie_id', $cookie_id)->count();
        } else {
            $countCarts = Cart::where('product_cookie_id', $cookie_id)->count();
        }

        return response()->json(['count' => $countCarts]);
    }

    public function getToCart()
    {
        $cookie_id = request()->cookie('kwara_cookie');

        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::id())->orwhere('product_cookie_id', $cookie_id)->get();
        } else {
            $carts = Cart::where('product_cookie_id', $cookie_id)->get();
        }

        if ($carts->count() > 0) {
            foreach ($carts as $cart) {

                echo '<div class="box__cart d-flex mb-2" width="70px" id="parent' . $cart->id . '">
                    <img src="' . asset("/storage/images/products/$cart->product_image") . '" alt="' . $cart->product_name . '" class="img-fluid mb-3" style="height: 70px; width:70px; object-fit:cover;">
                    <div class="box__cart__body ml-4 d-flex flex-column">
                        <h6 class="text-capitalize font-weight-bold">' . $cart->product_name . '</h6>
                        <small>' . number_format($cart->product_price) . '</small>
                        <small>x ' . $cart->product_quantity . '</small>
                    </div>
                    <div class="remove__cart" id="' . $cart->id . '" onclick="removeCart(this.id)">
                        &#215;
                    </div>
                </div>';
            }
        } else {
            echo '<h5 class="text-center">Your cart is empty</h5>';
        }
    }

    public function getCartSubtotal()
    {
        $cookie_id = request()->cookie('kwara_cookie');

        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::id())->orwhere('product_cookie_id', $cookie_id)->get();
        } else {
            $carts = Cart::where('product_cookie_id', $cookie_id)->get();
        }

        $total = 0;
        foreach ($carts as $cart) {
            $total = $total + ($cart->product_quantity * $cart->product_price);
        }
        echo number_format($total, 2);
    }

    public function RemoveCart($id)
    {
        $delete = Cart::where('id', $id)->delete();
        if ($delete) {
            return response()->json(['status' => 'ok']);
        }
    }

    public function ViewCart()
    {
        $cookie_id = request()->cookie('kwara_cookie');

        if (Auth::check()) {
            $mycart = Cart::where('user_id', Auth::id())->orwhere('product_cookie_id', $cookie_id)->get();
        } else {
            $mycart = Cart::where('product_cookie_id', $cookie_id)->get();
        }
        return view('mainpage.mycart', compact('mycart'));
    }

    public function GetRowCart()
    {
        $cookie_id = request()->cookie('kwara_cookie');

        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::id())->orwhere('product_cookie_id', $cookie_id)->get();
        } else {
            $carts = Cart::where('product_cookie_id', $cookie_id)->get();
        }

        if ($carts->count() > 0) {
            echo '<table >
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                <tbody>';
            $total = 0;
            foreach ($carts as $cart) {
                $total = $total + ($cart->product_quantity * $cart->product_price);

                echo '<tr id="cart__row__' . $cart->id . '" class="animated ">
                    <td>
                        <div class="cart__info">
                            <img src="' . asset("/storage/images/products/$cart->product_image") . '" alt="' . $cart->product_name . '">
                            <div>
                                <p>' . $cart->product_name  . '</p>
                                <small>&#8369; ' . number_format($cart->product_price, 2) . '</small>
                                <br>
                                <a onclick="removeCartRow(this.id)" id="' . $cart->id . '">Remove</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-grow-1 align-items-center">
                            <div class="d-flex" style="border: 1px solid #e6e6e6; border-radius: 15px; padding: 1px 10px;">
                            <button style="border-radius: 15px 0 0 15px; background-color: white; border: none;" type="button" class="btn-number" data-type="minus" data-field="productquantity[0]">
                            &#8722;
                            </button>
                            <input type="text" name="productquantity[0]" style="width: 35px;border-color: #b7242400;" class="disabled text-center input__quantity" placeholder="1" value="' . $cart->product_quantity . '" min="1" max="10" onchange="updateQuantity(0, this)">
                            <button style="border-radius: 0px 15px 15px 0px; background-color: white; border: none;" type="button" class="btn-number" data-type="plus" data-field="productquantity[0]">
                            &#43;
                            </button>
                            </div>
                        </div>
                    </td>
                    <td>&#8369; ' . number_format($cart->product_price * $cart->product_quantity, 2) . '</td>
                </tr>';
            }
            echo '</tbody>
                    </table>
                    <div class="total-table">
                    <table>
                        <tr>
                            <td>Total</td>
                            <td>&#8369; ' . number_format($total, 2) . '</td>
                        </tr>
                    </table>
                </div>';
        } else {
            echo '<div class="d-flex justify-content-center align-items-center">
                    <div class="text-center">
                        <h5 class="text-center">Your cart is empty</h5>
                        <img src="' . asset("images/users/emptycart.png") . '" class="img-fluid my-4">
                        <br>
                        <a href="' . route('Main') . '"class="btn btn-sm Continue-shopping">Continue shopping</a>
                    </div>
                </div>';
        }
    }

    public function DeleteCartRow($id)
    {
        $delete = Cart::where('id', $id)->delete();
        if ($delete) {
            return response()->json(['status' => 'ok']);
        }
    }
}
