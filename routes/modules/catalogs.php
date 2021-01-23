<?php

Route::group(['middleware' => 'auth:api'], function () {
    // Cat index
    Route::get('index_cat_documentary_tradition', 'CatController@index_cat_documentary_tradition');
    Route::get('index_cat_physical_characteristics', 'CatController@index_cat_physical_characteristics');
    Route::get('index_cat_transaction_type', 'CatController@index_cat_transaction_type');
    Route::get('index_cat_producer', 'CatController@index_cat_producer');
    Route::get('index_cat_support', 'CatController@index_cat_support');
    Route::get('index_cat_idioms', 'CatController@index_cat_idioms');
    Route::get('index_cat_box', 'CatController@index_cat_box');
    Route::get('index_cat_files', 'CatController@index_cat_files');
    Route::get('index_cat_documentary_group', 'CatController@index_cat_documentary_group');
    // Cat index
    // Post Cats    
    Route::post('store_cat_documentary_tradition', 'CatController@store_cat_documentary_tradition');
    Route::post('store_cat_physical_characteristics', 'CatController@store_cat_physical_characteristics');
    Route::post('store_cat_transaction_type', 'CatController@store_cat_transaction_type');
    Route::post('store_cat_producer', 'CatController@store_cat_producer');
    Route::post('store_cat_support', 'CatController@store_cat_support');
    Route::post('store_cat_idioms', 'CatController@store_cat_idioms');
    Route::post('store_cat_box', 'CatController@store_cat_box');
    Route::post('store_cat_files', 'CatController@store_cat_files');
    Route::post('store_cat_documentary_group', 'CatController@store_cat_documentary_group');
    // Post Cats    
    // Update Cats        
    Route::put('update_cat_documentary_tradition/{sample}', 'CatController@update_cat_documentary_tradition');
    Route::put('update_cat_physical_characteristics/{sample}', 'CatController@update_cat_physical_characteristics');
    Route::put('update_cat_transaction_type/{sample}', 'CatController@update_cat_transaction_type');
    Route::put('update_cat_producer/{sample}', 'CatController@update_cat_producer');
    Route::put('update_cat_support/{sample}', 'CatController@update_cat_support');
    Route::put('update_cat_idioms/{sample}', 'CatController@update_cat_idioms');
    Route::put('update_cat_box/{sample}', 'CatController@update_cat_box');
    Route::put('update_cat_files/{sample}', 'CatController@update_cat_files');
    Route::put('update_cat_documentary_group/{sample}', 'CatController@update_cat_documentary_group');
    // Update Cats    
    // Delete Cats
    Route::delete('delete_cat_documentary_tradition/{id}', 'CatController@delete_cat_documentary_tradition');
    Route::delete('delete_cat_physical_characteristics/{id}', 'CatController@delete_cat_physical_characteristics');
    Route::delete('delete_cat_transaction_type/{id}', 'CatController@delete_cat_transaction_type');
    Route::delete('delete_cat_producer/{id}', 'CatController@delete_cat_producer');
    Route::delete('delete_cat_support/{id}', 'CatController@delete_cat_support');
    Route::delete('delete_cat_idioms/{id}', 'CatController@delete_cat_idioms');
    Route::delete('delete_cat_box/{id}', 'CatController@delete_cat_box');
    Route::delete('delete_cat_files/{id}', 'CatController@delete_cat_files');
    Route::delete('delete_cat_documentary_group/{id}', 'CatController@delete_cat_documentary_group');
    // Delete Cats
});
