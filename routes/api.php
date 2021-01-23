<?php
//Rutas Generales
Route::post('login', 'LoginController@login')->name('login');
Route::post('logout', 'LoginController@logout');
Route::group(['middleware' => ['auth:api']], function () {

    // Obtiene la información de un usuario
    Route::get('user/{id}', 'LoginController@user');

    // Catálogos

    Route::get('profiles', 'CatController@Cat_profiles');
    Route::get('user_representations', 'CatController@user_representations');
    Route::post('user_revised', 'CatController@user_revised');
    Route::get('modules', 'CatController@Cat_modules');
    //Route::post('importExcel','ArchiveController@importExcel');


 ////// Conección con Intgra
    Route::prefix('intgra')->group(function () {
        Route::post('getUser','Administrador\UsersController@getUser');
        // Route::get('listAndFilterUsers/{busqueda}', 'Administrador\UsersController@listAndFilterUsers')->name('listAndFilterUsers');
});
/////////////////////////////////

    // Agrega la trazabilidad de un usuario
    Route::post('transaction', 'TransactionsController@store');
    Route::get('count-registers', 'GeneralController@getCountRegisters');


});




