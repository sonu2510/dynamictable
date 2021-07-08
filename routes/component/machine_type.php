  <?php

Route::group(['namespace' => 'Admin\RawMaterial', 'middleware' => ['auth']], function () {
    Route::get('/machine_type', 'MachineType_Controller@index')->name('machine_type');
	Route::get('/machine_type/datatable/ajax', 'MachineType_Controller@indexDatatable')->name('machine_type.show');
	Route::get('/machine_type/new', 'MachineType_Controller@create')->name('machine_type.show');
	Route::post('/machine_type/save', 'MachineType_Controller@Save')->name('machine_type.save');
	Route::get('/machine_type/edit/{machine_type_id}', 'MachineType_Controller@Edit');
	Route::get('/machine_type/delete/{machine_type_id}', 'MachineType_Controller@getDelete');
	
});
