<?php

namespace App\Http\Controllers\Main;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use App\Seller;
use App\ProductAttributes;
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
        $gadgets = Product::orderBy('p_id', 'DESC')->where('product_type', 'Gadgets')->paginate(12);

        $cookie_id = request()->cookie('kwara_cookie');

        $carts = Cart::where('user_id', Auth::id())->orWhere('product_cookie_id', $cookie_id)->get();

        return view('mainpage.mainpage', compact(['checkPage', 'gadgets', 'carts']));
    }

    public function ShowProducts()
    {
        $products = Product::all();

        if ($products->count() > 0) {
            foreach ($products as $prod) {


                $image = explode('|', $prod->product_image);

                echo '<div class="col-lg-2 col-sm-4 col-6 section__three__col">
                    <a href="product/' . $prod->p_id . '">
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
        $pro = Product::where('p_id', $id)->with('productAttributes')->firstOrFail();

        if ($pro->productAttributes->count() > 0) {
            $data =
                Product::join('product_attributes', 'products.p_id', 'product_attributes.product_id')->join('sellers', 'products.seller_id', 'sellers.id')->where('products.p_id', $id)->firstOrFail();
        } else {
            $data = Product::join('sellers', 'products.seller_id', 'sellers.id')->where('products.p_id', $id)->firstOrFail();
        }

        // product related
        $relatedProduct = Product::orderBy('p_id', 'desc')->where('product_type', $pro->product_type)->where('p_id', '!=', $id)->get();
        $cookie_id = request()->cookie('kwara_cookie');
        $carts = Cart::where('user_id', Auth::id())->orWhere('product_cookie_id', $cookie_id)->get();

        return view('mainpage.product', compact(['checkPage', 'data', 'pro', 'relatedProduct', 'carts']));
    }

    public function addToCart(Request $request)
    {
        $product_id = $request->id;
        $product = Product::where('p_id', $product_id)->firstOrFail();

        $cookie_id = request()->cookie('kwara_cookie');

        if (Auth::check()) {
            $userId = Auth::user()->id;
        } else {
            $userId = NULL;
        }

        $image = explode("|", $product->product_image);

        if (Cart::where('product_cookie_id', $cookie_id)->where('product_id', $product_id)->exists()) {
            Cart::where('product_id', $product_id)->where('product_cookie_id', $cookie_id)->increment('product_quantity', $request->product_quantity);

            Cart::where('product_id', $product_id)->where('product_cookie_id', $cookie_id)->increment('product_price', $product->product_price);
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
                'product_color' => $request->product_color
            ]);
            if ($cartInsert) {
                return response()->json(['status' => 'ok']);
            }
        }
    }

    public function getToCart()
    {
        $cookie_id = request()->cookie('kwara_cookie');

        $carts = Cart::where('user_id', Auth::id())->orWhere('product_cookie_id', $cookie_id)->get();

        foreach ($carts as $cart) {

            echo '<li class="clearfix">
                <img src="' . asset("/storage/images/products/$cart->product_image") . '" alt="' . $cart->product_name . '" />
                <span class="item-name">' . $cart->product_name . '</span>
                <span class="item-price">' . $cart->product_price . '</span>
                <span class="item-quantity">x' . $cart->product_quantity . ' </span>
                <input type="hidden" value="' . $cart->product_price * $cart->product_quantity . '" id="subtotal">
            </li>';
        }
    }

    public function getCartSubtotal()
    {
        $cookie_id = request()->cookie('kwara_cookie');

        $carts = Cart::where('user_id', Auth::id())->orWhere('product_cookie_id', $cookie_id)->get();

        $total = 0;
        foreach ($carts as $cart) {
            $total = $total + ($cart->product_quantity * $cart->product_price);
        }
        echo number_format($total, 2);
    }
}
