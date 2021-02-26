<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('job-categories', [App\Http\Controllers\JobController::class,'getJobsCategories']);
Route::get('jobs/latest', [App\Http\Controllers\JobController::class,'getLastestJobs']);
Route::get('jobs/{categoryId}', [App\Http\Controllers\JobController::class,'getJobsByCagegoryId'])->where('categoryId', '[0-9]+');
Route::post('job/create', [App\Http\Controllers\JobController::class,'create']);
Route::get('job/details/{id}', [App\Http\Controllers\JobController::class,'getJobById'])->where('id', '[0-9]+');