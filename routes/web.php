<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceStatusController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/iot', fn () => view('iot'));
Route::get('/device-status', [DeviceStatusController::class, 'getStatus']);
