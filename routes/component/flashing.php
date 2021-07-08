<?php

Route::group(['namespace' => 'Admin\Production', 'middleware' => ['auth']], function () {
    Route::get('/flashing', 'FlashingController@index')->name('flashing');
	Route::get('/flashing/datatable/ajax', 'FlashingController@indexDatatable')->name('flashing.show');
	Route::get('/flashing/new', 'FlashingController@create')->name('flashing.show');
	Route::post('/flashing/save', 'FlashingController@Save')->name('flashing.save');
	Route::get('/flashing/edit/{flashing_id}', 'FlashingController@Edit');
	Route::get('/flashing/delete/{flashing_id}', 'FlashingController@getDelete');
	Route::get('/flashingBatchData/ajax', 'FlashingController@getFlashingBatchData');
	
	
	Route::get('/flashingObservationData/ajax', 'FlashingController@getflashingObservationData');
	Route::get('/delete_flashingobservation/ajax', 'FlashingController@getflashingObservationDelete');
	Route::get('/getMasterBatch/ajax', 'FlashingController@getMasterBatchData');
	
	
});
