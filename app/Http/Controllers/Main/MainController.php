<?php

namespace App\Http\Controllers\Main;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Http\Traits\ProductTrait;
use App\Product;
use App\Seller;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class MainController extends Controller
{
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

                // dd($EXPIRATION_DATE);

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
        $gadgets = Product::orderBy('id', 'DESC')->where('product_type', 'Gadgets')->paginate(12);
        return view('mainpage.mainpage', compact(['checkPage', 'gadgets']));
    }

    public function ShowProducts()
    {
        $products = Product::all();

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
        $pro = Product::whereId($id)->with('productAttributes')->firstOrFail();

        if ($pro->productAttributes->count() > 0) {
            $product = Seller::with(['product' => function ($q) use ($id) {
                $q->where('id', $id)
                    ->with('productAttributes');
            }])
                ->firstOrFail();
        } else {
            $product = Seller::with(['product' => function ($q) use ($id) {
                $q->where('id', $id);
            }])->firstOrFail();
        }
        // product related
        $relatedProduct = Product::orderBy('id', 'desc')->where('product_type', $product->product[0]->product_type)->where('id', '!=', $id)->get();
        // dd('storage/images/products/'. $product->product_image);
        return view('mainpage.product', compact(['checkPage', 'product', 'pro', 'relatedProduct']));
    }

    public function addToCart(Request $request)
    {
        $product_id = $request->id;
        $product = Product::findOrFail($product_id);
        $sessionId = session()->getId();

        if (Auth::check()) {
            $userId = Auth::id();
        } else {
            $userId = NULL;
        }

        $image = explode("|", $product->product_image);

        if (Cart::where('product_id', $product_id)->exists()) {
            Cart::where('product_id', $product_id)->where('product_session_id', $sessionId)->increment('product_quantity', $request->product_quantity);
            Cart::where('product_id', $product_id)->where('product_session_id', $sessionId)->increment('product_price', $product->product_price);
            return response()->json(['status' => 'ok']);
        } else {
            $request->session()->put('product_session_id', $sessionId);
            $cartInsert = Cart::create([
                'user_id' => $userId,
                'product_session_id' => $sessionId,
                'product_id' => $product->id,
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
}
