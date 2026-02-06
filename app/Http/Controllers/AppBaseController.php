<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class AppBaseController extends Controller
{
    protected function sendResponse($result, string $message): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ]);
    }

    protected function sendError(string $error, int $code = 404): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $error,
        ], $code);
    }

    protected function sendSuccess(string $message): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }
}
