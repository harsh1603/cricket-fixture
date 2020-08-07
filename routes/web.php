<?php

Route::get('/', 'WebController@index')->name('homepage');
Route::get('/teams', 'WebController@teams')->name('teams');
Route::get('/player/{id}', 'WebController@teamPlayer')->name('player');
Route::get('/match', 'WebController@teammatch')->name('match');
Route::get('/points', 'WebController@points')->name('points');

Route::redirect('/adminlogin', '/cricketfixture/login')->name('adminlogin');

Route::redirect('/home', '/cricketfixture/admin');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('products', 'ProductsController');

    Route::get('teams', 'TeamController@index')->name('teams.index');
    Route::get('/teams/add', 'TeamController@create')->name('teams.add');
    Route::get('/teams/edit/{id}', 'TeamController@edit')->name('teams.edit');
    Route::post('/teams/store', 'TeamController@store')->name('teams.store');
    Route::post('/teams/{id}', 'TeamController@update')->name('teams.update');
    Route::get('/teams/delete', 'TeamController@destroy')->name('teams.deletes');

    Route::get('player', 'PlayerController@index')->name('player.index');
    Route::get('/player/add', 'PlayerController@create')->name('player.add');
    Route::get('/player/edit/{id}', 'PlayerController@edit')->name('player.edit');
    Route::post('/player/store', 'PlayerController@store')->name('player.store');
    Route::post('/player/{id}', 'PlayerController@update')->name('player.update');
    Route::get('/player/delete', 'PlayerController@destroy')->name('player.deletes');

    Route::get('match', 'MatchController@index')->name('match.index');
    Route::get('/match/add', 'MatchController@create')->name('match.add');
    Route::get('/match/edit/{id}', 'MatchController@edit')->name('match.edit');
    Route::post('/match/store', 'MatchController@store')->name('match.store');
    Route::post('/match/{id}', 'MatchController@update')->name('match.update');
    Route::get('/match/delete', 'MatchController@destroy')->name('match.deletes');
  
});
