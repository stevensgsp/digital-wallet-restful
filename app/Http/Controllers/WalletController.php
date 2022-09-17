<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckBalanceRequest;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\ConfirmCheckoutRequest;
use App\Http\Requests\RechargeWalletRequest;
use CodeDredd\Soap\Facades\Soap;

class WalletController extends Controller
{
    public function rechargeWallet(RechargeWalletRequest $request)
    {
        $response = Soap::baseWsdl(config('services.soap-wallet.endpoint') . '?wsdl')->call('rechargeWallet', [
            'identification' => '26131830',
            'phone' => '+584241451008',
            'amount' => '3.5',
        ]);

        if (! $response->successful()) {
            abort($response->toPsrResponse()->getStatusCode(), $response->toPsrResponse()->getReasonPhrase());
        }

        $result = \Arr::get($response->json(), 'rechargeWalletResult');

        return response()->json($result ?? []);
    }

    public function checkBalance(CheckBalanceRequest $request)
    {
        $response = Soap::baseWsdl(config('services.soap-wallet.endpoint') . '?wsdl')->call('checkBalance', [
            'identification' => '26131830',
            'phone' => '+584241451008',
        ]);

        if (! $response->successful()) {
            abort($response->toPsrResponse()->getStatusCode(), $response->toPsrResponse()->getReasonPhrase());
        }

        $result = \Arr::get($response->json(), 'checkBalanceResult');

        return response()->json($result ?? []);
    }

    public function checkout(CheckoutRequest $request)
    {
        $response = Soap::baseWsdl(config('services.soap-wallet.endpoint') . '?wsdl')->call('checkout', [
            'identification' => '26131830',
            'phone' => '+584241451008',
            'productCode' => 'product-for-testing',
        ]);

        if (! $response->successful()) {
            abort($response->toPsrResponse()->getStatusCode(), $response->toPsrResponse()->getReasonPhrase());
        }

        $result = \Arr::get($response->json(), 'checkoutResult');

        return response()->json($result ?? []);
    }

    public function confirmCheckout(ConfirmCheckoutRequest $request)
    {
        $response = Soap::baseWsdl(config('services.soap-wallet.endpoint') . '?wsdl')->call('confirmCheckout', [
            'sessionId' => '6325cb900f7a793d5c01e8f7',
            'token' => 'bf08f6ca-c363-40ce-897a-b1b91ecbabed',
        ]);

        if (! $response->successful()) {
            abort($response->toPsrResponse()->getStatusCode(), $response->toPsrResponse()->getReasonPhrase());
        }

        $result = \Arr::get($response->json(), 'confirmCheckoutResult');

        return response()->json($result ?? []);
    }
}
