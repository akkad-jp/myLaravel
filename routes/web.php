<?php

use Auth0\Laravel\Facade\Auth0;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 以下のURLは、Auth0 のSDKが自動で生成・登録してくれている。
/*
    /login
    /logout
    /callback
*/

// 動作確認用の仮々実装
Route::get('/', function () {
    $message = 'You are not logged in.';
    $user = null;
    if (auth()->check()) {
        $user = auth()->user();
        $name = $user->name ?? 'User';
        $email = $user->email ?? '';
        $message = "Hello {$name}! Your email address is {$email}.";
    }
    $payload = [
        'message' => $message,
        'user' => $user,
    ];
    return Inertia::render('IndexPage', $payload);

});

// Auth0 sample
// see https://auth0.com/docs/quickstart/webapp/laravel/interactive
Route::middleware('auth')->group(function () {
    // 認可が必要なページのサンプル
    Route::get('/private', function () {
        // \Log::debug(var_export(auth()->user(), true));
        return response('Welcome! You are logged in.');
    });

    // Auth0 上で設定した権限の有無をチェックするサンプル
    Route::get('/scope', function () {
        return response('You have `read:messages` permission, and can therefore access this resource.');
    })->can('read:messages');

    // Auth0 のユーザの設定を更新するサンプル
    Route::get('/colors', function () {
        $endpoint = Auth0::management()->users();

        $colors = [
            'red',
            'blue',
            'green',
            'black',
            'white',
            'yellow',
            'purple',
            'orange',
            'pink',
            'brown',
        ];

        $endpoint->update(
            id: auth()->id(),
            body: [
                'user_metadata' => [
                    'color' => $colors[random_int(0, count($colors) - 1)]
                ]
            ]
        );
        $metadata = $endpoint->get(auth()->id());
        $metadata = Auth0::json($metadata);

        $color = $metadata['user_metadata']['color'] ?? 'unknown';
        $name = auth()->user()->name;

        return response("Hello {$name}! Your favorite color is {$color}.");
    });
});
