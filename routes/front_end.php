<?php

Route::get('/products/{slug}', 'ProductController@show')->name('frontend.products.detail');
Route::get('search',['as'=>'search','uses'=>'HomeController@search']);
Route::get('faqs',['as'=>'faq','uses'=>'HomeController@faq']);
Route::get('terms-conditions',['as'=>'terms','uses'=>'HomeController@termsCondition']);
Route::get('request-for-wholeseller',['as'=>'request.wseller','uses'=>'HomeController@requestWholeSeller']);
Route::post('request-for-wholeseller',['as'=>'request.wsellerStore','uses'=>'HomeController@requestWholeSellerStore']);
Route::get('about-us',['as'=>'about','uses'=>'HomeController@aboutUs']);

/*Cart Routes*/
Route::post('add-to-cart/{slug}', 'CartController@addToCart')->name('add_to_cart');
Route::get('cart', 'CartController@cartItems')->name('cart-items');
Route::get('cart-content', 'CartController@getCartContent')->name('front.cart.content');
Route::post('cart/item/update', 'CartController@updateProductQuantity')->name('front.cart.item.update');
Route::get('remove-from-cart/{id}', 'CartController@removeFromCart')->name('remove-from-cart');
Route::get('clear-cart', 'CartController@destroyCart')->name('clear-cart');
// Route::post('update-cart', 'CartController@updateCart')->name('update-cart');
Route::post('cart-update','CartController@updateCart')->name('update.cart');
Route::get('customer-login','Auth\CustomerLoginController@customerLogin')->name('customer_login');
Route::get('register/verify/{token}', 'Auth\RegisterController@verify')->name('verify');

Route::get('/member/profile', function () {
    // verified users only
    dd('test');
})->middleware('verified');

Route::middleware('frontAuth')->group(function () {
Route::get('checkout', 'CartController@checkout')->name('checkout');
Route::post('process-payment', 'PaymentController@process')->name('payment.process');
Route::get('account',['as'=>'customer.account','uses'=>'UserAccountController@index']);


Route::get('account/wishlist',['as'=>'account.wishlist','uses'=>'UserAccountController@myWishlist']);
Route::get('account/order-history',['as'=>'account.history','uses'=>'UserAccountController@myOrderHistory']);

Route::post('account/update',['as'=>'account.update','uses'=>'UserAccountController@updateProfile']);

Route::get('add-to-wish/{productId}', ['as'=>'add.wish','uses'=>'UserAccountController@addToWishList']);
Route::post('review', ['as'=>'review.store','uses'=>'UserAccountController@storeReview']);
});
Route::get('reviews', 'UserAccountController@reviews')->name('front.reviews');
Route::get('category/{slug}', 'CategoryController@getCategoryProducts')->name('front.category.index');



// social login starts
Route::get('login/facebook', 'SocialLoginController@redirectToFacebook')->name('facebookLogin');
Route::get('login/facebook/callback', 'SocialLoginController@getFacebookCallback');
Route::get('login/google', 'SocialLoginController@redirectToGoogle')->name('googleLogin');
Route::get('login/google/callback', 'SocialLoginController@getGoogleCallback');
Route::get('a-logout', 'SocialLoginController@logout')->name('sLogout');
// social login ends

// categories page
Route::get('category/{category_slug?}', 'HomeController@categoryPage')->name('frontend.category-page');
Route::post('load-category/{limit?}/{category_slug?}', 'HomeController@loadCategory')->name('frontend.load-category');

Route::post('subscribe', 'HomeController@subscribe')->name('frontend.subscribe');


// vendor
Route::resource('vendor', 'VendorController');
Route::get('vendor-product/{vendor}/{vendorSlugId}/{categoryName?}','VendorController@vendorProduct')
->name('vendor.product');
Route::post('load-vendor-product/{limit?}','VendorController@loadVendorProduct')
->name('vendor.load-vendor-product');
