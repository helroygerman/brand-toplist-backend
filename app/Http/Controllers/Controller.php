<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="BRAND TOPLIST API Documentation",
 *     version="1.0.0",
 *     description="This is the API documentation for the Brand Toplist application",
 *     @OA\Contact(
 *         email="yimhelgerman@gmail.com"
 *     )
 * )
 * 
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 * 
 * @OA\SecurityScheme(
 *     type="http",
 *     securityScheme="sanctum",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */

abstract class Controller
{
    //
}
