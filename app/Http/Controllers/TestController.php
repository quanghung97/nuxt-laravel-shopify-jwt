<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class TestController extends Controller
{
    public function index()
    {
        /**
         * private app
         */
        // $shopName = 'testshop997';
        // $clientSecret = '316ba4ab79df7b051efdee10996e92b3';
        // $accessToken = '80e0a81fab4846892df3bffeb53c4f52';
        // $client = new \Secomapp\ClientApi($clientSecret, $shopName, $accessToken);
        // /**
        //  * @var Asset
        //  */
        // $orderApi = new \Secomapp\Resources\Asset($client);
        // //dd($orderApi);
        // $orders = $orderApi->all('39129612355');
        // dd($orders);


        /**
         * public app
         */
        $shopName = Auth::user()->name;
        $email = Auth::user()->email;
        $clientSecret = env('SHOPIFY_SECRET');
        $accessToken =  Auth::user()->providers->last()->provider_token;
        $client = new \Secomapp\ClientApi($clientSecret, $shopName, $accessToken);
        /**
         * @var Asset
         */
        $orderApi = new \Secomapp\Resources\Asset($client);
        $orders = $orderApi->get('39281164401', 'snippets/product-card-list.liquid');
        //dd($orders);
        return redirect("http://localhost:3000/info/${shopName}/${email}");
        ;
    }
}
