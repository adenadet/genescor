<?php 

use Illuminate\Support\Facades\Route;
    
Route::get('/admin', 'DashboardController@admin')->name('dashboard.admin');
