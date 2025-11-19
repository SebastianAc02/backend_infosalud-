<?php

use App\Http\Controllers\Api\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\AuthController;


Route::get('/nueva', function () {
    return '¡Ruta nueva funcionando!';
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas por token Sanctum
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', fn(Request $req) => $req->user());
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('appointments', AppointmentController::class);
});



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/patients', [PatientController::class, 'store']);
    Route::put('/patients/{id}', [PatientController::class, 'update']);
    Route::patch('/patients/{id}/diagnosis', [PatientController::class, 'updateDiagnosis']);
    Route::get('/patients/{id}', [PatientController::class, 'show']);
});


Route::middleware('auth:sanctum')->group(function() {
    Route::post('/patients/{id}/symptoms', [PatientController::class, 'reportSymptom']);
    Route::get('/patients/{id}/alerts', [PatientController::class, 'alerts']);
});


use App\Http\Controllers\Api\ClinicalHistoryController;

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/patients/{id}/history', [ClinicalHistoryController::class, 'store']);
    Route::get('/patients/{id}/history', [ClinicalHistoryController::class, 'index']);
    Route::get('/history/{id}', [ClinicalHistoryController::class, 'show']);
});


use App\Http\Controllers\Api\ReportController;

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/reports/appointments', [ReportController::class, 'appointmentStats']);
    Route::get('/reports/patient-adherence/{id}', [ReportController::class, 'patientAdherence']);
});


Route::post('/test/whatsapp', [\App\Http\Controllers\Api\NotificationTestController::class, 'testWhatsApp']);

Route::post('/test/sms', [\App\Http\Controllers\Api\NotificationTestController::class, 'testSMS']);

