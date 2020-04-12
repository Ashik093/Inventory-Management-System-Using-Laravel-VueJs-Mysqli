<?php
Route::group([
	'middleware'=>'api',
    'prefix' => 'auth'

], function ($router) {
	Route::post('signup','AuthController@signup');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

//employeecontroller
Route::apiResource('/employee','Api\EmployeeController');
//suppliercontroller
Route::apiResource('/supplier','Api\SupplierController');
//category
Route::apiResource('/category','Api\CategoryController');
//product
Route::apiResource('/product','Api\ProductController');
//expense
Route::apiResource('/expense','Api\ExpenseController');
