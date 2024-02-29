<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MyTestController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"MyTest"},
     *   path="/api/v1/mytest",
     *   summary="MyTest index",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *   )
     * )
     *
     * MyTest index
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $payload = [
            'str' => 'hoge',
            'num' => 1234,
        ];
        return response()->json($payload, 200);
    }
}
