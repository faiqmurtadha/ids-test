<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * route "/register"
 * @method "POST"
 */
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');

/**
 * route "/login"
 * @method "POST"
 */
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

/**
 * route "/user"
 * @method "GET"
 */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * route "/logout"
 * @method "POST"
 */
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

/**
 * route "/change-password"
 * @method "POST"
 */
Route::middleware('auth:api')->post('/change-password', App\Http\Controllers\Api\ChangePasswordController::class)->name('change_password');

Route::post('/send-password-reset-link', [App\Http\Controllers\Api\PasswordRequestController::class, 'sendPasswordResetEmail']);

Route::middleware('guest')->post('/reset-password', [App\Http\Controllers\Api\ResetPasswordController::class, 'passwordResetProcess']);

Route::apiResource('/company', CompanyController::class);
Route::apiResource('/employee-management', EmployeeController::class);
Route::apiResource('/position-management', PositionController::class);
Route::apiResource('/role-management', RoleController::class);
Route::apiResource('/user-management', UserController::class);