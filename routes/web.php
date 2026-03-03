<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitudController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí definimos todas las rutas de tu aplicación.
|
*/

// Ruta raíz "/" abre directamente el listado y formulario de solicitudes
Route::get('/', [SolicitudController::class, 'index'])->name('solicitudes.index');

// CRUD de solicitudes
Route::post('/solicitudes', [SolicitudController::class, 'store'])->name('solicitudes.store');
Route::delete('/solicitudes/{id}', [SolicitudController::class, 'destroy'])->name('solicitudes.destroy');
Route::get('/solicitudes/{id}/edit', [SolicitudController::class, 'edit'])->name('solicitudes.edit');
Route::put('/solicitudes/{id}', [SolicitudController::class, 'update'])->name('solicitudes.update');

// Ruta para exportar solicitudes a Excel (CSV)
Route::get('/solicitudes/exportar', [SolicitudController::class, 'export'])->name('solicitudes.export');