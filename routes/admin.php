<?php

use App\TicketTemplate;
Route::middleware("admin.access")->group(function () {

    Route::get('/', 'IndexController@index');
    Route::resource('reviews', 'ReviewController');
    Route::get('/clear', function () {
        Log::debug('CLEARED');
        Artisan::call('cache:clear');
        return redirect('/admin');
    });
    Route::prefix('payments')->group(function () {
        Route::get('/', 'PaymentController@index');
    });
    Route::prefix('parser')->group(function () {
        Route::get('/leagues', 'ParserController@leagues');
        Route::any('/matchesByLeagueId', 'ParserController@matchesByLeagueId');
        Route::any('/betsByMatchId', 'ParserController@betsByMatchId');
    });
    Route::prefix('user')->group(function () {
        Route::get('/', 'UserController@index')->name('users');
        // CREATE
        Route::get('/create', 'UserController@create')->name('user.create');
        Route::post('/create', 'UserController@store')->name('user.save');
        //Balance
        Route::post('/balance_replenish', 'UserController@balanceReplenish')->name('user.balance_replenish');
        Route::post('/balance_reduce', 'UserController@balanceReduce')->name('user.balance_reduce');
        Route::post('/tournament_participant', 'UserController@tournamentParticipant')->name('user.tournamentParticipant');

        Route::get('/{id}/edit', ['as' => 'user.edit', 'uses' => 'UserController@edit_user']);
        Route::get('/{id}/replenish', ['as' => 'user.edit', 'uses' => 'UserController@replenish_user']);
        Route::get('{id}/takeaway', ['as' => 'user.edit', 'uses' => 'UserController@takeaway_user']);
        Route::get('/admin/user/{id}/ban', 'AdminController@ban_user');
        //DELETE
        Route::get('/{user}/delete', 'UserController@destroy')->name('user.delete');
    });
    Route::prefix('news')->group(function () {
        Route::get('/', 'NewsController@index')->name('news');
        Route::get('/create', 'NewsController@create')->name('news.create');
        Route::post('/', 'NewsController@store')->name('news.store');
        Route::get('/{id}/edit', 'NewsController@edit')->name('news.edit');
        Route::post('{id}', 'NewsController@update')->name('news.update');
        Route::get('{id}/delete', 'NewsController@destroy')->name('news.delete');
    });
    Route::prefix('/tournaments')->group(function () {
        Route::get('/', 'TournamentController@index')->name('tournaments');
        Route::post('/', 'TournamentController@store')->name('tournaments.store');
        Route::get('/create', 'TournamentController@create')->name('tournaments.create');
        Route::post('{id}', 'TournamentController@update')->name('tournaments.update');

        Route::get('/test', 'TournamentController@test');

        Route::get('/{id}/edit', 'TournamentController@edit')->name('tournaments.edit');
        Route::get('{id}/delete', 'TournamentController@destroy')->name('tournaments.delete');
    });
    Route::prefix('games')->group(function () {
        Route::post('/parse', 'GameController@parse')->name('matches.parse');
        Route::get('/', 'GameController@index')->name('matches');
        //Create
        Route::post('/', 'GameController@store')->name('matches.store');
        Route::get('/create', 'GameController@create')->name('matches.create');

        // DELETE
        Route::get('{id}/delete', 'GameController@destroy')->name('matches.delete');
    });
// TICKETS
    Route::prefix('/tickets')->group(function () {
        Route::get('/new', 'TicketController@new');
        Route::get('/in_process', 'TicketController@in_process');

        Route::post('/update/{id}', 'TicketController@update');
        Route::get('/edit/{id}', 'TicketController@edit');
        Route::get('/show/{id}', 'TicketController@show');
        Route::get('/history/{id}', 'TicketController@history');
        Route::post('/bulk_delete', 'TicketController@deleteAll');
        Route::get('/delete/{id}', 'TicketController@delete');
        Route::post('/answer/{id}', 'TicketController@store');
        Route::post('/answer', 'TicketController@store');
        Route::get('/create', 'TicketController@create');


        Route::get('/get_patterns/{id}', function ($id) {
            return view('admin.tickets.pattern_list', ['templates' => TicketTemplate::where('ticket_category_id', $id)->get()]);
        });
        Route::get('/get_patterns', function () {
            return view('admin.tickets.pattern_list', ['templates' => TicketTemplate::all()]);
        });

        Route::get('/pattern/{id}', function ($id) {
            return TicketTemplate::findOrfail($id)->text;
        });

        Route::namespace('Tickets')->group(function () {
            Route::resource('categories', 'CategoryController', ['except' => ['show', 'update']]);
            Route::post('categories/{id}', 'CategoryController@update');
            Route::get('categories/{id}/delete', 'CategoryController@delete');
            Route::post('categories/{id}/destroy', 'CategoryController@destroy');
            Route::resource('templates', 'TemplateController', ['except' => ['show', 'update']]);
            Route::post('templates/{id}', 'TemplateController@update');
            Route::get('templates/{id}/delete', 'TemplateController@delete');
            Route::post('templates/{id}/destroy', 'TemplateController@destroy');
        });
    });
// Withdraw
    Route::prefix('withdraw')->group(function () {
        Route::get('/', 'WithdrawController@index')->name('withdraw');
        Route::get('/{id}/edit', 'WithdrawController@edit')->name('withdraw.edit');

        Route::post('/save', 'WithdrawController@save')->name('withdraw.save');
    });
//Settings
    Route::prefix('settings')->group(function () {
        Route::get('/', 'SettingsController@index');
        Route::post('/save', 'SettingsController@save');
    });

});
