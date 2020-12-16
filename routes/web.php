<?php

use Illuminate\Support\Facades\Route;

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
/* --------------- Web --------------------*/
$data = Session::all();
$logSESSION = Session::get('log_base');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', 'UserController@dashboard');  
Route::get('login', function () {
    return view('login');
});

Route::get('register', function () {
    return view('register');
});

Route::get('forgot-password', function () {
    return view('forgotPassword');
});
Route::get('reset-password', function () {
    return view('resetPassword');
});

Route::get('/admin/add-product', function () {
    return view('addProduct');
});




Route::get('/admin/logout','UserController@user_logout');
 /*-------------- Action -------------------*/
Route::post('/registerAction','UserController@user_register')->name('registerAction');
Route::post('/loginAction','UserController@user_login')->name('loginAction');
Route::post('/logoutAction','UserController@user_logout')->name('logoutAction');
Route::post('/forgotPassAction','UserController@forgotPass')->name('forgotPassAction');
Route::post('/resetPassAction','UserController@resetPass')->name('resetPassAction');
Route::post('/addProductAction','productController@addProductAx')->name('addProductAction');

Route::get('/admin/hello', function () {
    echo 'welcome ';
});


Route::get('/admin/dms','DMSController@index');
Route::get('/admin/dms/addWord','DMSController@addWord');
Route::get('/admin/dms/viewWord/{id}','DMSController@viewWord');
Route::get('/admin/dms/editWord/{id}','DMSController@editWord');
Route::post('/addWordAction','DMSController@addWordSubmit')->name('addWordAction');
Route::post('/editWordAction','DMSController@editWordSubmit')->name('editWordAction');
Route::post('/deleteWordAction','DMSController@deleteWord')->name('deleteWordAction');


Route::get('/admin/wordByDay','WordByDayController@index');
Route::get('/admin/wordByDay/addWord','WordByDayController@addWord');
Route::get('/admin/wordByDay/viewWord/{id}','WordByDayController@viewWord');
Route::get('/admin/wordByDay/editWord/{id}','WordByDayController@editWord');
Route::post('/addWordByDayAction','WordByDayController@addWordSubmit')->name('addWordByDayAction');
Route::post('/editWordByDayAction','WordByDayController@editWordSubmit')->name('editWordByDayAction');
Route::post('/deleteWordByDayAction','WordByDayController@deleteWord')->name('deleteWordByDayAction');




Route::get('/admin/popular-word/','PopularWordController@index');
Route::get('/admin/popular-word/add-popular-word','PopularWordController@addPopularWord');
Route::post('/addPopularWordAction','PopularWordController@addPopularWordSubmit')->name('addPopularWordAction');
Route::post('/getWordBySearchTermAction','PopularWordController@getWordBySearchTerm')->name('getWordBySearchTermAction');
Route::post('/deletePopularWordAction','PopularWordController@deletePopularWord')->name('deletePopularWordAction');
Route::get('/admin/popular-word/viewWord/{id}','PopularWordController@viewPopularWord');

Route::get('/admin/blogs','BlogController@index');
Route::get('/admin/blogs/addBlog','BlogController@addBlog');
Route::post('/addBlogAction','BlogController@addBlogSubmit')->name('addBlogAction');
Route::get('/admin/blogs/editBlog/{id}','BlogController@editBlog');
Route::post('/editBlogAction','BlogController@editBlogSubmit')->name('editBlogAction');
Route::post('/deleteBlogAction','BlogController@deleteBlog')->name('deleteBlogAction');
Route::get('/admin/blogs/viewBlog/{id}','BlogController@viewBlog');
Route::get('/paginationAction','BlogController@paginationAction');
//Route::post('/BlogPaginationAction','BlogController@fetch_data')->name('BlogPaginationAction');

// Ads Manager Routing
Route::get('/admin/ads-manager','AdsManagerController@index');
Route::get('/admin/ads-manager/addAds','AdsManagerController@addAdsManager');
Route::post('/addAdsAction','AdsManagerController@addAdsManagerSubmit')->name('addAdsAction');
Route::get('/admin/ads-manager/viewAds/{id}','AdsManagerController@viewAdsManager');
Route::get('/admin/ads-manager/editAds/{id}','AdsManagerController@editAdsManager');
Route::post('/editAdsAction','AdsManagerController@editAdsManagerSubmit')->name('editAdsAction');
Route::post('/deleteAdsAction','AdsManagerController@deleteAds')->name('deleteAdsAction');


Route::get('/admin/subscription','SubscriptionController@index');
Route::get('/admin/subscription/addSubscription','SubscriptionController@addSubscription');
Route::post('/addSubscriptionAction','SubscriptionController@addSubscriptionSubmit')->name('addAdsAction');
Route::get('/admin/subscription/viewSubscription/{id}','SubscriptionController@viewSubscription');
Route::post('/deleteSubscriptionAction','SubscriptionController@deleteSubscription')->name('deleteSubscriptionAction');



Route::get('/admin/newsletter','NewsletterController@index');
Route::get('/admin/newsletter/viewNewsletter/{id}','NewsletterController@viewNewsletter');
Route::get('/admin/subscribers','NewsletterController@subscribers');
Route::get('/admin/newsletter/addNewsletter','NewsletterController@addNewsletter');
Route::post('/addNewsletterAction','NewsletterController@addNewsletterSubmit')->name('addNewsletterAction');
Route::post('/deleteNewsletterAction','NewsletterController@deleteNewsletter')->name('deleteNewsletterAction');


Route::get('/admin/blog-category','BlogCategoryController@index');
Route::get('/admin/blog-category/add-category','BlogCategoryController@addBlogCategory');
Route::post('/addBlogCategoryAction','BlogCategoryController@addBlogCategorySubmit')->name('addBlogCategoryAction');
Route::get('/admin/blog-category/edit/{id}','BlogCategoryController@editBlogCategory');
Route::post('/editBlogCategoryAction','BlogCategoryController@editBlogCategorySubmit')->name('editBlogCategoryAction');
Route::post('/deleteBlogCategoryAction','BlogCategoryController@deleteBlogCategory')->name('deleteBlogCategoryAction');

Route::get('/admin/send',function(){

	$to_name = 'shivam chouhan';
	$to_email = 'shivam.appic@gmail.com';
	$data = array('name'=>'shivam singh chouhan','body'=>'hello body');
	Mail::send('mail',$data,function($message) use ($to_name,$to_email){
		$message->to($to_email)->subject('Lara mail subject');
	});
});


Route::get('/admin/category','CategoryController@index');
Route::get('/admin/category/addCategory','CategoryController@addCategory');
Route::get('/admin/category/viewCategory/{id}','CategoryController@viewCategory');
Route::get('/admin/category/editCategory/{id}','CategoryController@editCategory');
Route::get('/admin/category/wordCategory/{id}','CategoryController@wordCategory');
Route::post('/addCategoryAction','CategoryController@addCategorySubmit')->name('addCategoryAction');
Route::post('/editCategoryAction','CategoryController@editCategorySubmit')->name('editCategoryAction');
Route::post('/deleteCategoryAction','CategoryController@deleteCategory')->name('deleteCategoryAction');


Route::get('/admin/users','UserController@index');
Route::get('/admin/users/addUser','UserController@addUser');
Route::get('/admin/users/viewUser/{id}','UserController@viewUser');
Route::get('/admin/users/editUser/{id}','UserController@editUser');
Route::post('/addUserAction','UserController@addUserSubmit')->name('addUserAction');
Route::post('/editUserAction','UserController@editUserSubmit')->name('editUserAction');
Route::post('/deleteUserAction','UserController@deleteUser')->name('deleteUserAction');






Route::get('/test/add','TestController@add');
Route::post('/test/addSubmit','TestController@addSubmit');


Route::get('/admin/members','MemberController@index');
Route::get('/admin/members/add','MemberController@add');
Route::post('/admin/members/addSubmit','MemberController@addSubmit');













