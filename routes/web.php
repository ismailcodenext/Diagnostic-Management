<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


// ------------Controller Work By Ismail start--------------------
use App\Http\Controllers\DoctorController;

// ------------Controller Work By Ismail End--------------------

// ------------Controller Work By Robiul start--------------------

// ------------Controller Work By Robiul End--------------------

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Open Dashboard API Route
Route::view('/','pages.front-end-page.auth.login-page');

/// Doctor all Api
Route::get("/list-doctor",[DoctorController::class,'DoctorList'])->middleware('auth:sanctum');

// ----------------------------Dashboard Route Work Ismail Start-----------------------------------------------------

Route::view('/patient-page','pages.back-end-page.patient-page');
Route::view('/doctor-page','pages.back-end-page.doctor-page');

// ----------------------------Dashboard Route Work Ismail End-----------------------------------------------------









// ----------------------------Dashboard Route Work Robiul Start-----------------------------------------------------

// front-page User API Route Start

Route::view('/diagnostic-login-page','pages.front-end-page.auth.login-page')->name('login');
Route::view('/registration','pages.front-end-page.auth.registration-page');
Route::view('/sendOtp','pages.front-end-page.auth.send-otp-page');
Route::view('/verifyOtp','pages.front-end-page.auth.verify-otp-page');
Route::view('/resetPassword','pages.front-end-page.auth.reset-pass-page');
Route::view('/userProfile','pages.dashboard.profile-page');


// User Web API Routes
// Route::post('/user-registration', [UserController::class, 'UserRegistration'])->middleware('auth:sanctum');
Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login',[UserController::class,'UserLogin']);
Route::get('/user-profile',[UserController::class,'UserProfile'])->middleware('auth:sanctum');
Route::get('/logout',[UserController::class,'UserLogout'])->middleware('auth:sanctum');
Route::post('/user-update',[UserController::class,'UpdateProfile'])->middleware('auth:sanctum');
Route::post('/send-otp',[UserController::class,'SendOTPCode']);
Route::post('/verify-otp',[UserController::class,'VerifyOTP']);
Route::post('/reset-password',[UserController::class,'ResetPassword'])->middleware('auth:sanctum');

// front-page API Route End


// Dashboard API Route start
Route::view('/dashboardSummary','pages.back-end-page.dashboard-page');
// Dashboard API Route End

// ----------------------------Dashboard Route Work Robiul End-----------------------------------------------------
