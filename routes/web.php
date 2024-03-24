<?php

use Illuminate\Support\Facades\Route;

// ------------Controller Work By Ismail start--------------------
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
Route::view('/','pages.back-end-page.dashboard-page');


// ----------------------------Dashboard Route Work Ismail Start-----------------------------------------------------

// ----------------------------Dashboard Route Work Ismail End-----------------------------------------------------









// ----------------------------Dashboard Route Work Robiul Start-----------------------------------------------------

// Dashboard API Route start
Route::view('/dashboardSummary','pages.back-end-page.dashboard-page');
// Dashboard API Route End

// ----------------------------Dashboard Route Work Robiul End-----------------------------------------------------
