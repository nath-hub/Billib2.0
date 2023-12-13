<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

    /*
    |--------------------------------------------------------------------------
    | users
    |--------------------------------------------------------------------------
    */

Route::post('login', [AuthController::class, 'login'])->name('users.login');

Route::post('loginCode/{user}', [AuthController::class, 'loginWithCode'])->name('users.code');

Route::post('logout/{user}', [AuthController::class, 'logout'])->name('users.logout')->middleware('auth:sanctum');



Route::apiResource('users', UserController::class);

Route::get('/notification/identifiant/{id}', [UserController::class, 'createIdentifiant']);

Route::post('/check/email', [UserController::class, 'checkEmail'])->name('check.email');

Route::post('/check/validation/email', [UserController::class, 'checkVerificationCode'])->name('validation.email');

Route::post('/uploadFile', [UserController::class, 'uploadAvatar'])->name('users.avatar')->middleware('auth:sanctum');;



    /*
    |--------------------------------------------------------------------------
    | tickets
    |--------------------------------------------------------------------------
    */
    //selectionner les tickets et les articles d'un utilisateur.
    
Route::apiResource('tickets', TicketController::class)->middleware('auth:sanctum');

Route::get('/tickets/users/{user}', [TicketController::class, 'showByUser'])->middleware('auth:sanctum');

Route::get('/tickets/month/{user}', [TicketController::class, 'showTicketByMonth'])->middleware('auth:sanctum');

Route::get('/tickets/week/{user}', [TicketController::class, 'showTicketByWeek'])->middleware('auth:sanctum');

Route::apiResource('/articles', ArticleController::class)->middleware('auth:sanctum');

Route::get('/articles/users/{user}', [ArticleController::class, 'showByUser'])->middleware('auth:sanctum');

Route::get('/articles/prices/{user}', [ArticleController::class, 'showByPrice'])->middleware('auth:sanctum');

Route::get('/articles/{user}/{ticket}', [ArticleController::class, 'showTicketArticle'])->middleware('auth:sanctum');

Route::post('/filters/{user}', [TicketController::class, 'filter'])->name('filter')->middleware('auth:sanctum'); 