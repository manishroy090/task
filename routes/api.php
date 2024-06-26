<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ClientController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/inde',function(){
    return dd("function ");
});

Route::controller(AuthController::class)->group(function(){
    
    Route::post('/auth/register', 'register');
    Route::post('/auth/login', 'login')->name('login');
});

Route::controller(ClientController::class)->group(function(){
    Route::group([
    'prefix' => 'clients',
    'as' => 'clients.',
    'middleware'=>['auth:sanctum']
    ],function(){
    Route::get('/','index');
    Route::post('/','store');
    Route::get('/{id}','show');
    
    });
    
    });
    


   

