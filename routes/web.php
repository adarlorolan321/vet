<?php

use App\Http\Controllers\Admin\UnavalableDatesController;
use App\Http\Controllers\Apointment\ApointmentController;
use App\Http\Controllers\Customer\CustomerCalendarController;
use App\Http\Controllers\CustomerAppoinmentController;
use App\Http\Controllers\ProfileController;
use App\Models\Apointment\Apointment;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
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

if (env('APP_ENV') === 'dev') {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    // dd(auth()->user()->hasRole('Dentist'));
    if(auth()->user()->hasRole('Admin')){
        return Inertia::render('Dashboard');
    }
    if(auth()->user()->hasRole('Dentist')){
        return Inertia::render('Admin/Dashboard');
    }
    else{
        $data = Apointment::where('user_id', auth()->user()->id)->get();
        return Inertia::render('Customer/Index', [
            'data' => $data
        ]);
    }
   
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
    Route::resource('apointment', ApointmentController::class);
    Route::resource('unavailable-dates', UnavalableDatesController::class);
    Route::resource('customer-apointment', CustomerAppoinmentController::class);
    Route::prefix("customer")->group(function () {
        Route::resource('slots', CustomerCalendarController::class);
      
    });
});

require __DIR__.'/auth.php';
