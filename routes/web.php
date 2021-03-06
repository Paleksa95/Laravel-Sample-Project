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

//Index route.
Route::get('/', function () {
    return view('pages.index');
})->name('startingPage');

//Thread routes.
Route::prefix('thread/create')->group(function () {

Route::get('/', 'ThreadController@displayForm');
Route::post('/', 'ThreadController@submitThread')->name('submitThread');

});
Route::prefix('/thread')->group(function () {
Route::get('/display', 'ThreadController@displayAllThreads');
Route::get('/display/{id}', 'ThreadController@displayOneThread')->name('viewThread');
Route::get('/edit/{id}', 'ThreadController@getThread');
Route::post('/edit/', 'ThreadController@editThread')->name('editThread');
});

//Message routes
Route::post('message/create', 'MessageController@submitMessage')->name('submitMessage')->middleware('auth');

Route::prefix('/message/edit')->group(function () {
Route::get('/{id}', 'MessageController@getMessage');
Route::post('','MessageController@editMessage')->name('editMessage');
});

Route::prefix('message/approve')->group(function () {
Route::get('/', 'MessageController@DisplayAllNotApprovedMessages');
Route::post('/', 'MessageController@approveMessage')->name('approveMessage');
});


//User routes.
Route::middleware(['admin'])->prefix('users')->group(function () {

    Route::get('/', 'UserController@displayAllUsers');
    Route::post('/update','UserController@updateUser')->name('updateUser');

});

//Registration and verifying e-mails.
Route::get('verifyEmail', 'Auth\RegisterController@verifyEmail')->name('verify');
Route::get('verifyEmail/{verifyToken}', 'Auth\RegisterController@verifyToken');

//Default Auth routes.
Auth::routes();

//Default home/dashboard route.
Route::get('/home', 'HomeController@index')->name('home');
