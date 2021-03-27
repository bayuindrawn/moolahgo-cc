<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function responseJson($code, string $message, $data = null)
    {
        return response()->json([
            'response_code' => $code,
            'message'       => $message,
            'data'          => $data
        ], $code);
    }
}
