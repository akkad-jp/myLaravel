<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api;

/**
 * @OA\Info(
 *   title="API Example",
 *   description="Api",
 *   version="1.0.0",
 * )
 *
 * @OA\Server(
 *   description="OpenApi host",
 *   url="http://localhost",
 * )
 *
 * @OA\SecurityScheme(
 *   securityScheme="BearerAuth",
 *   type="apiKey",
 *   in="header",
 *   name="api_token"
 * )
 *
 * @OA\Schema(
 *   schema="created_at",
 *   description="Created at",
 *   type="string",
 *   format="date-time",
 *   example="2024-01-02T12:34:56",
 * )
 */
class Swagger
{
}
