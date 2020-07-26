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
        return response()->json($data, $code);
    }

    static public function responseError($error = '', $code = 400)
    {
        $headers = [
            'Content-Type' => 'application/json;charset=UTF-8', 
            'Charset' => 'utf-8'
        ];

        return response()->json($error, $code, $headers, JSON_UNESCAPED_UNICODE);
    }

    public function testResponseError()
    {
        return $this->responseError("Lỗi rồi");
    }
}

