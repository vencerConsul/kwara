<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Product;
use App\Seller;
use App\User;
use Illuminate\Http\Request;
use Auth;
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

                // dd($DateNow);

                if ($DateNow >= $EXPIRATION_DATE && $STATUS == "approved") {
                    // return true;
                    Seller::where('status', 'approved')
                        ->where('expiration_date', '>=', $DateNow)
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
        $products = Product::orderBy('id', 'DESC')->paginate(12);
        $gadgets = Product::orderBy('id', 'DESC')->where('product_type', 'Gadgets')->paginate(12);
        return view('mainpage.mainpage', compact(['checkPage', 'products', 'gadgets']));
    }

    public function ViewProduct($id)
    {
        $checkPage = $this->checkPage();
        $this->CheckStatus();
        $pro = Product::whereId($id)->with('productAttributes')->firstOrFail();

        if ($pro->productAttributes->count() > 0) {
            $product = DB::table('products')
                ->join('sellers', 'sellers.id',  'products.seller_id')
                ->join('product_attributes', 'product_attributes.product_id',  'products.id')
                ->where('products.id', $id)->first();
        } else {
            $product = DB::table('products')
                ->join('sellers', 'sellers.id',  'products.seller_id')
                ->where('products.id', $id)->first();
        }
        // dd($product);
        // product related
        $relatedProduct = Product::where('product_type', $product->product_type)->get();

        return view('mainpage.product', compact(['checkPage', 'product', 'pro', 'relatedProduct']));
    }
}
