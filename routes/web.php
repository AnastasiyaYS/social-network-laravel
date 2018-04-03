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
use App\Http\Middleware\CheckValueGender;

Route::get('/', function () {
    if(!Auth::id()) return view('welcome');
    else return redirect()->route('profile.index');
});

Auth::routes();

Route::get('profile', 'HomeController@index')->name('profile.index');

Route::get('profile/edit', 'HomeController@edit')->name('profile.edit');

Route::get('profile/edit/university/{id}/destroy', 'HomeController@universityDestroy')->name('university.destroy');

Route::post('profile/update', 'HomeController@update')->name('profile.update')->middleware(CheckValueGender::class);

Route::get('search', 'SearchController@index')->name('search');

Route::post('search', 'SearchController@index')->name('search');

Route::get('search/show_user/{id}', 'SearchController@show')->name('search.showUser');

Route::get('friends', 'FriendsController@index')->name('friends');

Route::get('add_friend/{id}', 'FriendsController@add_friend')->name('add_friend');

Route::get('confirm_friend/{id}', 'FriendsController@confirm_friend')->name('confirm_friend');



Route::get('messages', 'MessagesController@index')->name('messages');