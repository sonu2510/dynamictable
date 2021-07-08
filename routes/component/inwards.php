<?php

Route::group(['namespace' => 'Admin\RawMaterial', 'middleware' => ['auth']], function () {
    Route::get('/inward', 'InwardsController@index')->name('inward');
	Route::get('/inward/datatable/ajax', 'InwardsController@indexDatatable')->name('inward.show');
	Route::get('/inward/new', 'InwardsController@create')->name('inward.show');
	Route::post('/inward/save', 'InwardsController@Save')->name('inward.save');
	Route::get('/inward/edit/{inward_id}', 'InwardsController@Edit');
	Route::get('/inward/delete/{inward_id}', 'InwardsController@getDelete');
	Route::get('/coilinwarddata/ajax/', 'InwardsController@getCoilinwardDetails');
	Route::get('/delete_coilinwarddata/ajax/', 'InwardsController@getCoildetailsDelete');
	Route::get('/coilspbplno/ajax/', 'InwardsController@getCoilSpblpnumber');

	//Inwards Under Processing

	Route::get('/inward_underprocess', 'InwardsController@indexUnderProcess')->name('inward_underprocess.new');
	Route::get('/inward_underprocess/new', 'InwardsController@createUnderProcessing')->name('inward_underprocess');
	Route::get('/inward_underprocess/datatable/ajax', 'InwardsController@indexUnderProcessDatatable')->name('inward_underprocess.show');
	Route::get('/finished/datatable/ajax', 'InwardsController@finishedProcessDatatable')->name('inward_underprocess.show');

	Route::get('/getSpbpl/ajax/', 'InwardsController@getCoilSpbplNo')->name('inward_underprocess.show');
	Route::get('/inward_underprocess/edit/{inward_id}', 'InwardsController@EditUnderprocessing');		
	Route::post('/inward_underprocess/save', 'InwardsController@Save_ProcessedCoil')->name('inward_underprocess.save');
	Route::get('/delete_split_coilinwarddata/ajax/', 'InwardsController@getsplitCoilDelete');
	Route::get('/getSpbplCoilWeight/ajax/', 'InwardsController@getSpbplCoilWeight');

	//Inwards Under Processing END

	//Finished Wire (Stock)
	Route::get('/finished_stock', 'InwardsController@indexFinishedstock')->name('finished_stock');
	Route::get('/finished_stock/datatable/ajax', 'InwardsController@indexFinishedstockDatatable')->name('finished_stock.show');
	
	Route::get('/sapp_stock', 'InwardsController@indexSappstock')->name('sapp_stock');
	Route::get('/sapp_stock/datatable/ajax', 'InwardsController@indexSappstockDatatable')->name('sapp_stock.show');
	/*Route::get('/finished_stock/edit/{inward_id}', 'InwardsController@ViewFinishedStock');	
	Route::get('/finished_stock/datatable/ajax', 'InwardsController@indexFinishedstockDatatable')->name('finished_stock.show');*/

	//Finished Wire (Stock) END

	
});
