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

Route::get('/', 'PageController@index')->name('page_home');
Route::get('teacher', 'PageController@teacher')->name('page_teacher');
Route::get('about-us', 'PageController@about')->name('page_about');
Route::get('pricing', 'PageController@pricing')->name('page_pricing');
Route::get('contact', 'PageController@contact')->name('page_contact');

// Student
Route::get('s/signup', 'PageController@register')->name('page_register');
Route::post('s/signup', 'Student\CustomSignupController@addUser')->name('page_register');
Route::get('s/login', 'Student\CustomLoginController@index')->name('page_login');
Route::post('s/login', 'Student\CustomLoginController@loginUser')->name('page_login');
Route::get('s/payment', 'PageController@payment')->name('page_payment');
Route::post('s/logout', 'Student\StudentController@logout')->name('page_logout');
Auth::routes(['verify' => true]);
Route::group(['middleware' => ['auth']], function() {//['auth','verified']
    // Dashboard
        Route::get('s/dashboard', 'Student\DashboardController@index')->name('student_dashboard');
        Route::get('s/profile', 'Student\StudentController@profile')->name('student_profile');
        Route::post('s/profile/update', 'Student\StudentController@profileUpdate')->name('student_profile_update');
        Route::post('s/profile/password', 'Student\StudentController@profilePassword')->name('student_password');
});

// Admin
Route::get('admin/login', 'Admin\LoginController@index');
Route::post('admin/login', 'Admin\LoginController@loginAdmin')->name('login_admin');
Route::get('admin/password/reset', 'Admin\LoginController@forgotPassword');
Route::post('admin/validate-password', 'Admin\LoginController@validatePasswordRequest')->name('admin_reset_password_without_token');
Route::get('admin/reset-password/{token}', 'Admin\LoginController@resetPasswordGet')->name('admin_reset_password_get');
Route::post('admin/reset-password', 'Admin\LoginController@resetPasswordPost')->name('admin_password_with_token');
Route::post('admin/logout', 'Admin\AdminController@logoutAdmin')->name('logout_admin');
Route::middleware('auth:admin')->group(function () {
    Route::get('admin/profile', 'Admin\AdminController@profile');
    Route::post('admin/profile/update', 'Admin\AdminController@profileUpdate');
    Route::post('admin/profile/password', 'Admin\AdminController@profilePassword');
    // Dashboard
    Route::get('admin/dashboard', 'Admin\DashboardController@index')->name('admin_dashboard');
    // Users
    Route::get('admin/users', 'Admin\UserController@index')->name('user_list');
    Route::get('admin/users/{id}/edit', 'Admin\UserController@edit'); //need to be place above other route
    Route::post('admin/users/store', 'Admin\UserController@store')->name('user_store');
    Route::post('admin/users/{id}/update', 'Admin\UserController@update');
    Route::delete('admin/users/{id}/destroy', 'Admin\UserController@destroy');
    Route::get('admin/users/{id}/status/{status_id}', 'Admin\UserController@status');
    // Teachers
    Route::get('admin/teachers', 'Admin\TeacherController@index')->name('teachers_list');
    Route::get('admin/teacher/add', 'Admin\TeacherController@add')->name('teachers_add');
    Route::post('admin/teacher/add', 'Admin\TeacherController@add')->name('teachers_add');
    Route::get('admin/teacher/{id}/edit', 'Admin\TeacherController@update')->name('teachers_edit');
    Route::post('admin/teacher/{id}/update', 'Admin\TeacherController@update')->name('teachers_update');
    // Student
    Route::get('admin/students', 'Admin\StudentController@index')->name('students_list');
    Route::get('admin/student/add', 'Admin\StudentController@add')->name('students_add');
    Route::post('admin/student/add', 'Admin\StudentController@add')->name('students_add');
});

