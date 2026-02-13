<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/appointment-request', [App\Http\Controllers\AppointmentRequestController::class, 'createNew']);

Route::post('/accept-appointment-request', [App\Http\Controllers\AppointmentRequestController::class, 'acceptRequest']);

Route::post('/reject-appointment-request', [App\Http\Controllers\AppointmentRequestController::class, 'rejectRequest']);