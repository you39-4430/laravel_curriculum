<?php

use App\Http\Controllers\Api\TodoController;
use App\Http\Controllers\Api\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('todo/create', [TodoController::class, 'store'])->name('api.todo.create');
Route::patch('todo/update/{id}', [TodoController::class, 'update'])->name('api.todo.update');
Route::get('todo/show/{id}', [TodoController::class, 'show'])->name('api.todo.show');
Route::delete('todo/delete/{id}', [TodoController::class, 'destroy'])->name('api.todo.delete');

Route::post('company/create', [CompanyController::class, 'store'])->name('api.company.create');
Route::get('company/show/{id}', [CompanyController::class, 'show'])->name('api.company.show');
Route::put('company/update/{id}', [CompanyController::class, 'update'])->name('api.company.update');
