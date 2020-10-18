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
//Display the edit form for users
Route::get('/user/{id}/edit', 'UserController@displayEdit')->name('user-edit-form');
//Route to update the user
Route::post('/user/{id}/update', 'UserController@update')->name('user-update');

// Route::get('/home', 'HomeController@index')->name('home');