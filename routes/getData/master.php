<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\data\GetMasterDataController;

Route::prefix('/getData/master')->name('getData.master.')->controller(GetMasterDataController::class)->group(function() {
    Route::post('/user', 'userData')->name('user');
    Route::post('/role', 'roleData')->name('role');
});


