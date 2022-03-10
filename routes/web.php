<?php

use App\Models\Inn;
use App\Models\Tour;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TourController;

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

Route::get('/dashboard', function (Request $request) {

    $id = Auth::user()->id;
    $users = User::with('tours')->find($id);
    
    return Inertia::render('Dashboard', compact('users'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(TourController::class)->group(function () {
    Route::name('tour.index')->get('/tours', 'index');
    Route::name('tour.create')->get('/tours/create', 'create')->middleware('auth');
    Route::name('tour.store')->post('/tours', 'store');
    Route::name('tour.show')->get('/tours/{tour}/', 'show')->middleware('auth');
    Route::name('tour.edit')->get('/tours/{tour}/edit', 'edit')->middleware('auth');
    Route::name('tour.update')->patch('/tours/{tour}', 'update');
    Route::name('tour.destroy')->delete('/tours/{tour}', 'destroy')->middleware('auth');
});

Route::controller(PlanController::class)->group(function () {
    Route::name('inn.add')->post('/inns/{tour}', 'innAdd');
    Route::name('inn.remove')->post('/inns/{inns}/{tour}', 'innRemove');
    Route::name('travel.add')->post('/travels/{tour}', 'travelAdd');
    Route::name('travel.remove')->post('/travels/{travels}/{tour}', 'travelRemove');
});



// Route::resource('tour', TourController::class);
require __DIR__ . '/auth.php';
