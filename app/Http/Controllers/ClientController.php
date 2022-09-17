<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterClientRequest;
use CodeDredd\Soap\Facades\Soap;

class ClientController extends Controller
{
    public function register(RegisterClientRequest $request)
    {
        $response = Soap::baseWsdl(config('services.soap-wallet.endpoint') . '?wsdl')->call('registerClient', [
            'identification' => '26131830',
            'firstname' => 'Steven',
            'lastname' => 'Sucre',
            'email' => 'steven.gsp@gmail.com',
            'phone' => '+584241451008',
        ]);

        if (! $response->successful()) {
            abort($response->toPsrResponse()->getStatusCode(), $response->toPsrResponse()->getReasonPhrase());
        }

        $result = \Arr::get($response->json(), 'registerClientResult');

        return response()->json($result ?? []);
    }
}
