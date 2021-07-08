<?php

Route::group(['namespace' => 'Admin\RawMaterial', 'middleware' => ['auth']], function () {
    Route::get('/processed_coil', 'ProcessedCoil_Controller@index')->name('processed_coil');
	Route::get('/processed_coil/datatable/ajax', 'ProcessedCoil_Controller@indexDatatable')->name('processed_coil.show');
	Route::get('/processed_coil/new', 'ProcessedCoil_Controller@create')->name('processed_coil.show');
	Route::post('/processed_coil/save', 'ProcessedCoil_Controller@Save')->name('processed_coil.save');
	Route::get('/processed_coil/edit/{coil_id}', 'ProcessedCoil_Controller@Edit');
	Route::get('/processed_coil/delete/{coil_id}', 'ProcessedCoil_Controller@getDelete');
	
});
