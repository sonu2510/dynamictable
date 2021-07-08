<?php

Route::group(['namespace' => 'Admin\RawMaterial', 'middleware' => ['auth']], function () {
    Route::get('/coildetail', 'CoilDetails_Controller@index')->name('coildetail');
	Route::get('/coildetail/datatable/ajax', 'CoilDetails_Controller@indexDatatable')->name('coildetail.show');
	Route::get('/coildetail/new', 'CoilDetails_Controller@create')->name('coildetail.show');
	Route::post('/coildetail/save', 'CoilDetails_Controller@Save')->name('coildetail.save');
	Route::get('/coildetail/edit/{coil_id}', 'CoilDetails_Controller@Edit');
	Route::get('/coildetail/delete/{coil_id}', 'CoilDetails_Controller@getDelete');
	
});
