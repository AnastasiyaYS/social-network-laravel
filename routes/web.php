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

Auth::routes();

Route::get('users', 'HomeController@index')->name('users.index');

Route::get('users/edit', 'HomeController@edit')->name('users.edit');

Route::get('search', 'SearchController@index')->name('search');

Route::get('friends', 'FriendsController@index')->name('friends');

Route::get('messages', 'MessagesController@index')->name('messages');