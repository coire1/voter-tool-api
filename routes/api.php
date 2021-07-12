<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PickListController;

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

Route::post('picklist', [PickListController::class, 'store']);
Route::put('picklist/{id}', [PickListController::class, 'update']);
Route::get('picklist/{id}', [PickListController::class, 'show']);
