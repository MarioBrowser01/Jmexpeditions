<?php
use App\Http\Controllers\Dashboard\CategoriaController;
use App\Http\Controllers\Dashboard\DestinoController;

Route::get('/admin/categorias', [CategoriaController::class, 'index']);
Route::get('/admin/destinos', [DestinoController::class, 'index']);
?>
