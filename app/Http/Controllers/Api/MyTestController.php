<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MyTestController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"MyTest"},
     *   path="/api/hoge",
     *   summary="MyTest index",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *   )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $payload = [
            'test' => 'hoge',
            'num' => 1234,
        ];
        return response()->json($payload, 200);
    }
}
