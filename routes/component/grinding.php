<?php

Route::group(['namespace' => 'Admin\Production', 'middleware' => ['auth']], function () {
    Route::get('/grinding', 'GrindingController@index')->name('grinding');
	Route::get('/grinding/datatable/ajax', 'GrindingController@indexDatatable')->name('grinding.show');
	Route::get('/grinding/new', 'GrindingController@create')->name('grinding.show');
	Route::post('/grinding/save', 'GrindingController@Save')->name('grinding.save');
	Route::get('/grinding/edit/{grinding_id}', 'GrindingController@Edit');
	Route::get('/grinding/delete/{grinding_id}', 'GrindingController@getDelete');
	
	Route::get('/grindingObservationData/ajax', 'GrindingController@getgrindingObservationData');
	Route::get('/getBallMasterData/ajax', 'GrindingController@getBallMasterData');
	Route::get('/delete_grindingobservation/ajax', 'GrindingController@getgrindingObservationDelete');
	
	
});
