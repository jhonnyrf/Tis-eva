<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\AuthController;

// Rutas de autenticación para manejar login, logout y obtener datos del usuario logueado
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/api/usuario-logueado', [AuthController::class, 'getLoggedUser']);

// Rutas de la API para los proyectos (manejadas por Laravel, no por React)
// Prefijo '/api' para diferenciar estas rutas
Route::prefix('api')->middleware(['auth:docente'])->group(function () {
    Route::get('/proyectos', [ProyectosController::class, 'index']);
    Route::post('/proyectos', [ProyectosController::class, 'store']);
    Route::put('/proyectos/{id}', [ProyectosController::class, 'update']);
    Route::delete('/proyectos/{id}', [ProyectosController::class, 'destroy']);
});

// Ruta de prueba para verificar funcionamiento del backend
Route::get('/test', function () {
    return 'Ruta de prueba funcionando';
});

// Ruta de prueba para verificar el controlador de proyectos
Route::get('/test-controller', [ProyectosController::class, 'index']);

// Ruta comodín (wildcard) permite que React maneje todas las rutas del frontend
Route::get('/{any}', function () {
    return view('welcome');  // Carga la vista React (Frontend)
})->where('any', '.*');
