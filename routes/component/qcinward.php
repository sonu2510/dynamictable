<?php

Route::group(['namespace' => 'Admin\RawMaterial', 'middleware' => ['auth']], function () {
    Route::get('/qcinward_report', 'Qcinward_Controller@index')->name('inward');
	Route::get('/qcinward/datatable/ajax', 'Qcinward_Controller@indexDatatable')->name('inward.show');	
	Route::post('/qcinward/save', 'Qcinward_Controller@Save')->name('inward.save');
	Route::get('/qcinward/edit/{inward_id}', 'Qcinward_Controller@Edit');

	
});
