<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
header('Access-Control-Allow-Origin:  http://localhost:4200');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Word API
Route::get('words','Api\wordsListingController@index');
Route::get('search','Api\searchController@wordSearch');
Route::get('popular-words','Api\wordsListingController@popularWord');
Route::get('searchWord','Api\searchController@GetwordById');
Route::get('latest-meaning','Api\wordsListingController@latestWord');
Route::get('word-category','Api\wordsListingController@wordAllCategory');
Route::post('addAnswerWord','Api\wordsListingController@addAnswerWordByUser');
Route::post('addWordReport','Api\wordReportController@addWordReport');
Route::post('addWordComment','Api\wordsListingController@addWordComment');
Route::get('allCommentByWordId','Api\wordsListingController@allCommentByWordId');
Route::get('wordOfTheDay','Api\wordsListingController@wordOfTheDay');
Route::post('addWord','Api\wordsListingController@addWord');
Route::get('totalWordUpvote','Api\wordsListingController@totalWordUpvote');
Route::post('wordVoteSystem','Api\wordsListingController@upvoteDownvoteSystem');


// Subscription API
Route::post('wordSubscription','Api\wordsListingController@wordSubscription');
Route::get('subscription','Api\subscriptionController@index');


// Ads Manager API
Route::get('adsManager','Api\AdsManagerController@index');

// Blogs API

Route::get('blogs','Api\blogListingController@index');
Route::get('single-blog','Api\blogListingController@getBlogById');
Route::get('blog-category','Api\blogListingController@blogAllCategory');
Route::get('category-blog','Api\blogListingController@blogByCategory');
Route::get('latest-blog','Api\blogListingController@latestBlog');
Route::post('addBlogComment','Api\blogListingController@addBlogComment');
Route::get('allCommentByBlogId','Api\blogListingController@allCommentByBlogId');

// Authentication API
Route::put('register','Api\registerController@register');
Route::put('login','Api\registerController@login');