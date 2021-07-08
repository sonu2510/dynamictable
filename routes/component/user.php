<?php

Route::group(['namespace' => 'Admin\UserManagement', 'middleware' => ['auth']], function () {
    Route::get('/userslist', 'UserController@index')->name('users');
	Route::get('/userslist/datatable/ajax', 'UserController@indexDatatable')->name('users.show');
	Route::get('/users/new', 'UserController@Create')->name('users.new');
	Route::post('/user/save', 'UserController@SaveUserdata')->name('users.save');
	Route::get('/EditUser/{userid}', 'UserController@Edit')->name('users.edit');
		
});
