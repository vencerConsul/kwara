<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAttributes;
use App\Seller;
use App\Appointments;
use Auth;
use Cookie;
use DateTime;
use File;
use Image;
use DateTimeZone;
use Validator;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:seller');
    }

    public function CheckStatus()
    {
        $seller = Seller::where('id', Auth::id())->get();
        $EXPIRATION_DATE = $seller[0]->expiration_date; // seller exp date
        $STATUS = $seller[0]->status; // seller status
        date_default_timezone_set('Asia/Manila');
        // date and time now
        $string_dateNow = date('y-m-d');
        $string_hourNow = date('h:i a');
        $stringDate =  $string_dateNow .' '. $string_hourNow;
        $DateNow = strtotime($stringDate);
        if ($DateNow >= $EXPIRATION_DATE && $STATUS == "not-approve" || $DateNow >= $EXPIRATION_DATE && $STATUS == "pending") {
            Seller::where('id', Auth::id())->delete();
        }
        // dd($EXPIRATION_DATE);
        if ($DateNow >= $EXPIRATION_DATE && $STATUS == "approved") {
            Seller::where('id', Auth::id())->update(['status' => 'resumed']);
        }
    }
    public function showSellerDashboard(Request $request)
    {
        $this->CheckStatus();
        $seller = Seller::where('id', Auth::id())->get();
        $STATUS = $seller[0]->status;
        if ($STATUS == "pending") {
            $pendingAppointment = Appointments::where('seller_id', Auth::id())->firstOrFail();
            return view('Seller.sellerdashboard', compact(['STATUS', 'pendingAppointment']));
        } elseif ($STATUS == "not-approve") {
            return view('Seller.sellerdashboard', compact(['STATUS']));
        }
        // dd($pendingAppointment->schedule_date);
        $sellerProducts = Product::orderBy('p_id', 'DESC')->where('seller_id', Auth::id())->with('productAttributes')->get();
        return view('Seller.sellerdashboard', compact(['STATUS', 'sellerProducts']));
    }
    // make appointments
    public function MakeAppointment(Request $request)
    {
        // validate all input
        $validator = Validator::make($request->all(), [
            'schedule_date' => 'required',
            'schedule_time' => 'required',
            'schedule_message' => 'required',
            'schedule_place' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $appointment = new appointments();
        $appointment->seller_id = Auth::id();
        $appointment->schedule_date = $request->schedule_date;
        $appointment->schedule_time = $request->schedule_time;
        $appointment->schedule_message = $request->schedule_message;
        $appointment->schedule_place = $request->schedule_place;
        $appointment->save();
        Seller::where('id', Auth::id())->update([
            'status' => 'pending',
        ]);
        return redirect()->route('seller.dashboard')->with('toast_success', 'Okay great');
    }
    // show seller add product view
    public function showAddProduct()
    {
        $this->CheckStatus();
        if (Auth::user()->status == "approved") {
            return view('Seller.showaddproduct');
        } elseif (Auth::user()->status == "resumed") {
            return view('Seller.resumed');
        }
        return abort(404);
    }
    // add product
    public function AddProduct(Request $request)
    {
        if (Auth::user()->status == "approved") {
            $product_image = array();
            if ($files = $request->file('files')) {
                $allowedfileExtension = ['jpg', 'png', 'jpeg'];
                foreach ($files as $file) {
                    $name = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension); // check if the array has a jpg png jpeg
                    if ($check) {
                        date_default_timezone_set('Asia/Manila');
                        $string_dateNow = date('y-m-d');
                        $string_hourNow = date('h:i a');
                        // TO INTEGER
                        $integer_dateNow = strtotime($string_dateNow);
                        $integer_hourNow = strtotime($string_hourNow);
                        $DateNow =  $integer_dateNow + $integer_hourNow;
                        $random = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 7) . $DateNow . $name;

                        $file->storeAs('public/images/products/', $random);
                        // Image::make($file->getRealPath())->save('OriginalProductImg' . '/' . $random);
                        $product_image[] = $random;
                    } else {
                        return back()->with('toast_error', 'Image must be jpg or png ');
                    }
                }
            }
            // validate all input
            $validator = Validator::make($request->all(), [
                'product__name' => 'required',
                'product__price' => 'required',
                'product__stock' => 'required',
                'product__description' => 'required',
                'product__type' => 'required',
                'files' => 'required'
            ]);
            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
            if (empty($request->product__discount)) {
                $discount = 100;
            } else {
                $discount = $request->product__discount;
            }

            $product = new Product;
            $product->seller_id = Auth::id();
            $product->product_name = $request->product__name;
            $product->product_type = $request->product__type;
            $product->product_price = $request->product__price;
            $product->product_stock = $request->product__stock;
            $product->product_discount = $discount;
            $product->product_description = $request->product__description;
            $product->product_image = implode('|', $product_image);
            $product->save();
            // dd($product);

            if ($request->product__type == 'Clothes' || $request->product__type == 'Foot wears') {
                $P_Attributes = new ProductAttributes;
                $P_Attributes->product_id  = $product->id;
                $P_Attributes->product_size  = implode('|', $request->product__size);
                $P_Attributes->product_color  = implode('|', $request->product__color);
                $P_Attributes->save();
            }
            return redirect(route('seller.dashboard'))->with('toast_success', 'You have added a product');
        }
        return abort(404);
    }

    // count product
    public function CountProduct()
    {
        if (Auth::user()->status == "approved") {
            $sellerCountProduct = Product::where('seller_id', Auth::id())->count();
            return response()->json(['count' => $sellerCountProduct], 200);
        }
        return abort(404);
    }

    // delete seller product
    public function DeleteProduct($id)
    {
        if (Auth::user()->status == "approved") {
            $seller = Seller::findOrFail(Auth::id());
            $seller->product()->where('p_id', $id)->delete();
            return response()->json(['status' => "ok"], 200);
        }
        return abort(404);
    }

    //edit product
    public function EditProduct($id)
    {
        if (Auth::user()->status == "approved") {
            $products = Product::where('p_id', decrypt($id))->firstOrFail();
            return view('Seller.showEditProduct', compact(['products']));
        }
        return abort(404);
    }
    // update products
    public function UpdateProduct($id)
    {
        if (Auth::user()->status == "approved") {
            $data = Validator::make(request()->all(), [
                'product__name' => 'required',
                'product__price' => 'required',
                'product__stock' => 'required',
                'product__description' => 'required',
                'product__type' => 'required',
            ]);
            if ($data->fails()) {
                return back()->with('toast_error', $data->messages()->all()[0])->withInput();
            }
            $product_image = array();
            if ($files = request()->file('files')) {
                $allowedfileExtension = ['jpg', 'png', 'jpeg'];
                foreach ($files as $file) {
                    $name = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension); // check if the array has a jpg png jpeg
                    if ($check) {
                        date_default_timezone_set('Asia/Manila');
                        $string_dateNow = date('y-m-d');
                        $string_hourNow = date('h:i a');
                        // TO INTEGER
                        $integer_dateNow = strtotime($string_dateNow);
                        $integer_hourNow = strtotime($string_hourNow);

                        $DateNow =  $integer_dateNow + $integer_hourNow;

                        $random = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 7) . $DateNow . $name;
                        $file->storeAs('public/images/products/', $random);
                        $product_image[] = $random;
                    } else {
                        return back()->with('toast_error', 'Image must be jpg or png ');
                    }
                }
            }
            // update product
            if (empty($request->product__discount)) {
                $discount = 100;
            } else {
                $discount = $request->product__discount;
            }
            // print_r(implode('|', request()->old__files));
            if (request()->old__files && empty(request()->file('files'))) {
                $p_image = implode('|', request()->old__files);
            }
            if ($product_image && request()->old__files) {
                $p_image = implode('|', $product_image) . '|' . implode('|', request()->old__files);
            }
            if(request()->file('files') && empty(request()->old__files)){
                $p_image = implode('|', $product_image);
            }

            // compute the number of files added
            if(empty(request()->old__files) && empty(request()->file('files'))){
                return back()->with('toast_error', 'please upload atleast 1 image');
            }elseif(empty(request()->old__files)){
                $countFiles = 0;
            }elseif(empty(request()->file('files'))){
                $countFiles = 0;
            }else{
                $countFiles = count(request()->old__files) + count(request()->file('files'));
            }
            //check if the file is greather than 6, then invalid
            if ($countFiles > 4) {
                return back()->with('toast_error', 'You can only upload 4 images');
            }
            Product::where('p_id', $id)->update([
                'product_name' => request()->product__name,
                'product_type' => request()->product__type,
                'product_price' => request()->product__price,
                'product_stock' => request()->product__stock,
                'product_discount' => $discount,
                'product_description' => request()->product__description,
                'product_image' => $p_image
            ]);
            if (request()->product__type == 'Clothes' || request()->product__type == 'Foot wears') {
                ProductAttributes::where('product_id', $id)->update([
                    'product_size' => implode('|', request()->product__size),
                    'product_color' => implode('|', request()->product__color)
                ]);
            }
            return redirect()->route('seller.dashboard')->with('toast_success', 'Product updated');
        }
        return abort(404);
    }
}
