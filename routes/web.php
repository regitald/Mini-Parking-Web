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

Route::get('/', function () {
    return view('login');
});

// Route::get('/', 'Auth\LoginController@index');
Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@login']);
Route::get('/logout', 'Auth\LoginController@logout');
Route::group(['middleware' => ['CheckSession']], function () {

    Route::get('/attendance', 'Employee\AttendanceController@index');
    Route::get('/attendance/add', 'Employee\AttendanceController@add');
    Route::post('/attendance', 'Employee\AttendanceController@store');
    
    Route::get('/departement', 'Departement\DepartementController@index');
    Route::get('/departement/detail/{id}', 'Departement\DepartementController@show');
    Route::get('/departement/add', function () {
        return view('departement.add');
    });
    Route::post('/departement/create', 'Departement\DepartementController@store');
    Route::post('/departement/update', 'Departement\DepartementController@update');
    Route::get('/departement/delete/{id}', 'Departement\DepartementController@destroy');

    Route::get('/employee', 'Employee\EmployeeController@index');
    Route::get('/employee/detail/{id}', 'Employee\EmployeeController@show');
    Route::get('/employee/add', 'Employee\EmployeeController@add');
    Route::post('/employee/create', 'Employee\EmployeeController@store');
    Route::post('/employee/update', 'Employee\EmployeeController@update');
    Route::get('/employee/delete/{id}', 'Employee\EmployeeController@destroy');
});