<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [IndexController::class, 'index']);  
Route::get('some', [IndexController::class, 'some']);


Route::get('admin-dash', [IndexController::class, 'admin_home']);
Route::get('admin-users', [IndexController::class, 'users']);
Route::get('delete/{id}', [IndexController::class, 'delete']);
Route::get('foodMenu', [IndexController::class, 'foodMenu']);
Route::post('insertFood', [IndexController::class, 'insertFood']);
Route::get('viewFood', [IndexController::class, 'view_food']);

Route::get('delFood/{id}', [IndexController::class, 'delFood']);
Route::get('editFood/{id}', [IndexController::class, 'edit']);
Route::post('updatefood/{id}', [IndexController::class, 'update']);
// chef
Route::get('addChef', [IndexController::class, 'addChef']);
Route::post('insertChef', [IndexController::class, 'insertChef']);
Route::get('viewChef', [IndexController::class, 'viewChef']);
Route::get('delChef/{id}', [IndexController::class, 'delChef']);
Route::get('editChef/{id}', [IndexController::class, 'editChef']);
Route::post('UpdateChef/{id}', [IndexController::class, 'UpdateChef']);
// reservation
Route::post('reservation',[IndexController::class, 'reservation']);
Route::get('viewReserve',[IndexController::class, 'viewReserve']);

// add Cart
Route::post('addcart/{id}', [IndexController::class,'addcart']);    
Route::get('showcart/{id}', [IndexController::class,'showcart']);    
Route::get('remove/{id}', [IndexController::class,'remove']);    



  


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
