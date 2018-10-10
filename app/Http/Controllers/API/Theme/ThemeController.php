<?php

namespace App\Http\Controllers\API\Theme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use File;

class ThemeController extends Controller
{
    public function index(Request $request)
    {
        $user = JWTAuth::toUser($request->token);

        $clientSecret = env('SHOPIFY_SECRET');
        $shopName = $user->name;
        $accessToken =  $user->providers->last()->provider_token;

        $client = new \Secomapp\ClientApi($clientSecret, $shopName, $accessToken);
        /**
         * @var Asset
         */
        $assetApi = new \Secomapp\Resources\Asset($client);
        $mainTheme = $user->theme->theme;
        $orders = $assetApi->get($mainTheme, 'layout/theme.liquid');

        $checkExist = strpos($orders->value, 'SEO-with-JSON-LD');
        if ($checkExist == false) {
            $position = strpos($orders->value, '<head>');
            $replacement = "\n {% include 'SEO-with-JSON-LD' %} \n";
            $newThemeValue = substr_replace($orders->value, $replacement, $position+7, 0);

            $params = (object)[
                'key' => 'layout/theme.liquid',
                'value' => $newThemeValue
            ];
            $updateTheme = $assetApi->createOrUpdate($mainTheme, $params);
        } else {
            //
        }
        $fileContent = File::get(storage_path('SEO-with-JSON-LD.liquid'));
        // dd($content);
        $contents = (object)[
            'key' => 'snippets/SEO-with-JSON-LD.liquid',
            'value' => $fileContent
        ];
        $assetApi->createOrUpdate($mainTheme, $contents);
        //dd($assetApi);
        return response()->json(['result' => 'successfully']);
    }
}
