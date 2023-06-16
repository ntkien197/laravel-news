<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseSuccess($data = [], int $code = 0): JsonResponse
    {
        return response()->json([
            'status'  => true,
            'message' => GlobalHelper::getMessageErrorCode($code),
            'code'    => $code,
            'data'    => $data,
        ], 200);
    }
    public function responseError($errors = [], int $code = 1000): JsonResponse
    {
        return response()->json([
            'status'  => false,
            'message' => GlobalHelper::getMessageErrorCode($code),
            'code'    => $code,
            'data' => $errors,
        ], 200);
    }
}
