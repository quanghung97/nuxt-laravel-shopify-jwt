<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'TestController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/shopify', 'Auth\LoginShopifyController@redirectToProvider')->name('login.shopify');
Route::get('login/shopify/callback', 'Auth\LoginShopifyController@handleProviderCallback');
Route::get('test', 'TestController@index')->middleware(['auth', 'subscribed']);

Route::get('/store/{storeId}', function () {
    // Display the store dashboard
})->middleware(['auth', 'subscribed']);


Route::get('stores/{storeId}/shopify/subscribe', function (\Illuminate\Http\Request $request, $storeId) {
    $store = \App\Store::find($storeId);
    $user = auth()->user()->providers->where('provider', 'shopify')->first();
    $shopify = \Shopify::retrieve($store->domain, $user->provider_token);

    $activated = \ShopifyBilling::driver('RecurringBilling')
        ->activate($store->domain, $user->provider_token, $request->get('charge_id'));

    $response = array_get($activated->getActivated(), 'recurring_application_charge');

    \App\Charge::create([
        'store_id' => $store->id,
        'name' => 'default',
        'shopify_charge_id' => $request->get('charge_id'),
        'shopify_plan' => array_get($response, 'name'),
        'quantity' => 1,
        'charge_type' => \App\Charge::CHARGE_RECURRING,
        'test' => array_get($response, 'test'),
        'trial_ends_at' => array_get($response, 'trial_ends_on'),
    ]);

    return redirect('/home');
})->name('shopify.subscribe');


Route::post('webhook/shopify/order-created', function (\Illuminate\Http\Request $request) {
    // Handle order created
})->middleware('webhook');


Route::post('webhook/shopify/uninstall', function (\Illuminate\Http\Request $request) {
    // Handle app uninstall
})->middleware('webhook');
