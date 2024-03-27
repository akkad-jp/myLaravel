<?php

use App\Http\Controllers\MyTestController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix('mytest')->name('mytest.')->group(function () {
    Route::controller(MyTestController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/subscription', function () {
            $intent = auth()->user()->createSetupIntent();
            $payload = [
                'intent' => $intent,
            ];
            return Inertia::render('MyTest/StripePage', $payload);
        })->name('subscription');
    });
});
