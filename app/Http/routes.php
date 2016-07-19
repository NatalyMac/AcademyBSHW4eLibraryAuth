<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::auth();

Route::get('/socialite/{provider}', ['as' => 'socialite.auth',
        function ( $provider ) {
            return \Socialite::driver( $provider )->redirect();}
    ]
);

Route::get('/socialite/{provider}/callback', function ($provider) {
    $user = \Socialite::driver($provider)->user();
    dd($user);
});

Route::resource('users', 'UserController');
Route::resource('books', 'BookController');

Route::resource('books.users', 'LendController' , ['only'=>['create', 'store', 'update']]);
Route::resource('users.books', 'LendController', ['only'=>['update']]);

