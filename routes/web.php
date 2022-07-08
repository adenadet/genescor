<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('welcome');});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/app', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/app/admin',        [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/app/appointment',  [App\Http\Controllers\ModuleController::class, 'appointment'])->name('appointment');
    Route::get('/app/chats',        [App\Http\Controllers\ModuleController::class, 'chat'])->name('chats');
    Route::get('/app/dashboard',    [App\Http\Controllers\ModuleController::class, 'dashboard'])->name('dashboard');
    Route::get('/app/doctor',       [App\Http\Controllers\DoctorController::class, 'index'])->name('doctor')->middleware('user.type:doctor');
    Route::get('/app/hospital',     [App\Http\Controllers\HospitalController::class, 'index'])->name('hospital')->middleware('user.type:hospital');
    Route::get('/app/patient',      [App\Http\Controllers\PatientController::class, 'index'])->name('patient')->middleware('user.type:patient');
    Route::get('/app/wallet',       [App\Http\Controllers\ModuleController::class, 'wallet'])->name('wallet');

    Route::get('/app/admin/{any}', [App\Http\Controllers\AdminController::class, 'index'])->where('any', '.*')->name('admin/{any}');
    Route::get('/app/chats/{any}', [App\Http\Controllers\ModuleController::class, 'chat'])->where('any', '.*'); 
    Route::get('/app/doctor/{any}', [App\Http\Controllers\DoctorController::class, 'index'])->where('any', '.*')->middleware('user.type:doctor');
    Route::get('/app/hospital/{any}', [App\Http\Controllers\HospitalController::class, 'index'])->where('any', '.*')->middleware('user.type:hospital');
    Route::get('/app/patient/{any}', [App\Http\Controllers\PatientController::class, 'index'])->where('any', '.*')->middleware('user.type:patient');
    
});

Route::get('/app/{any}', [App\Http\Controllers\HomeController::class, 'index'])->where('any', '.*');
/*Routes for Payment 
Route::post('/pay', 'FlutterWaveController@initialize')->name('pay');
Route::get('/rave/callback', 'FlutterWaveController@callback')->name('callback');
*/