<?php

Route::group(['namespace' => 'Admin\UserManagement', 'middleware' => ['auth']], function () {
    Route::get('/dynamictable', 'TableController@index')->name('dynamictable');
	Route::get('/dynamictable/datatable/ajax', 'TableController@indexDatatable')->name('dynamictable.show');
	Route::get('/dynamictable/tablecolumndata/ajax', 'TableController@tablecolumndata')->name('dynamictable.show');
	Route::get('/dynamictable/new', 'TableController@Create')->name('dynamictable.new');
	Route::post('/dynamictable/save', 'TableController@Save')->name('dynamictable.save');
	Route::post('/dynamictable/save', 'TableController@Save')->name('dynamictable.save');
	Route::get('/dynamictable/edit/{userid}', 'TableController@Edit')->name('dynamictable.edit');
	Route::get('/dynamictable/delete/{userid}', 'TableController@getDelete')->name('dynamictable.delete');

	Route::get('/GetaddedColumnData/ajax', 'TableController@GetaddedColumnData');
	Route::get('/GetColumnType/ajax', 'TableController@GetColumnType');
	Route::get('/delete_ColumnData/ajax', 'TableController@delete_ColumnData');
		
});