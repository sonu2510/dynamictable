<?php

Route::group(['namespace' => 'Admin\RawMaterial', 'middleware' => ['auth']], function () {
    Route::get('/machine_master', 'MachineMaster_Controller@index')->name('machine_master');
	Route::get('/machine_master/datatable/ajax', 'MachineMaster_Controller@indexDatatable')->name('machine_master.show');
	Route::get('/machine_master/new', 'MachineMaster_Controller@create')->name('machine_master.show');
	Route::post('/machine_master/save', 'MachineMaster_Controller@Save')->name('machine_master.save');
	Route::get('/machine_master/edit/{machine_master_id}', 'MachineMaster_Controller@Edit');
	Route::get('/machine_master/delete/{machine_master_id}', 'MachineMaster_Controller@getDelete');
	
});
