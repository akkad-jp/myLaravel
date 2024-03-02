<?php
declare(strict_type=1);
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class MyTestController extends Controller
{
    /**
     * 動作確認
     *
     * @param Request $request
     * @return InertiaResponse
     */
    public function index(Request $request): InertiaResponse
    {
        $payload = [
            'hoge' => 'fuga',
        ];
        return Inertia::render('MyTest/IndexPage', $payload);
    }
}
