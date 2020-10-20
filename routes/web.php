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

//-----------Homepage route-----------//
Route::get('/', 'HomeController@index')->name('home');

//-----------Authenticate routes-----------//
Auth::routes();
Route::get('/logout', function(){
    Auth::logout();
    return redirect()->route('home');
});

//-----------User routes-----------//
//Display the page with all users (for admins only)
Route::get('/user', 'UserController@index')->name('users');
//Display a specific user profile page
Route::get('/user/{id}', 'UserController@details')->name('user-profile');
// //Display the edit form for users
// Route::get('/user/{id}/edit', 'UserController@displayEdit')->name('user-edit-form');
//Route to update the user
Route::post('/user/{id}/update', 'UserController@update')->name('user-update');
//Display all the artists
Route::get('/artist', 'UserController@artistIndex')->name('artists');
//Display with filter
Route::post('/artist', "UserController@artistIndex")->name("artists");
//Concerts of an artist
Route::get('/artist/{id}', 'UserController@artistDetails')->name('artist-details');

//-----------Categories routes-----------//
//Display the page with all categories (for admins only)
Route::get('/category', 'CategoryController@index')->name('categories');
//Display details about one category
Route::get('category/{slug}', 'CategoryController@details')->name('category-details');
//Display the edit form for category
Route::get('/category/{slug}/edit', 'CategoryController@displayEdit')->name('category-edit-form');
//Route to update the category
Route::post('/category/{slug}/update', 'CategoryController@update')->name('category-update');

//-----------Concerts routes-----------//
//Display all concerts
Route::get('/concert', "ConcertController@index")->name("concerts");
//Display with filters
Route::post('/concert', "ConcertController@index")->name("concerts");
//Add or delete from favorites
Route::post('/concert/{slug}/favorites', 'ConcertController@favorites')->name('concert-favorites');
//Display details
Route::get('/concert/{slug}', "ConcertController@details")->name("concert-details");
//
Route::post('/concert/new', 'ConcertController@new')->name('concert-new');
//Display and buy
Route::get('/concert/{slug}/payment-form', 'ConcertController@displayPayment')->name('concert-display-payment');
Route::post('/concert/{slug}/payment', 'ConcertController@payment')->name('concert-payment');


