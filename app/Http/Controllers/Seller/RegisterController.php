<?php

namespace App\Http\Controllers\Seller;

use App\Appointment;
use App\Http\Controllers\Controller;
use App\Seller;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    public function showSellerRegister()
    {
        return view('Seller.showsellerregister');
    }

    // validate a seller information
    public function registerSeller(Request $request)
    {

        $validate_fields = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'store_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:sellers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'payment' => 'required|in:paypal,Meet Admins',
        ]);

        if ($validate_fields->fails()) {
            return back()->with('toast_error', $validate_fields->messages()->all()[0])->withInput();
        }

        if ($request->payment === "Meet Admins") {

            // create new date with timezone philippines
            date_default_timezone_set('Asia/Manila');

            $date = date('y-m-d'); // date now
            // STRING
            $string_add_days = date('y-m-d', strtotime($date . ' + 2 days'));
            $string_C_HourNow = date('h:i a');

            $Today = $string_add_days .' '. $string_C_HourNow;

            // // day now
            $DayNow = date('d');

            if ($DayNow == "29" || $DayNow == "30" || $DayNow == "31") {
                return back()->with('errors', 'Sorry for inconvenience due to system problem, registration is currently down at the moment, the developers are working on it as soon as possible, Thank you! Good Day!');
            } else {
                $seller = new Seller;
                $seller->firstname = $request->firstname;
                $seller->lastname = $request->lastname;
                $seller->store_name = $request->store_name;
                $seller->email = $request->email;
                $seller->password = Hash::make($request->password);
                $seller->expiration_date = strtotime($Today);
                $seller->save();

                return redirect('seller-logging-in')->with('success', 'Your are now registered, sign in now and make an appointment for your payment');
            }
        } else {
            return back()->with('errors', 'this method is not available at the momment');
        }
    }
}
