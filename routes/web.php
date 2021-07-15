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


Route::get('/', 'HomeController@index')->name('home');

/*Admin & Vendor Routes*/
Route::group(['prefix' => 'admin', 'namespace'=>'Admin','middleware'=>['auth','authorized_users']], function () {
	Route::get('/', ['as'=>'admin_home','uses'=>'AdminController@index']);

	Route::get('my-profile', 'UserController@profile')->name('user.profile');
    Route::get('change-password', 'UserController@change_password_form')->name('user.password.change');
	Route::post('change-password', 'UserController@change_password')->name('user.password.change.store');
    Route::resource('user', 'UserController', ['only' => ['edit', 'update']]);//vendor can only edit and update profile

    Route::get('show-or-hide-size', 'ProductController@showSize')->name('ajax.size.show-hide');
    Route::get('product/vendor-products', 'ProductController@getVendorProducts')->name('product.vendor_products');
    Route::get('product/remove-image','ProductController@removeImage')->name('product.remove_image');
    Route::resource('product', 'ProductController');
    Route::resource('order', 'OrderController', ['only' => ['index']]);
    Route::get('product/{id}/reviews','ProductController@getReviews')->name('get_reviews');
    Route::delete('review/delete/{id}','ProductController@deleteReview')->name('delete_review');

    Route::get('product/{id}/faqs', 'ProductFaqController@index')->name('admin.productfaq.index');
    Route::get('product/{id}/create', 'ProductFaqController@create')->name('admin.productfaq.create');
    Route::post('product/faq/store', 'ProductFaqController@store')->name('admin.productfaq.store');
    Route::post('product/faq/show', 'ProductFaqController@show')->name('admin.productfaq.show');
    Route::delete('product/faq/{faq}/destroy', 'ProductFaqController@destroy')->name('admin.productfaq.destroy');
    Route::get('product/faq/{id}/edit', 'ProductFaqController@edit')->name('admin.productfaq.edit');
    Route::post('product/faq/{id}/update', 'ProductFaqController@update')->name('admin.productfaq.update');

	// routes only admin can access
	Route::group(['middleware' => 'role', 'roles' => ['admin']], function () {

		Route::resource('company', 'CompanyController')->only(['edit', 'update']);
		Route::resource('faq','FaqController');
		Route::get('/change-conversion-rate', 'AdminController@changeConversionRate')->name('change-rate');
		Route::get('change-approved-status/{id}','UserController@changeApprovedStatus')->name('approved_status');
		Route::resource('user', 'UserController',['except' => ['edit', 'update']]);//removing edit and update route here for admin middleware so that vendor won't enter here while updating profile
		Route::resource('category', 'CategoryController');
		Route::resource('attribute', 'AttributeController');
		Route::resource('sub-category', 'SubCategoryController',['except'=>'index']);
		Route::get('subscribers', 'AdminController@subscribers')->name('admin.subscriber');
		Route::resource('advertisement', 'AdvertisementController');
		Route::resource('news', 'NewsController');
		Route::resource('notification', 'PushNotificationController');
		Route::resource('slider', 'SliderController');
		Route::resource('color','ColorController');

        // site settings
        Route::get('/site-settings', 'SiteSettingController@general')->name('admin.site_settings.general');
        Route::post('/site-settings/home/store', 'SiteSettingController@homePageStore')->name('admin.site_settings.home.store');

		// admin ajax
		Route::prefix('ajax')->group(function () {
			Route::get('show-or-hide-sub-category', 'CategoryController@show_or_hide_sub_category')->name('ajax.sub-category.show-hide');
			Route::get('category/show-on-menu/{category}', 'CategoryController@show_on_menu')->name('category.show-on-menu');
			Route::get('category/make-exclusive/{category}', 'CategoryController@make_exclusive')->name('category.make-exclusive');
			Route::get('category/set-priority/{category}', 'CategoryController@set_priority')->name('category.set-priority');

		});
	});
	Route::get('order/change-status/{id}', 'OrderController@changeStatus')->name('order.change-status');
	Route::get('order/{order}/products', 'OrderController@getProducts')->name('order.get-products');

});

Auth::routes();
// Auth::routes(['verify' => true]);
Route::group(['prefix' => 'admin', 'namespace'=>'Admin','middleware'=>['auth','authorized_users']], function () {
    // routes only admin can access
    Route::group(['middleware' => 'role', 'roles' => ['admin']], function () {
        Route::resource('groups', 'GroupController');
        Route::resource('brands', 'BrandController');
    });
});

// front routes
Route::get('/system-clear-cache', function () {
    // Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:cache');
    Artisan::call('migrate');
    // Artisan::call('db:seed');
    // Artisan::call('storage:link');
    return "Cache is cleared";
});

Route::get('/category/{id}/attributes', 'Admin\CategoryController@getAttributes')->name('admin.category.attributes');
