<?php

Route::group(['namespace' => 'Admin\RawMaterial', 'middleware' => ['auth']], function () {
    Route::get('/ballsize', 'BallDiameter_Controller@index')->name('ballsize');
	Route::get('/ballsize/datatable/ajax', 'BallDiameter_Controller@indexDatatable')->name('ballsize.show');
	Route::get('/ballsize/new', 'BallDiameter_Controller@create')->name('ballsize.show');
	Route::post('/ballsize/save', 'BallDiameter_Controller@Save')->name('ballsize.save');
	Route::get('/ballsize/edit/{ballsize_id}', 'BallDiameter_Controller@Edit');
	Route::get('/ballsize/delete/{ballsize_id}', 'BallDiameter_Controller@getDelete');
	
});
