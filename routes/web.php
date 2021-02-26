<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', App\Http\Livewire\HomeComponent::class);
Route::get('jobs/{categoryId}', App\Http\Livewire\JobsByCategoryComponent::class)->where('categoryId', '[0-9]+');
Route::get('job/new', App\Http\Livewire\JobNewComponent::class);
Route::get('job/details/{id}', App\Http\Livewire\JobDetailsComponent::class)->where('id', '[0-9]+');

