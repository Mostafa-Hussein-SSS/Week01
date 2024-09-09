<?php

use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index']);
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::patch('/tasks/{task}/complete', [TaskController::class, 'markComplete'])->name('tasks.complete');
Route::patch('/tasks/{task}/incomplete', [TaskController::class, 'markIncomplete'])->name('tasks.incomplete');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
