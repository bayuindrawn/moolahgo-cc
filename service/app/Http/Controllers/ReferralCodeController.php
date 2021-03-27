<?php

namespace App\Http\Controllers;

use App\Models\Users;
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
        $payload    = $request->input();
        $output     = Users::getRefCode($payload);
        
        return $this->responseJson(200, 'Request sukses', $output);
    }
}
