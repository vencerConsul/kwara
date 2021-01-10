<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Seller;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_user = User::all();
        $total_seller = Seller::all();
        $user = User::orderBy('created_at', 'desc')->paginate(8);
        $seller = Seller::orderBy('created_at', 'desc')->paginate(8);

        return view('admin.home', compact(['total_user', 'user', 'total_seller', 'seller']));
    }

    // show tables for users
    public function ShowTablesForUsers()
    {
        $total_user = User::all();
        $user = User::orderBy('created_at', 'desc')->get();
        return view('admin.pages.showalltablesforUsers', compact(['total_user', 'user']));
    }

    // show tables for sellers
    public function ShowTablesForSellers()
    {
        $total_sellers = Seller::all();
        $sellers = Seller::orderBy('created_at', 'desc')->get();
        return view('admin.pages.showalltablesforSellers', compact(['total_sellers', 'sellers']));
    }

    // approved seller registration
    public function ApprovedSellerRegistration($id)
    {
        date_default_timezone_set('Asia/Manila');
        // STRING
        $string_dateNow = date('y-m-d');
        $string_hourNow = date('h:i a');

        // $DateNow =  $integer_dateNow + $integer_hourNow;
        $date = strtotime($string_dateNow);
        $dateToday = date("y-m-d", strtotime("+1 month", $date)) .' '. $string_hourNow;

        $seller = Seller::findOrFail($id);
        Seller::whereId($id)->update(['status' => 'approved', 'expiration_date' => strtotime($dateToday)]);

        return back()->with('toast_success', ''.$seller->firstname.' has been approved');
    }

    // not approved seller registration
    public function NotApprovedSellerRegistration($id)
    {
        $seller = Seller::findOrFail($id);
        Seller::whereId($id)->update(['status' => 'not-approve']);

        return back()->with('toast_success', '' . $seller->firstname . ' has changed to not-approve');
    }

    // resumed seller registration
    public function ResumedSellerRegistration($id)
    {
        date_default_timezone_set('Asia/Manila');
        // STRING
        $string_dateNow = date('y-m-d');
        $string_hourNow = date('h:i a');

        // $DateNow =  $integer_dateNow + $integer_hourNow;
        $date = strtotime($string_dateNow);
        $dateToday = date("y-m-d", strtotime("+1 month", $date)) . ' ' . $string_hourNow;

        $seller = Seller::findOrFail($id);
        Seller::whereId($id)->update(['status' => 'approved', 'expiration_date' => strtotime($dateToday)]);

        return back()->with('toast_success', '' . $seller->firstname . ' status has changed to resumed');
    }
}
