<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponseTrait;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="Blog API",
 *     version="1.0.0",
 *     description="API documentation for Blog application",
 *
 *     @OA\Contact(
 *         email="support@blogapi.com"
 *     )
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Enter JWT Bearer token"
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 */
class Controller extends BaseController
{
    use ApiResponseTrait;
}
