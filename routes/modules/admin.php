<?php

// Rutas para el modulo de administración

use App\Http\Controllers\Administrador\UsersController;

Route::group(['middleware' => 'auth:api'], function () {

    Route::resource('users', 'Administrador\UsersController');
    Route::get('users/listAndFilterUsers/{busqueda}', 'Administrador\UsersController@listAndFilterUsers')->name('listAndFilterUsers');
//    Route::get('users/reports/get-registers', 'UsersController@downloadRegistersReport');


});
