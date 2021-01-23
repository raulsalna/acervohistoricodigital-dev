<?php

Route::group(['middleware' => ['auth:api']], function () {


  //Box
  Route::resource('box', 'BoxController');
  Route::get('box/listAndFilterBox/{busqueda}', 'BoxController@listAndFilterBox')->name('listAndFilterBox');
});
