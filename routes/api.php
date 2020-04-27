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
//customer
Route::apiResource('/customer','Api\CustomerController');
//pos
Route::Get('/get-product/{id}','Api\PosController@getProductById');
Route::Get('/add-to-cart/{id}','Api\CartController@addToCart');
Route::Get('/get-cart-product','Api\CartController@getAll');
Route::Get('/remove-from-cart/{id}','Api\CartController@removeCartItem');
Route::Get('/increment-quantity/{id}','Api\CartController@increment');
Route::Get('/decrement-quantity/{id}','Api\CartController@decrement');

//vat
Route::Get('/vat','Api\SettingController@index');

//order
Route::Post('/order-done','Api\OrderController@orderDone');
Route::Get('/today-orders','Api\OrderController@todayOrder');
Route::Get('/monthly-orders','Api\OrderController@monthlyOrder');
Route::Get('/yearly-orders','Api\OrderController@yearlyOrder');
Route::Get('/view-order/{id}','Api\OrderController@viewOrder');
Route::Get('/view-order-deatils/{id}','Api\OrderController@viewOrderDetails');
Route::Post('/search-orders-by-date','Api\OrderController@searchOrderByDate');
Route::Post('/search-orders-by-month','Api\OrderController@searchOrderByMonth');

//dashboard
Route::Get('/today-sell','Api\DashboardController@todaySell');
Route::Get('/today-income','Api\DashboardController@todayIncome');
Route::Get('/today-due','Api\DashboardController@todayDue');
Route::Get('/today-expense','Api\DashboardController@todayExpense');
Route::Get('/stock-out','Api\DashboardController@stockOut');





