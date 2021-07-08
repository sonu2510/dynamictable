<?php

Route::group(['namespace' => 'Admin\Production', 'middleware' => ['auth']], function () {
    Route::get('/lapping', 'LappingController@index')->name('lapping');
	Route::get('/lapping/datatable/ajax', 'LappingController@indexDatatable')->name('lapping.show');
	Route::get('/lapping/new', 'LappingController@create')->name('lapping.show');
	Route::post('/lapping/save', 'LappingController@Save')->name('lapping.save');
	Route::get('/lapping/edit/{lapping_id}', 'LappingController@Edit');
	Route::get('/lapping/delete/{lapping_id}', 'LappingController@getDelete');
	
	Route::get('/lappingData/ajax', 'LappingController@getlappingData');
	Route::get('/delete_lappingobservation/ajax', 'LappingController@getlappingObsCountDelete');
	Route::get('/delete_lappingdata/ajax', 'LappingController@getlappingDataDelete');
	Route::get('/getBallSpecification/ajax', 'LappingController@getBallSpecificationData');
	Route::get('/getBallMasterData/ajax', 'LappingController@getBallMasterData');
	
	
});
