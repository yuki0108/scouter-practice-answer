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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// ログインしていないユーザーはすべてログイン画面に遷移
Route::group(['middleware' => ['auth']], function(){
    Route::get('/' , 'HomeController@index' );
    Route::get('/home' , 'HomeController@index' );
    Route::get('/reservations/create' , 'ReservationController@create' )
        ->name('reservations.create');
    Route::post('/reservations/store' , 'ReservationController@store' )
        ->name('reservations.store');
    Route::get('/reservations/approve/{id}', 'ReservationController@approve')
        ->name('reservations.approve');
    Route::get('/reservations/reject/{id}', 'ReservationController@reject')
        ->name('reservations.reject');

    Route::get('/rooms/index' , 'MeetingRoomController@index' )
        ->name('rooms.index');
    Route::get('/rooms/create' , 'MeetingRoomController@create' )
        ->name('rooms.create');
    Route::post('/rooms/store' , 'MeetingRoomController@store' )
        ->name('rooms.store');
    Route::get('/rooms/edit/{id}', 'MeetingRoomController@edit')
        ->name('rooms.edit');
    Route::put('/rooms/update', 'MeetingRoomController@update')
        ->name('rooms.update');
    Route::get('/rooms/delete/{id}', 'MeetingRoomController@delete')
        ->name('rooms.delete');

    Route::get('/users/index' , 'UserController@index' )
        ->name('users.index');
    Route::post('/users/index' , 'UserController@search' )
        ->name('users.search');
    Route::get('/users/show/{id}' , 'UserController@show' )
        ->name('users.show');
    Route::get('/users/edit/{id}', 'UserController@edit')
        ->name('users.edit');
    Route::put('/users/update', 'UserController@update')
        ->name('users.update');

    Route::get('/items/create' , 'ItemController@create' )
        ->name('items.create');
    Route::post('/items/store' , 'ItemController@store' )
        ->name('items.store');
});

// ユーザー一覧の取得
Route::get('/user', 'UserController@index');

