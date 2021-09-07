<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Category;
use App\CmsPage;

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/admin')->namespace('Admin')->group(function(){
    // All the Admin Routes will be defined here :-
    Route::match(['get', 'post'], '/', 'AdminController@login');
    
    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('settings', 'AdminController@settings');
        Route::get('logout', 'AdminController@logout');
        Route::post('check-current-pwd', 'AdminController@chkCurrentPassword');
        Route::post('update-current-pwd', 'AdminController@updateCurrentPassword'); 
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails');

        // Sections
        Route::get('sections', 'SectionController@sections');
        Route::post('update-section-status', 'SectionController@updateSectionStatus');

        // Brands
        Route::get('brands', 'BrandController@brands');
        Route::post('update-brand-status', 'BrandController@updateBrandStatus');        
        Route::match(['get', 'post'], 'add-edit-brand/{id?}', 'BrandController@addEditBrand');
        Route::get('delete-brand/{id}', 'BrandController@deleteBrand');

        // Categories 
        Route::get('categories', 'CategoryController@categories');
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
        Route::post('append-categories-level', 'CategoryController@appendCategoryLevel');
        Route::get('delete-category-image/{id}', 'CategoryController@deleteCategoryImage');
        Route::get('delete-category/{id}', 'CategoryController@deleteCategory');

        // Products
        Route::get('products', 'ProductsController@products');
        Route::post('update-product-status', 'ProductsController@updateProductStatus');
        Route::get('delete-product/{id}', 'ProductsController@deleteProduct');
        Route::match(['get', 'post'], 'add-edit-product/{id?}', 'ProductsController@addEditProduct');
        Route::get('delete-product-image/{id}', 'ProductsController@deleteProductImage');
        Route::get('delete-product-video/{id}', 'ProductsController@deleteProductVideo');

        // Attributes
        Route::match(['get', 'post'], 'add-attributes/{id}', 'ProductsController@addAttributes');
        Route::post('edit-attributes/{id}', 'ProductsController@editAttributes');
        Route::post('update-attribute-status', 'ProductsController@updateAttributeStatus');
        Route::get('delete-attribute/{id}', 'ProductsController@deleteAttribute');

        // Images
        Route::match(['get', 'post'], 'add-images/{id}', 'ProductsController@addImages');
        Route::post('update-image-status', 'ProductsController@updateImageStatus');
        Route::get('delete-image/{id}', 'ProductsController@deleteImage');

        // Banners 
        Route::get('banners', 'BannersController@banners');
        Route::match(['get', 'post'], 'add-edit-banner/{id?}', 'BannersController@addEditBanner');
        Route::post('update-banner-status', 'BannersController@updateBannerStatus');
        Route::get('delete-banner/{id}', 'BannersController@deleteBanner');

        //Coupons 
        Route::get('coupons', 'CouponsController@coupons');
        Route::post('update-coupon-status', 'CouponsController@updateCouponStatus');
        Route::match(['get', 'post'], 'add-edit-coupon/{id?}', 'CouponsController@addEditCoupon');
        Route::get('delete-coupon/{id}', 'CouponsController@deleteCoupon');

        // Orders
        Route::get('orders', 'OrdersController@orders');
        Route::get('orders/{id}', 'OrdersController@orderDetails');
        Route::post('update-order-status', 'OrdersController@updateOrderStatus');
        Route::get('view-order-invoice/{id}', 'OrdersController@viewOrderInvoice');
        Route::get('print-pdf-invoice/{id}', 'OrdersController@printPDFInvoice');

        // Shipping Charges
        Route::get('view-shipping-charges', 'ShippingController@viewShippingCharges');
        Route::match(['get', 'post'], 'edit-shipping-charges/{id}', 'ShippingController@editShippingCharges');
        Route::post('update-shipping-status', 'ShippingController@updateShippingStatus');

        // Users 
        Route::get('users', 'UsersController@users');

        Route::post('update-user-status', 'UsersController@updateUserStatus');

        // CMS Pages
        Route::get('cms-pages', 'CmsController@cmsPages');
        Route::post('update-cms-page-status', 'CmsController@updateCmsPageStatus');
        Route::match(['get', 'post'], 'add-edit-cms-page/{id?}', 'CmsController@addEditCmsPage');
        Route::get('delete-page/{id}', 'CmsController@deleteCmsPage');

        // Admins / Sub-Admins
        Route::get('admins-subadmins', 'AdminController@adminsSubadmins');
        Route::match(['get', 'post'], 'add-edit-admin-subadmin/{id?}', 'AdminController@addEditAdminSubadmin');
        
        Route::post('update-admin-status', 'AdminController@updateAdminStatus');
        Route::get('delete-admin/{id}', 'AdminController@deleteAdminSubAdmin'); 
        Route::match(['get', 'post'], 'update-role/{id}', 'AdminController@updateRole');
    });
    
});


Route::namespace('Front')->group(function(){
    // Home Page Route
    Route::get('/', 'IndexController@index');
    // Listing/Categories Route
    // First Listing method 
    // Route::get('/{url}', 'ProductsController@listing');

    //Get Category URLs
    // $catUrls = Category::select('url', 'status')->where('status', 1)->get()->toArray();
    // $catUrls = Category::select('url')->where('status', 1)->get()->toArray();
    $catUrls = Category::select('url')->where('status', 1)->get()->pluck('url')->toArray();
    // $catUrls= json_decode(json_encode($catUrls));
    // $catUrls = array_flatten($catUrls);
    // echo "<pre>"; print_r($catUrls); die;
    foreach ($catUrls as $url) {
        Route::get('/'.$url, 'ProductsController@listing');
    }
    // Route::get('/contact-us', function(){
    //     echo "test";die;
    // });

    // CMS Routes
    $cmsUrls = CmsPage::select('url')->where('status', 1)->get()->pluck('url')->toArray();
    foreach ($cmsUrls as $url){
        Route::get('/'.$url, 'CmsController@cmsPage');
    }

    // Product Detail Route
    Route::get('/product/{id}', 'ProductsController@detail');

    // Get Product Attribute Price
    Route::post('/get-product-price', 'ProductsController@getProductPrice');

    // Add to Cart Route
    Route::post('/add-to-cart', 'ProductsController@addtocart');

    // Shopping Cart Route 
    Route::get('/cart', 'ProductsController@cart');

    // Update Cart Item Quantity
    Route::post("/update-cart-item-qty", "ProductsController@updateCartItemQty");

    // Delete Cart Item 
    Route::post('/delete-cart-item', 'ProductsController@deleteCartItems');

    // Login/Register
    // Route::get('/login-register', 'UsersController@loginRegister');
    // To cancel the error Route [login] not defined.

    // The as login is redirected to the middleware funcion declared in the Authenticate.php
    Route::get('/login-register', ['as' => 'login', 'uses'=> 'UsersController@loginRegister']);

    Route::post('/login', 'UsersController@loginUser');

    // Register User
    Route::post('/register', 'UsersController@registerUser');

    // Check if Email Already exist
    Route::match(['get', 'post'], '/check-email', 'UsersController@checkEmail');

    // Logout User
    Route::get('/logout', 'UsersController@logoutUser');

    // Confirm Account
    Route::match(['GET', 'POST'], '/confirm/{code}', 'UsersController@confirmAccount');

    // Forgot Password
    Route::match(['GET', 'POST'], '/forgot-password', 'UsersController@forgotPassword');

    // Check Delivery Pincode

    Route::post('/check-pincode', 'ProductsController@checkPincode');

    // Search Products
    Route::get('/search-products', 'ProductsController@listing');

    // Contact Route Page 
    Route::match(['GET', 'POST'], '/contact', 'CmsController@contact');
    
    Route::group(['middleware'=>['auth']], function(){

        //Users Account 
        Route::match(['GET', 'POST'], '/account', 'UsersController@account');

        // Users Orders 
        Route::get('/orders', 'OrdersController@orders');

        // User Order Details 
        Route::get('/orders/{id}', 'OrdersController@orderDetails');

        // Check User Password
        Route::post('check-user-pwd', 'UsersController@chkUserPassword');

        // Update User Password
        Route::post('/update-user-pwd', 'UsersController@updateUserPassword');

        // Apply Coupon 
        Route::post('/apply-coupon', 'ProductsController@applyCoupon');

        // Checkout
        Route::match(['GET', 'POST'], '/checkout', 'ProductsController@checkout');

        // Add Edit Delivery Address
        Route::match(['GET', 'POST'], '/add-edit-delivery-address/{id?}', 'ProductsController@addEditDeliveryAddress');

        // Delete Delivery Address 
        Route::get('/delete-delivery-address/{id}', 'ProductsController@deleteDeliveryAddress');

        // Thanks 
        Route::get('/thanks', 'ProductsController@thanks');
        
        // Paypal
        Route::get('/paypal', 'PaypalController@paypal');

        // Paypal Success
        Route::get('/paypal/success', 'PaypalController@success');

        // Paypal Fail
        Route::get('/paypal/fail', 'PaypalController@fail');
        
        // Paypal IPN
        Route::post('/paypal/ipn', 'PaypalController@ipn');
        
        // Payumoney
        Route::get('/payumoney', 'PayumoneyController@payumoney');
    });


});