<?php

Route::group(['namespace' => 'Admin\Production', 'middleware' => ['auth']], function () {
    Route::get('/production_stock', 'StockController@index')->name('production_stock');
	Route::get('/production_stock/datatable/ajax', 'StockController@indexDatatable')->name('production_stock.show');
	
	
});
