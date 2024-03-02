<?php

use App\Http\Controllers\MyTestController;
use Illuminate\Support\Facades\Route;

Route::prefix('mytest')->name('mytest.')->group(function () {
    Route::controller(MyTestController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });
});
