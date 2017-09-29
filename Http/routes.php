<?php
Route::group(['middleware' => ['web'], 'namespace' => 'Modules\Core\Http\Controllers'], function() {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

});

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth'], 'namespace' => 'Modules\Core\Http\Controllers'], function() {

    Route::get('/', 'IndexController@index')->name('admin.index');
    Route::post('/images/upload', 'ImagesController@upload');
    Route::get('/images/files_list', 'ImagesController@files_list');
    Route::delete('/images/destroy/{id}', 'ImagesController@destroy');
    Route::post('/images/sort', 'ImagesController@sort');

    Route::post('/sort', 'SortController@index');

    Route::resource('/settings', 'SettingsController');

    Route::resource('/users', 'UsersController');
    Route::resource('/modules', 'ModulesController');
});