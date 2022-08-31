<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserGroupController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('/user',UserController::class);
Route::resource('/group',GroupController::class);
Route::get('/add-user/{id}',[UserGroupController::class, 'AddUser']);
Route::post('/add-user/{id}',[UserGroupController::class, 'StoreUser']);
Route::get('/add-expenses/{id}',[UserGroupController::class, 'AddExpenses']);
Route::post('/add-expenses/{id}',[UserGroupController::class, 'StoreExpenses']);
Route::get('/view-expenses/{id}',[UserGroupController::class, 'ViewExpenses']);
Route::get('/details/{id}',[UserGroupController::class, 'ExpenseDetails']);