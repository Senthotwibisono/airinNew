<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userSystem\UserSystemController;

Route::prefix('/userSystem')->name('userSystem.')->controller(UserSystemController::class)->group(function() {
    Route::prefix('/user')->name('user.')->group(function() {
        Route::get('/index', 'indexUser')->name('index')->middleware('log.user.activity:access_user_index');
        Route::get('/data', 'dataUser')->name('data');
        Route::post('/post', 'postUser')->name('post');
    });

    Route::prefix('/role')->name('role.')->group(function() {
        Route::get('/index', 'indexRole')->name('index')->middleware('log.user.activity:access_role_index');
        Route::get('/data', 'dataRole')->name('data');
        Route::post('/post', 'postRole')->name('post');
    });
});

