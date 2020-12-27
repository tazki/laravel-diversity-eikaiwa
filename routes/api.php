<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\PostController;

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
Route::post('register', 'PassportAuthController@register')->name('register');
Route::post('login', 'PassportAuthController@login')->name('login');

Route::middleware('auth:api')->group(function () {;
    Route::resource('posts', 'PostController');
    Route::post('user/{id}/update', 'UserController@update');
    Route::post('user/{id}/accomplishments', 'UserAccomplishmentsController@fetch');
    Route::post('user/{id}/list/accomplishments', 'UserAccomplishmentsController@list');
    Route::post('user/{id}/store/accomplishments', 'UserAccomplishmentsController@store');
    Route::post('user/{id}/update/accomplishments', 'UserAccomplishmentsController@update');
    Route::post('user/{id}/education', 'UserEducationController@fetch');
    Route::post('user/{id}/list/education', 'UserEducationController@list');
    Route::post('user/{id}/store/education', 'UserEducationController@store');
    Route::post('user/{id}/update/education', 'UserEducationController@update');
    Route::post('user/{id}/projects', 'UserProjectsController@fetch');
    Route::post('user/{id}/list/projects', 'UserProjectsController@list');
    Route::post('user/{id}/store/projects', 'UserProjectsController@store');
    Route::post('user/{id}/update/projects', 'UserProjectsController@update');
    Route::post('user/{id}/work-experience', 'UserWorkExperienceController@fetch');
    Route::post('user/{id}/list/work-experience', 'UserWorkExperienceController@list');
    Route::post('user/{id}/store/work-experience', 'UserWorkExperienceController@store');
    Route::post('user/{id}/update/work-experience', 'UserWorkExperienceController@update');
});