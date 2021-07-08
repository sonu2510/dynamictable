<?php

Route::group(['namespace' => 'Admin\Permission', 'middleware' => ['auth']], function () {
    Route::get('/usersdata', 'Userpermissioncontroller@index')->name('permission');
	Route::get('/usersdata/datatable/ajax', 'Userpermissioncontroller@indexDatatable')->name('permission.show');
	Route::get('permission/{user_id}', 'Userpermissioncontroller@Edit')->name('user.permission');
	Route::Post('/permission/save', 'Userpermissioncontroller@SavePermission')->name('permission.save');

	
	
});
