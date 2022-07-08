<?php 
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\EMR\AppointmentController;
    
Route::apiResources([
    '/appointments' => 'AppointmentController',
]);
