<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    static public function responseSuccess($data = '', $message = '', $code = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'code' => $code
        ]);
    }

    static public function responseError($error = '', $data = '', $code = 400)
    {
        return response()->json([
            'error' => $error,
            'data' => $data,
            'code' => $code
        ]);
    }

}
