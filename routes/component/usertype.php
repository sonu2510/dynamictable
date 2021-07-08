<?php

Route::group(['namespace' => 'Admin\UserManagement', 'middleware' => ['auth']], function () {
    Route::get('/usertype', 'UsertypeController@index')->name('usertype');
	Route::get('/usertype/datatable/ajax', 'UsertypeController@indexDatatable')->name('usertype.show');
	Route::get('/usertype/new', 'UsertypeController@create')->name('usertype.show');
	Route::post('/usertype/save', 'UsertypeController@Save')->name('usertype.save');
	Route::get('/usertype/edit/{user_type_id}', 'UsertypeController@Edit');
	Route::get('/usertype/delete/{user_type_id}', 'UsertypeController@getDelete');
	
});
