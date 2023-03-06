<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    /**
     * @param $data
     * @param int $code
     * @return JsonResponse
     */
    private function successResponse($data, int $code): JsonResponse
    {
		return response()->json(['data' => $data], $code);
	}

    /**
     * @param $errors
     * @param int $code
     * @return JsonResponse
     */
    protected function errorResponse($errors, int $code = 400): JsonResponse
    {
        return response()->json(['error' => $errors], $code);
    }

    /**
     * @param Collection $collection
     * @param int $code
     * @return JsonResponse
     */
    protected function showAll(Collection $collection, int $code = 200): JsonResponse
    {
		return $this->successResponse($collection, $code);
	}

    /**
     * @param $instance
     * @param int $code
     * @return JsonResponse
     */
    protected function showOne($instance, int $code = 200): JsonResponse
    {
		return $this->successResponse($instance, $code);
	}

    /**
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    protected function showMessage($message, int $code = 200): JsonResponse
    {
		return response()->json(['message' => $message, 'code' => $code]);
	}

    /**
     * @return JsonResponse
     */
    protected function successMessage(): JsonResponse
    {
        return response()->json(['message' => 'ok'], 200);
    }
}
