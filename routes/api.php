<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrentStockController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockReceivedController;
use App\Http\Controllers\StockDecreaseController;
use App\Http\Controllers\PasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Login
Route::post('/login', [LoginController::class,'onLogin']);
Route::post('/RecoverPassword', [LoginController::class,'RecoverPassword']);

//User
Route::post('/AddUser',[UserController::class,'AddUser']);
Route::get('/DeleteUser/{id}',[UserController::class,'DeleteUser']);
Route::get('/getUser/{id}',[UserController::class,'getUser']);
Route::get('/SelectUser',[UserController::class,'SelectUser']);
Route::post('/UpdateUser',[UserController::class,'UpdateUser']);

//Password 
Route::post('/EmailVerification', [PasswordController::class, 'EmailVerification']);
Route::post('/GetOTPExpiration', [PasswordController::class, 'GetOTPExpiration']);
Route::post('/OTPVerification', [PasswordController::class, 'OTPVerification']);
Route::post('/ResetPassword', [PasswordController::class, 'ResetPassword']);
Route::post('/ChangePassword', [PasswordController::class, 'ChangePassword']);

//Category

Route::post('/AddCategory',[CategoryController::class,'AddCategory']);
Route::get('/SelectCategory',[CategoryController::class,'SelectCategory']);
Route::get('/getCategory/{id}',[CategoryController::class,'getCategory']);
Route::get('/DeleteCategory/{id}',[CategoryController::class,'DeleteCategory']);
Route::post('/UpdateCategory',[CategoryController::class,'UpdateCategory']);


//Product
Route::post('/AddProduct',[ProductController::class,'AddProduct']);
Route::get('/SelectProduct',[ProductController::class,'SelectProduct']);
Route::get('/getProduct/{id}',[ProductController::class,'getProduct']);
Route::get('/SelectProductByCategory/{Category}',[ProductController::class,'SelectProductByCategory']);
Route::get('/DeleteProduct/{id}',[ProductController::class,'DeleteProduct']);
Route::post('/UpdateProduct',[ProductController::class,'UpdateProduct']);


// Dashboard
Route::get('/CountSummary',[DashboardController::class,'CountSummary']);
Route::get('/RecentTransactionList',[DashboardController::class,'RecentTransactionList']);
Route::get('/IncomeLast7Days',[DashboardController::class,'IncomeLast7Days']);



// Cart
Route::post('/CartAdd',[CartController::class,'CartAdd']);
Route::get('/CartItemPlus/{id}',[CartController::class,'CartItemPlus']);
Route::get('/CartItemMinus/{id}',[CartController::class,'CartItemMinus']);
Route::get('/RemoveCartList/{id}',[CartController::class,'RemoveCartList']);
Route::get('/CartList/{user_id}',[CartController::class,'CartList']);
Route::get('/TotalOrderValue/{user_id}',[CartController::class,'TotalOrderValue']);


// Transaction
Route::get('/ConfirmSale',[TransactionController::class,'ConfirmSale']);
Route::get('/GetInvoiceList',[TransactionController::class,'GetInvoiceList']);
Route::get('/GetOrderDetails/{memo_no}',[TransactionController::class,'GetOrderDetails']);
Route::post('/DeleteSalesMemo',[TransactionController::class,'DeleteSalesMemo']);
Route::post('/DeleteSalesInvoice',[TransactionController::class,'DeleteSalesInvoice']);
Route::post('/UpdateMemoProductQty',[TransactionController::class,'UpdateMemoProductQty']);



//Report
Route::get('/TransactionList',[ReportController::class,'TransactionList']);
Route::post('/TransactionListByDate',[ReportController::class,'TransactionListByDate']);
Route::get('/CurrentStockReport',[CurrentStockController::class,'CurrentStockReport']);
Route::get('/ReceivedAllStockData',[StockReceivedController::class,'ReceivedAllStockData']);
Route::post('/ReportFilterByDate',[StockReceivedController::class,'ReportFilterByDate']);
Route::post('/DecreaseFilterByDate',[StockReceivedController::class,'DecreaseFilterByDate']);
Route::get('/DecreaseAllStockData',[StockDecreaseController::class,'DecreaseAllStockData']);
Route::post('/DecreaseReportFilterByDate',[StockDecreaseController::class,'DecreaseReportFilterByDate']);


//Stock Received 
Route::post('/StockReceived',[StockReceivedController::class,'StockReceived']);

//Stock Decrease 
Route::post('/StockDecrease',[StockDecreaseController::class,'StockDecrease']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

