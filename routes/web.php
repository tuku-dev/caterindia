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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'homeController@showHome');
Route::get('about-us', 'homeController@aboutUs');
Route::get('contact-us', 'homeController@contactUs');
Route::post('contact-us', 'homeController@sendContactUsMail');

Route::get('reservation', 'homeController@reservationTable');
Route::get('our-blog', 'homeController@ourBlog');
Route::get('our-blog', 'homeController@ourBlog');
Route::get('user-login', 'homeController@viewUserLogin');
Route::post('user-login', 'homeController@userLoginProcess');
Route::get('cart', 'homeController@viewCart');
Route::get('restaurants/{name}', 'homeController@viewRestaurants');
Route::get('restaurant/{id}/{name}', 'homeController@viewRestaurantItems');

Route::get('save-nl-data', 'homeController@saveNewsletterData');

Route::post('user-registration', 'homeController@saveUserRegistrationData');
Route::get('user-registration', function() {
	return Redirect::to('user-login');
});
Route::post('otp-varification', 'homeController@otpVerify');
Route::get('otp-varification', function() {
	return Redirect::to('user-login');
});
Route::post('resend-otp', 'homeController@resendOtp');
Route::get('resend-otp', function() {
	return Redirect::to('user-login');
});

Route::post('forgot-otp', 'homeController@forgotOtp');
Route::get('forgot-otp', function() {
	return Redirect::to('user-login');
});

Route::post('otp-varification-changepassword', 'homeController@otpVerificationChangepsw');
Route::get('otp-varification-changepassword', function() {
	return Redirect::to('user-login');
});

Route::post('change-password', 'homeController@changePassword');
Route::get('change-password', function() {
	return Redirect::to('user-login');
});
Route::get('user-logout', 'homeController@userLogout');

//Search Area
Route::post('searchArea', 'homeController@searchareResult');

//Add to cart
Route::post('add_cart', 'homeController@addedToCart');
/* * ****************************BACKEND SECTION STARTS FROM HERE***************************** */
Route::get('administrator', function() {
    if (Session::get('admin_id') != '') {
        return Redirect::to('administrator/dashboard');
    } else {
        return View::make('admin.login');
    }
});

Route::post('admin-login', 'adminController@adminLogin');

//Admin Logout
Route::get('administrator/logout', array('uses' => 'adminController@logout'));

//forgot password - Admin
Route::get('administrator/forgot-psw-admin', function() {
    return View::make('admin.forgot-psw-admin');
});
Route::post('admin-forgot-psw-process', 'adminController@adminPswRecovery');

Route::group(['middleware' => ['checkadminlogin']], function() {
	
	Route::get('administrator/dashboard', function() {
        return View::make('admin.dashboard');
    });
	
	//My Account
    Route::get('administrator/my-account', 'adminController@viewAdminAccount');
    Route::post('update-admin-details', 'adminController@updateAdminDetails');

    //Changa Password
    Route::get('administrator/change-password-admin', 'adminController@viewChangePassword');
    Route::post('change-admin-psw', 'adminController@changeAdminPsw');

    //Manage SEO
    Route::get('administrator/manage-seo', 'adminController@viewManageSeo');
    Route::post('update-seo-details', 'adminController@updateSeoDetails');
	
	//Manage Contents
    Route::get('administrator/manage-contents', 'adminController@viewManageContents');
    Route::get('administrator/edit-content/{id}/edit', 'adminController@viewEditContent');
    Route::post('update-content', 'adminController@updateContent');

    //Manage Banners
    Route::get('administrator/manage-banners', 'adminController@viewManageBanners');

    Route::get('administrator/add-banner', 'adminController@viewAddBanner');
    Route::post('add-banner', 'adminController@saveBannerData');

    Route::get('administrator/edit-banner/{id}/edit', 'adminController@viewEditBanner');
    Route::post('update-banner', 'adminController@updateBanner');

    Route::get('administrator/manage-banners/{id}/delete', 'adminController@deleteBanner');

    //Manage Newsletter Admin Section
    Route::get('administrator/manage-newsletter', 'adminController@viewManageNewsletter');
    Route::get('administrator/manage-newsletter/{id}/delete', 'adminController@deleteNlEmail');
    Route::post('manage-newsletter', 'adminController@sendNewsletterMail');
	
	//Manage Area
	Route::get('administrator/manage-area', 'adminController@viewManageArea');
	
	Route::get('administrator/add-area', 'adminController@viewAddArea');
	Route::post('add-area', 'adminController@saveAreaData');
	
	Route::get('administrator/edit-area/{id}/edit', 'adminController@viewEditarea');
	Route::post('update-area', 'adminController@updateArea');
	
	Route::get('administrator/manage-area/{id}/delete', 'adminController@deleteArea');
	
	//Manage Restaurant
	Route::get('administrator/restaurant', 'adminController@viewRestaurant');
	
	Route::get('administrator/add-restaurant', 'adminController@viewAddRestaurant');
	Route::post('add-restaurant', 'adminController@saveRestaurant');
	
	Route::get('administrator/edit-restaurant/{id}/edit', 'adminController@viewEditRestaurant');
	Route::post('edit-restaurant', 'adminController@updateRestaurant');
	
	Route::get('administrator/restaurant/{id}/delete', 'adminController@deleteRestaurant');
	
	//Manage Category
	Route::get('administrator/manage-category', 'adminController@manageCategory');
	Route::get('administrator/add-category', 'adminController@viewAddCategory');
	Route::post('add-category', 'adminController@saveCategory');
	Route::get('administrator/edit-category/{id}/edit', 'adminController@viewEditCategory');
	Route::post('edit-category', 'adminController@updateCategory');
	Route::get('administrator/manage-category/{id}/delete', 'adminController@deleteCategory');
	
	//Manage Subcategory
	Route::get('administrator/manage-subcategory', 'adminController@manageSubategory');
	Route::get('administrator/add-subcategory', 'adminController@viewAddSubcategory');
	Route::post('findCategory', 'adminController@FindCategory');
	Route::post('add-subcategory', 'adminController@saveSubcategory');
	Route::get('administrator/edit-subcategory/{id}/edit', 'adminController@viewEditSubcategory');
	Route::post('edit-subcategory', 'adminController@updateSubcategory');
	Route::get('administrator/manage-subcategory/{id}/delete', 'adminController@deleteSubcategory');
	
	//Manage Items
	Route::get('administrator/manage-items', 'adminController@manageItems');
	Route::get('administrator/add-items', 'adminController@viewAddItems');
	Route::post('findSubcategory', 'adminController@FindSubcategory');
	Route::post('add-items', 'adminController@saveItems');
	Route::get('administrator/edit-items/{id}/edit', 'adminController@viewEditItems');
	Route::post('edit-items', 'adminController@updateItems');
	Route::get('administrator/manage-items/{id}/delete', 'adminController@deleteItems');
	
});