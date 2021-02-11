<?php

use Illuminate\Support\Facades\Route;

if (App::environment('production')) {
    URL::forceScheme('https');
}


Auth::routes();

// ---------- GET---------- //
Route::get('/setting-cookie', 'Main\MainController@setCookie')->name('set.cookie');
// get all products
Route::get('/all-products', 'Main\MainController@ShowProducts')->name('all.products');
// check abandon carts
Route::get('/check-abandon-cart', 'Main\MainController@DeleteAbandonCart')->name('check.AbandonCart');
// show main page
Route::get('', 'Main\MainController@main')->name('Main');

//add to cart
Route::post('/add-to-cart', 'Main\MainController@addToCart')->name('add.cart');
//count cart
Route::get('/count-cart', 'Main\MainController@CountCart')->name('count.cart');
//get to cart
Route::get('/get-cart', 'Main\MainController@getToCart')->name('get.cart');
//get subtotal cart
Route::get('/get-cart-subtotal', 'Main\MainController@getCartSubtotal')->name('get.cartSubtotal');
// remove cart
Route::get('/remove-cart/{id}', 'Main\MainController@RemoveCart')->name('remove.cart');
// view cart
Route::get('/my-cart', 'Main\MainController@ViewCart')->name('view.cart');
// get row cart
Route::get('/get-row-cart', 'Main\MainController@GetRowCart')->name('getRow.cart');
// delete cart row
Route::get('/delete-cart-row/{id}', 'Main\MainController@DeleteCartRow')->name('delete.cartRow');
// VIEW PRODUCT
Route::get('/product/{id}', 'Main\MainController@ViewProduct')->name('product');
//  show my account page

Route::group(['middleware' => 'auth'], function () {
    // checkout cart
    Route::get('/checkout', 'Main\UserController@CheckOut')->name('user.checkout');
    // use default billing address
    Route::get('/use-billing-address', 'Main\UserController@UseAddress')->name('user.useAddress');
    // billing address post
    Route::get('/checkout/proceed-billing-address', 'Main\UserController@ProceedToCheckout')->name('billing.information');
    // checkout product
    Route::post('checkout/place-order', 'Main\UserController@PlaceOrder')->name('place.order');
    // my account
    Route::get('/my-account', 'Main\UserController@myAccount')->name('user.myaccount');
    //my Order
    Route::get('/my-order', 'Main\UserController@myOrder')->name('user.order');
    // my purchases
    Route::get('/my-purchases', 'Main\UserController@myPurchases')->name('user.mypurchases');
    // show change password
    Route::get('/change-password', 'Main\UserController@ShowChangePass')->name('user.changepassword');
    // show add shipping address page
    Route::get('/shipping-address', 'Main\UserController@ShowshippingAddress')->name('user.shippingaddress');
    // delete shipping AddAddress
    Route::get('/delete-address/{id}', 'Main\UserController@DeleteAddress')->name('delete-address');
    // edit address
    Route::get('/edit-address/{id}', 'Main\UserController@EditAddress')->name('user.editaddress');

    // -------------POST----------- //
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
});


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
