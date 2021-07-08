<?php

Route::group(['namespace' => 'Admin\Production', 'middleware' => ['auth']], function () {
    Route::get('/heading', 'HeadingController@index')->name('heading');
	Route::get('/heading/datatable/ajax', 'HeadingController@indexDatatable')->name('heading.show');
	Route::get('/heading/new', 'HeadingController@create')->name('heading.show');
	Route::post('/heading/save', 'HeadingController@Save')->name('heading.save');
	Route::get('/heading/edit/{heading_id}', 'HeadingController@Edit');
	Route::get('/heading/delete/{heading_id}', 'HeadingController@getDelete');
	Route::get('/getSplitcoils/ajax', 'HeadingController@getSplitcoils');
	Route::get('/HeadingObservationData/ajax', 'HeadingController@getHeadingObservationData');
	Route::get('/HeadingWireData/ajax', 'HeadingController@getHeadingWireData');
	Route::get('/HeadingBatchData/ajax', 'HeadingController@getHeadingBatchData');

	Route::get('/delete_headingwire/ajax/', 'HeadingController@getHeadingWireDelete');
	Route::get('/delete_headingbatch/ajax/', 'HeadingController@getHeadingbatchDelete');
	Route::get('/delete_headingobservation/ajax/', 'HeadingController@getHeadingObservationDelete');
	
	
});
