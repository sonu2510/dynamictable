<?php

Route::group(['namespace' => 'Admin\Production', 'middleware' => ['auth']], function () {
    Route::get('/ht_process', 'HTProcessMonitoringController@index')->name('ht_process');
	Route::get('/ht_process/datatable/ajax', 'HTProcessMonitoringController@indexDatatable')->name('ht_process.show');
	Route::get('/ht_process/new', 'HTProcessMonitoringController@create')->name('ht_process.show');
	Route::post('/ht_process/save', 'HTProcessMonitoringController@Save')->name('ht_process.save');
	Route::get('/ht_process/edit/{heading_id}', 'HTProcessMonitoringController@Edit');
	Route::get('/ht_process/delete/{heading_id}', 'HTProcessMonitoringController@getDelete');



	
	
});
