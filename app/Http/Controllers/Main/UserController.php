<?php

namespace App\Http\Controllers\Main;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderProduct;
use App\Product;
use App\ShippingAddress;
use App\User;
use File;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function checkPage()
    {
        if (Route::current()->getName() == 'user.myaccount' || Route::current()->getName() == 'user.changepassword' || Route::current()->getName() == 'user.editaddress') {
            return true;
        }
    }

    public function myAccount()
    {
        $checkPage = $this->checkPage();
        return view('mainpage.myaccount', compact(['checkPage']));
    }

    // get all the user order
    public function myOrder()
    {
        $orderProduct = OrderProduct::orderBy('order_products.created_at', 'desc')->join('orders', 'order_products.order_id', 'orders.id')->where('orders.user_id', Auth::id())->where('order_products.status', '!=', 'delivered')->get();
        return view('mainpage.myorder', compact(['orderProduct']));
    }

    public function OrderedHistory()
    {
        $orderProduct = OrderProduct::orderBy('order_products.created_at', 'desc')->join('orders', 'order_products.order_id', 'orders.id')->where('orders.user_id', Auth::id())->where('order_products.status', 'delivered')->get();
        return view('mainpage.orderhistory', compact(['orderProduct']));
    }

    public function ShowChangePass()
    {
        $checkPage = $this->checkPage();
        return view('mainpage.showchangepass', compact(['checkPage']));
    }

    public function UpdateInformation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $data = ['firstname' => $request->firstname, 'lastname' => $request->lastname];

        if ($request->firstname == Auth::user()->firstname && $request->lastname == Auth::user()->lastname) {
            return redirect()->back()->with('toast_info', 'no changes happen');
        } else {
            User::where('id', Auth::user()->id)
                ->update($data);
            return redirect()->back()->with('toast_success', 'Your information was updated successfully');
        }
    }

    public function ChangeProfilePicture(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $imageName = uniqid() . '.' . $request->file->extension();

        $updateProfile = User::where('id', Auth::user()->id)->update(['profile' => $imageName]);
        if ($updateProfile) {

            $image_path = "profile_images/" . Auth::user()->profile . "";
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $request->file->move(public_path('profile_images'), $imageName);
            return back()->with('toast_success', 'Your profile changed successfully');
        }
    }

    // sidebar profile picture to change
    public function ChangeSidebarProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sidenavprofile' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $imageName = uniqid() . '.' . $request->sidenavprofile->extension();

        $updateProfile = User::where('id', Auth::user()->id)->update(['profile' => $imageName]);
        if ($updateProfile) {

            $image_path = "profile_images/" . Auth::user()->profile . "";
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $request->sidenavprofile->move(public_path('profile_images'), $imageName);
            return back()->with('toast_success', 'Your profile changed successfully');
        }
    }

    public function ChangePassword(Request $request)
    {
        if (!(Hash::check($request->get('oldpassword'), Auth::user()->password))) {
            // The passwords matches
            return back()->with("toast_error", "incorrect password");
        }

        if (strcmp($request->get('oldpassword'), $request->get('newpassword')) == 0) {
            //Current password and new password are same
            return back()->with("toast_error", "password cannot be the same to old password");
        }

        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'newpassword' => 'required|string|min:8|same:newpassword',
            'confirmpassword' => 'required|same:newpassword',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->get('newpassword'));
        $user->save();

        return back()->with("toast_success", "Password changed successfully !");
    }

    public function ShowShippingAddress()
    {
        $checkPage = $this->checkPage();
        $shippingAddress = ShippingAddress::where('user_id', '=', Auth::id())->get();
        return view('mainpage.shippingaddress', compact(['checkPage', 'shippingAddress']));
    }

    public function AddAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'country' => 'required',
            'postal_code' => 'required|digits:4',
            'phone_number' => 'required|digits:11',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        Auth::user()->ShippingAddress()->create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'phone_number' => $request->phone_number
        ]);


        return back()->with('toast_success', 'Address successfully added');
    }
    //delete the address
    public function DeleteAddress($id)
    {
        ShippingAddress::where('id', $id)->delete();
        return back()->with('toast_success', 'Shipping address successfully deleted');
    }

    // edit address
    public function EditAddress($id)
    {
        $checkPage = $this->checkPage();
        $editshippingaddress = ShippingAddress::where('id', $id)->firstOrFail();
        return view('mainpage.showeditaddress', compact(['checkPage', 'editshippingaddress']));
    }

    // update shipping Address
    public function UpdateAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'country' => 'required',
            'postal_code' => 'required|digits:4',
            'phone_number' => 'required|digits:11'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        ShippingAddress::where('id', $request->shipping_id)->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'phone_number' => $request->phone_number
        ]);

        return redirect()->route('user.shippingaddress')->with('toast_success', 'update address successfully');
    }

    // checkout product cart
    public function CheckOut()
    {
        $cookie_id = request()->cookie('kwara_cookie');

        if (Auth::check()) {
            $orders = Cart::where('user_id', Auth::id())->orwhere('product_cookie_id', $cookie_id)->get();
        } else {
            $orders = Cart::where('product_cookie_id', $cookie_id)->get();
        }

        if ($orders->count() == 0) {
            return redirect(route('Main'));
        } else {
            $shippingAddress = ShippingAddress::where('user_id', Auth::id())->get();
            return view('mainpage.checkout', compact(['orders', 'shippingAddress']));
        }
    }

    public function UseAddress()
    {
        $data = ShippingAddress::where('user_id', Auth::id())->first();

        $address = [
            'firstname' => $data->firstname,
            'lastname' => $data->lastname,
            'address' => $data->address,
            'country' => $data->country,
            'postal_code' => $data->postal_code,
            'phone_number' => $data->phone_number,
            'status' => 'ok'
        ];

        return response()->json($address);
    }

    public function ProceedToCheckout(Request $request)
    {
        $cookie_id = request()->cookie('kwara_cookie');

        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'country' => 'required',
            'postal' => 'required|digits:4',
            'phone' => 'required|digits:11'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        if (Auth::check()) {
            $orders = Cart::where('user_id', Auth::id())->orwhere('product_cookie_id', $cookie_id)->get();
        } else {
            $orders = Cart::where('product_cookie_id', $cookie_id)->get();
        }
        if ($orders->count() == 0) {
            return redirect(route('Main'));
        } else {
            $shippingAddress = [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'address' => $request->address,
                'country' => $request->country,
                'postal' => $request->postal,
                'phone' => $request->phone
            ];
            return view('mainpage.checkoutProduct', compact(['orders', 'shippingAddress']));
        }
    }

    public function PlaceOrder(Request $request)
    {
        $cookie_id = request()->cookie('kwara_cookie');

        $cart = Cart::where('user_id', Auth::id())->orwhere('product_cookie_id', $cookie_id)->get();

        if ($cart->count() == 0) {
            return redirect(route('Main'));
        } else {
            $validator = Validator::make($request->all(), [
                'payment_method' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }

            if ($request->payment_method == 'Cash On Delivery') {
                $validator = Validator::make($request->all(), [
                    'buyer_photo' => 'required|mimes:jpeg,png,jpg|max:2048',
                    'identity' => 'required|mimes:jpeg,png,jpg|max:2048',
                ]);
                if ($validator->fails()) {
                    return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
                }
            }

            date_default_timezone_set('Asia/Manila');
            $string_dateNow = date('y-m-d');
            $string_hourNow = date('h:i a');
            // TO INTEGER
            $integer_dateNow = strtotime($string_dateNow);
            $integer_hourNow = strtotime($string_hourNow);
            $DateNow =  $integer_dateNow + $integer_hourNow;

            // check if there is a buyer photos and valid ID
            if ($request->buyer_photo && $request->identity) {
                $b_photo = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 7) . $DateNow .
                    $request->buyer_photo->getClientOriginalName();

                $b_id = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 7) . $DateNow . $request->identity->getClientOriginalName();

                $request->buyer_photo->storeAs('public/images/buyer_photo/', $b_photo);
                $request->identity->storeAs('public/images/buyer_identity/', $b_id);
            }else{
                $b_photo = NULL;
                $b_id = NULL;
            }

            $new = new Order();
            $new->user_id = Auth::user()->id;
            $new->firstname = $request->firstname;
            $new->lastname = $request->lastname;
            $new->address = $request->address;
            $new->country = $request->country;
            $new->postal_code = $request->postal;
            $new->phone_number = $request->phone;
            $new->payment_method = $request->payment_method;
            $new->buyer_photo = $b_photo;
            $new->buyer_identity = $b_id;
            $new->save();

            $order_id = $new->id;

            foreach ($cart as $data) {
                $totalPrice = $data->product_price * $data->product_quantity;

                if (!empty($data->product_price) && !empty($data->product_size)) {
                    $size = $data->product_price;
                    $color = $data->product_color;
                } else {
                    $size = NULL;
                    $color = NULL;
                }
                $OrderPro = new OrderProduct;
                $OrderPro->order_id = $order_id;
                $OrderPro->order_number = 'K-' . strtoupper($DateNow . Str::random(10));
                $OrderPro->product_id = $data->product_id;
                $OrderPro->seller_id = $data->seller_id;
                $OrderPro->product_name = $data->product_name;
                $OrderPro->product_price = $data->product_price;
                $OrderPro->product_image = $data->product_image;
                $OrderPro->product_quantity = $data->product_quantity;
                $OrderPro->product_size = $size;
                $OrderPro->product_color = $color;
                $OrderPro->total_price = $totalPrice;
                $OrderPro->save();
            }

            return redirect(route('user.order'));
        }
    }
}
