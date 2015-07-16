<?php

Route::group(['namespace' => 'Sun\Http\Controllers'], function () {

    Route::get('/auth/login', 'AuthController@getLogin');
    Route::post('/auth/login', 'AuthController@postLogin');

    Route::get('/auth/register', 'AuthController@getRegister');
    Route::post('/auth/register', 'AuthController@postRegister');

    Route::get('/auth/email/confirm/{code}', 'AuthController@getEmailConfirm');
    Route::get('/auth/reset/confirm/{code}', 'AuthController@getResetConfirm');

    Route::get('/auth/reset', 'AuthController@getReset');
    Route::post('/auth/reset', 'AuthController@postReset');

    Route::get('/auth/logout', 'AuthController@getLogout');

});
