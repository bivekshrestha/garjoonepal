<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class BaseController extends Controller
{
    protected $data = null;

    /**
     * @param $route
     * @return RedirectResponse
     */
    protected function redirectResponse($route): RedirectResponse
    {
        return redirect()->route($route);
    }

    /**
     * @param bool $success
     * @param int $responseCode
     * @param string $message
     * @param null $data
     * @return JsonResponse
     */
    protected function jsonResponse($success = true, $responseCode = 200, $message = '', $data = null): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], $responseCode);
    }

    /**
     * @param $errors
     * @return JsonResponse
     */
    protected function validationErrorJsonResponse($errors): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Data Validation Failed. Please check the form fields and try again.',
            'errors' => $errors
        ], 422);
    }

    /**
     * @return JsonResponse
     */
    protected function successJsonResponse(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Action Successful'
        ], 200);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    protected function createdJsonResponse($data): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Data Created Successfully',
            'data' => $data
        ], 201);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    protected function updatedJsonResponse($data): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Data Updated Successfully',
            'data' => $data
        ], 201);
    }

    /**
     * @return JsonResponse
     */
    protected function deletedJsonResponse(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Data Deleted Successfully',
        ], 201);
    }
}
