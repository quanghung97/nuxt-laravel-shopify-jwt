<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class GetTokenController extends Controller
{
    /**
     * get access token shopify
     *
     * @return JSON with token
     */
    public function getToken()
    {
        // $accessToken = Auth::user()->providers->last()->provider_token;
        // $shopName = Auth::user()->name;
        return response(['access_token' => 'asasa', 'shop_name' => 'asasas']);
    }
}
