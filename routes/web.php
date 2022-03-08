<?php

use App\Http\Controllers\TourController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('welcome');

Route::get('/dashboard', function () {

    $id = Auth::user()->id;
    $users = User::with('tours')->find($id);
    return Inertia::render('Dashboard', compact('users'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(TourController::class)->group(function () {
    Route::get('/tours', 'index')->name('tour.index');
    Route::get('/tours/create', 'create')->middleware('auth')
        ->name('tour.create');
    Route::post('/tours', 'store')
        ->name('tour.store');
    Route::get('/tours/{tour}/', 'show')->middleware('auth')
        ->name('tour.show');
    Route::put('/tours/{inns}', 'remove_plan')
        ->name('plan.remove');
    Route::post('/tours/{tour}/', 'plan')
        ->name('plan.add');
    Route::get('/tours/{tour}/edit', 'edit')->middleware('auth')
        ->name('tour.edit');
    Route::patch('/tours/{tour}', 'update')
        ->name('tour.update');
    Route::delete('/tours/{tour}', 'destroy')->middleware('auth')
        ->name('tour.destroy');
});

// Route::resource('tour', TourController::class);

require __DIR__ . '/auth.php';
