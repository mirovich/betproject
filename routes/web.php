<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

//URL::forceScheme('http');

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

Route::namespace('Frontend')->group(function () {
    Route::get('/', 'IndexController@index')->name('home');
    Route::get('/faq', 'IndexController@faq')->name('faq');
    Route::get('/help', 'IndexController@help')->name('help');
    Route::get('/bonus', 'IndexController@bonus')->name('bonus');
    Route::get('/terms', 'IndexController@terms')->name('terms');
    Route::get('/privacy', 'IndexController@privacy')->name('privacy');
    Route::get("/tickets", "IndexController@ticket")->name("tickets");
    Route::post("/tickets", "IndexController@ticket_post")->name("post_ticket");

    Route::prefix('/profile')->group(function () {
        Route::get('/', 'ProfileController@index');

        Route::get('partner', 'ProfileController@partner')->name('profile-partner');
//        Route::get('partner/get-link', 'ProfileController@link')->name('profile-partner-get-link');

        Route::get('finance', 'ProfileController@finance')->name('profile-finance');
    });

    Route::get('/locale/{locale}', 'LocaleController')->name('locale');

    Route::get('/GetTournaments', 'TournamentController@getAll');
    Route::get('/GetTournamentInfo/{id}', 'TournamentController@getInfo');

    Route::get('/tournaments', 'TournamentController@active');
    Route::get('/tournaments/{tournament}', 'TournamentController@show')->name("show_tournament");
    Route::get('/tournamentsOver', 'TournamentController@over');

    Route::post("/payment","PaymentController@pay_in")->name("pay_post");
    Route::post("/payment/result","PaymentController@result");
});
Route::get("/logout", "Auth\LoginController@logout");
Auth::routes();
