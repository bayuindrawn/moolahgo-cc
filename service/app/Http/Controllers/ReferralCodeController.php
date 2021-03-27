<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ReferralCodeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getReferralCode(Request $request)
    {
        $output = [
            'refferal_code' => $request->input('refferal_code')
        ];
        return $this->responseJson(200, 'Request sukses', $output);
    }
}
