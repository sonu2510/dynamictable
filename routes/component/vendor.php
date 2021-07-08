<?php

Route::group(['namespace' => 'Admin\Vendor', 'middleware' => ['auth']], function () {
    Route::get('/supplier', 'Vendor_controller@index')->name('supplier');
	Route::get('/supplier/datatable/ajax', 'Vendor_controller@indexDatatable')->name('supplier.show');
	Route::get('/supplier/new', 'Vendor_controller@create')->name('supplier.show');
	Route::post('/supplier/save', 'Vendor_controller@Save')->name('supplier.save');
	Route::get('/supplier/edit/{vendor_id}', 'Vendor_controller@Edit');
	Route::get('/supplier/delete/{vendor_id}', 'Vendor_controller@getDelete');
	
});
