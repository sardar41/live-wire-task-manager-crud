<?php

use Illuminate\Support\Facades\Route;

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

// Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
// Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

// Route::get('/{locale?}', function ($locale = null) {
//     if (isset($locale) && in_array($locale, config('app.available_locales'))) {
//         app()->setLocale($locale);
//     }
    Route::get('/', \App\Livewire\Tasks\Index::class)->middleware('auth')->name('tasks.shown');
    Route::get('/tasks/create', \App\Livewire\Tasks\Create::class)->middleware('auth', 'isAdmin')->name('tasks.create');
    Route::get('/tasks/edit/{taskId}', \App\Livewire\Tasks\Edit::class)->middleware('auth', 'isAdmin')->name('tasks.edit');
// });

require __DIR__.'/auth.php';
