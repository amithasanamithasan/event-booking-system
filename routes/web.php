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

// --------------------------- frontend --------------------------------------

Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('/home', 'Frontend\HomeController@index')->name('home');

Route::get('/about-us', 'Frontend\AboutUsController@about_us')->name('about-us');

Route::get('/services', 'Frontend\ServicesController@showServices')->name('services');
Route::get('/organization/{id}', 'Frontend\OrganizationController@organizationList')->name('organization.list');
Route::get('/event-details/{id}', 'Frontend\OrganizationController@showEventDetails')->name('event.details');
Route::post('/event-review', 'Frontend\OrganizationController@reviewSubmit')->name('event-review.submit');
Route::post('/booking', 'Frontend\EventBookingController@eventBooking')->name('event.booking');

Route::get('/blog', 'Frontend\BlogController@showBlog')->name('blog');
Route::get('/blog-details/{id}', 'Frontend\BlogController@showBlogDetails')->name('blog.details');
Route::post('/blog-review', 'Frontend\BlogController@reviewSubmit')->name('blog-review.submit');


// ---------------------------- backend --------------------------------------

Auth::routes();
// ---------------------------- user route ------------------------------------
 Route::prefix('user')->group(function(){
	Route::get('/', 'Backend\User\DashboardController@index')->name('user.dashboard');

	Route::get('/logout', 'Auth\LoginController@userLogout')->name('user.logout');

	Route::get('/profile', 'Backend\User\ProfileController@showProfile')->name('user.profile');
	Route::get('/edit-profile', 'Backend\User\ProfileController@showEditProfileForm')->name('user.edit.profile');
	Route::post('/update-profile', 'Backend\User\ProfileController@updateProfile')->name('user.update_profile.submit');
	// -------------------- event------------------------------------------------
	Route::get('/add-event', 'Backend\EventController@showEventPostForm')->name('user.add-event');

	Route::post('/add-event', 'Backend\EventController@showEventPostForm')->name('user.add-event.submit');
	Route::get('/show-events', 'Backend\EventController@showEventList')->name('user.show-events');



	// ---------------------------blog--------------------------------------------

	Route::get('/add-blog', 'Backend\BlogController@showBlogPostForm')->name('user.add-blog');

	Route::post('/add-blog', 'Backend\BlogController@showBlogPostForm')->name('user.add-blog.submit');

	Route::get('/blog-list', 'Backend\BlogController@showBlogList')->name('user.blog-list');
	Route::get('/delete-blog/{id}', 'Backend\BlogController@deleteBlog')->name('user.delete-blog');

	Route::get('/edit-blog/{id}', 'Backend\BlogController@showEditBlogPostForm')->name('user.edit-blog');
	Route::post('/edit-blog/{id}', 'Backend\BlogController@showEditBlogPostForm')->name('user.edit-blog');

 });
// -------------------------- admin route ---------------------------------------
 Route::prefix('admin')->group(function(){
 	// ---------------------------- Auth -------------------------------------------
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
	Route::get('/check-email', 'Auth\AdminLoginController@checkEmail')->name('admin.check.email');

	Route::get('/', 'Backend\Admin\DashboardController@index')->name('admin.dashboard');
	// ------------------------ change password ----------------------------------
	Route::get('/change-password', 'Backend\Admin\ChangePasswordController@showChangePasswordForm')->name('admin.change.password');
	Route::get('/check-password', 'Backend\Admin\ChangePasswordController@checkPassword')->name('admin.check.password');
	Route::post('/change-password', 'Backend\Admin\ChangePasswordController@updatePassword')->name('admin.change.password.submit');
	// ------------------------- profile ------------------------------------------
	Route::get('/edit-profile', 'Backend\Admin\ChangePasswordController@showChangePasswordForm')->name('admin.edit.profile');
	
	Route::post('/update-profile', 'Backend\Admin\ProfileController@updateProfile')->name('admin.update_profile.submit');
	Route::get('/profile', 'Backend\Admin\ProfileController@showProfile')->name('admin.profile');
	// ------------------------ category -------------------------------------------
	Route::match(['get','post'],'/add-category', 'Backend\Admin\CategoryController@addCategory')->name('admin.add-category');
	Route::get('/show-category', 'Backend\Admin\CategoryController@showCategory')->name('admin.show-category');

	Route::get('/blog-post', 'Backend\BlogController@showBlogPost')->name('admin.blog-post');
	// ----------------------- event ----------------------------------------------
	Route::get('/event-list', 'Backend\Admin\EventBookingController@showEventList')->name('admin.event-list');

	// ---------------------------- event booking ---------------------------

	Route::get('/booking-list', 'Backend\Admin\EventBookingController@showUnapprovedBookingList')->name('admin.booking-list');
	Route::get('/approved-booking/{id}', 'Backend\Admin\EventBookingController@showUnapprovedBookingList')->name('admin.approved-booking');
	// ------------------------------ blog -----------------------------------------
	Route::get('/approved-blog/{id}', 'Backend\Admin\BlogController@showUnapprovedBlogsList')->name('admin.approved-blog');
	Route::get('/delete-blog/{id}', 'Backend\Admin\BlogController@deleteBlog')->name('admin.delete-blog');

	Route::get('/book-list', 'Backend\Admin\BookController@showBooksList')->name('admin.book-list');

	Route::get('/blog-list', 'Backend\Admin\BlogController@showBlogList')->name('admin.blog-list');



 });
