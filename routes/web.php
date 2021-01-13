<?php

use Illuminate\Support\Facades\Route;

if (App::environment('production')) {
    URL::forceScheme('https');
}

Auth::routes();

// ---------- GET---------- //
// show main page
Route::get('', 'Main\MainController@main')->name('Main');

// VIEW PRODUCT
Route::get('/product/{id}', 'Main\MainController@ViewProduct')->name('product');
//  show my account page
Route::get('/my-account', 'Main\UserController@myAccount')->name('user.myaccount');
// show change password
Route::get('/change-password', 'Main\UserController@ShowChangePass')->name('user.changepassword');
//  show add shipping address page
Route::get('/shipping-address', 'Main\UserController@ShowshippingAddress')->name('user.shippingaddress');
// delete shipping AddAddress
Route::get('/delete-address/{id}', 'Main\UserController@DeleteAddress')->name('delete-address');
// edit address
Route::get('/edit-address/{id}', 'Main\UserController@EditAddress')->name('user.editaddress');


// -------------POST----------- //
// get all products
Route::get('/all-products', 'Main\MainController@ShowProducts')->name('all.products');
Route::get('/check-products', 'Main\MainController@CheckProduct')->name('check.products');
// to update info
Route::post('/updateInfo', 'Main\UserController@UpdateInformation')->name('updateInfo');
//  my account change profile
Route::post('/chanageprofile', 'Main\UserController@ChangeProfilePicture')->name('chanageprofile');
// sidebar chnage profile
Route::post('/changeSidebarProfile', 'Main\UserController@ChangeSidebarProfile')->name('changeSidebarProfile');
// to change password
Route::post('/changepassword', 'Main\UserController@ChangePassword')->name('changepassword');
//  to add shipping address
Route::post('/addaddress', 'Main\UserController@AddAddress')->name('addaddress');
// update shipping address address
Route::post('/update_shippingaddress', 'Main\UserController@UpdateAddress')->name('update_shippingaddress');


Route::group(['guard' => 'seller'], function () {
    // show register seller
    Route::get('seller-registration', 'Seller\RegisterController@showSellerRegister')->name('register.seller');

    // store register seller
    Route::post('seller-register', 'Seller\RegisterController@registerSeller')->name('seller.register');

    // showlogin seller
    Route::get('seller-logging-in', 'Seller\LoginController@showSellerLogin')->name('login.seller');

    // store login seller
    Route::post('seller-login', 'Seller\LoginController@login')->name('seller.login');

    //show dashboard seller
    Route::get('seller-dashboard', 'Seller\SellerController@showSellerDashboard')->name('seller.dashboard');
    // make appointment
    Route::post('make-appointment', 'Seller\SellerController@MakeAppointment')->name('make.appointment');
    // get add product
    Route::get('seller-add-product', 'Seller\SellerController@showAddProduct')->name('seller.addProduct');
    // add product post
    Route::post('seller-add-product', 'Seller\SellerController@AddProduct')->name('seller.addProduct');
    //seller count product
    Route::get('count-product', 'Seller\SellerController@CountProduct')->name('count-product');
    // seller delete product
    Route::get('delete-product/{id}', 'Seller\SellerController@DeleteProduct')->name('delete-product');
    // show edit product
    Route::get('edit-product/{id}', 'Seller\SellerController@EditProduct')->name('edit-product');
    Route::post('update-product/{id}', 'Seller\SellerController@UpdateProduct')->name('update-product');
});


Route::group(['guard' => 'admin'], function () {
    // GET

    // show login admin
    Route::get('/administrator-login', 'Admin\LoginController@showAdminLogin')->name('login.admin');
    // POST
    Route::post('/administrator-login', 'Admin\LoginController@login')->name('login.admin');
    // redirect admin dashboard
    Route::get('/administrator', 'Admin\AdminController@index')->name('admin.home');

    //show registered users
    Route::get('/administrator/registered-users', 'Admin\AdminController@ShowTablesForUsers')->name('show.tableForUsers');
    // show registered sellers
    Route::get('/administrator/registered-sellers', 'Admin\AdminController@ShowTablesForSellers')->name('show.tableForSellers');
    //approve seller registration
    Route::get('/administrator/registered-sellers/approved-seller-registration/{id}', 'Admin\AdminController@ApprovedSellerRegistration')->name('seller.approved');
    //not approve seller registration
    Route::get('/administrator/registered-sellers/not-approve-seller-registration/{id}', 'Admin\AdminController@NotApprovedSellerRegistration')->name('seller.notapproved');
    // resumed seller registration
    Route::get('/administrator/registered-sellers/resumed-seller-registration/{id}', 'Admin\AdminController@ResumedSellerRegistration')->name('seller.resumed');
});

