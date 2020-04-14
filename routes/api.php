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
Route::Get('/today-expense','Api\ExpenseController@dailyExpense');
Route::Get('/monthly-expense','Api\ExpenseController@monthlyExpense');
//salary
Route::Post('/give-salary','Api\SalaryController@pay');
Route::Get('/all-salary','Api\SalaryController@index');
Route::Get('/view-monthly-salary/{month}/{year}','Api\SalaryController@monthlySalary');
//stock
Route::Patch('/product-stock-update/{id}','Api\ProductController@updateStock');


