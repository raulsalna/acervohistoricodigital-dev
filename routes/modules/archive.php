<?php

Route::group(['middleware' => ['auth:api']], function () {

    Route::resource('archive', 'ArchiveController');
    Route::get('archive/listAndFilterArchives/{busqueda}', 'ArchiveController@listAndFilterArchive')->name('listAndFilterArchive');
    Route::post('importExcel','ArchiveController@importExcel');
   //Route::post('archive/importExcel','ArchiveController@importExcel');
   // Route::post('importExcel','ArchiveController@importExcel');



});
