<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Product;
use App\ShippingAddress;
use App\User;
use File;
use Validator;
use Image;
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
        if (Route::current()->getName() == 'user.myaccount' || Route::current()->getName() == 'user.changepassword'|| Route::current()->getName() == 'user.editaddress') {
            return true;
        }
    }

    public function myAccount()
    {
        $checkPage = $this->checkPage();
        return view('Mainpage.myaccount', compact(['checkPage']));
    }

    public function ShowChangePass()
    {
        $checkPage = $this->checkPage();
        return view('Mainpage.showchangepass', compact(['checkPage']));
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
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

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
        $request->validate([
            'sidenavprofile' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

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
        $shippingAddress = DB::table('shipping_addresses')->where('user_id', '=', Auth::id())->get();
        return view('Mainpage.shippingaddress', compact(['checkPage', 'shippingAddress']));
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

        ShippingAddress::create([
            'user_id' => Auth::id(),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'phone_number' => $request->phone_number,
        ]);
        return back()->with('toast_success', 'Address successfully added');
    }
    //delete the address
    public function DeleteAddress($id)
    {
        ShippingAddress::where('shipping_id', $id)->delete();
        return back()->with('toast_success', 'Shipping address successfully deleted');
    }

    // edit address
    public function EditAddress($id)
    {
        $checkPage = $this->checkPage();
        $editshippingaddress = ShippingAddress::where('shipping_id', decrypt($id))->get();
        return view('Mainpage.showeditaddress', compact(['checkPage', 'editshippingaddress']));
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
            'phone_number' => 'required|digits:11',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        DB::table('shipping_addresses')->where('shipping_id', $request->shipping_id)->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('user.shippingaddress')->with('toast_success', 'update address successfully');
    }
}
