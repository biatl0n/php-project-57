<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LabelController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('task_statuses', TaskStatusController::class)
    ->except('index', 'show')
    ->middleware(['AuthCheck']);

Route::resource('task_statuses', TaskStatusController::class)
    ->only('index', 'show');

Route::resource('tasks', TaskController::class)
    ->except('index', 'show')
    ->middleware(['AuthCheck']);

Route::resource('tasks', TaskController::class)
    ->only('index', 'show');

Route::resource('labels', LabelController::class)
    ->except('index', 'show')
    ->middleware(['AuthCheck']);

Route::resource('labels', LabelController::class)
    ->only('index', 'show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
