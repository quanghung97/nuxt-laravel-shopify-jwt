<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\UserProvider;
use App\User;
use Auth;
use App\Theme;

class LoginShopifyController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(Request $request)
    {
        $this->validate($request, [
            'domain' => 'string|required'
        ]);

        $config = new \SocialiteProviders\Manager\Config(
            env('SHOPIFY_KEY'),
            env('SHOPIFY_SECRET'),
            env('SHOPIFY_REDIRECT'),
            ['subdomain' => $request->get('domain')]
        );

        return Socialite::with('shopify')
            ->setConfig($config)
            ->scopes(['read_products','write_products','read_themes','write_themes'])
            ->redirect();
    }
    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $shopifyUser = Socialite::driver('shopify')->user();

        // Create user
        $user = User::firstOrCreate([
            'name' => $shopifyUser->name,
            'email' => $shopifyUser->email,
            'password' => '',
        ]);

        // Store the OAuth Identity
        UserProvider::firstOrCreate([
            'user_id' => $user->id,
            'provider' => 'shopify',
            'provider_user_id' => $shopifyUser->id,
            'provider_token' => $shopifyUser->token,
        ]);

        // Create shop
        // $shop = Shop::firstOrCreate([
        //     'name' => $shopifyUser->name,
        //     'domain' => $shopifyUser->nickname,
        // ]);

        // Attach shop to user
        // $shop->users()->syncWithoutDetaching([$user->id]);

        // Login with Laravel's Authentication system
        Auth::login($user, true);
        $email = Auth::user()->email;

        $clientSecret = env('SHOPIFY_SECRET');
        $shopName = Auth::user()->name;
        $accessToken =  Auth::user()->providers->last()->provider_token;

        $client = new \Secomapp\ClientApi($clientSecret, $shopName, $accessToken);
        /**
         * @var Theme
         */
        $mainThemeApi = new \Secomapp\Resources\Theme($client);

        $Themes = $mainThemeApi->all();
        $mainThemeId = null;
        foreach ($Themes as $key => $value) {
            if ($value->role == 'main') {
                $mainThemeId = (string)$value->id;
            }
        }
        Theme::firstOrCreate([
            'theme' => $mainThemeId,
            'user_id' => Auth::user()->id
        ]);
        // Setup uninstall webhook
        //dispatch(new \App\Jobs\RegisterUninstallShopifyWebhook($store->domain, $shopifyUser->token, $store));

        return redirect("http://localhost:3000/info/${shopName}/${email}");
    }
}
