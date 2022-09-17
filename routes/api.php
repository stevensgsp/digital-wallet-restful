<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/clients/register', [ClientController::class, 'register']);
Route::post('/wallets/recharge', [WalletController::class, 'rechargeWallet']);
Route::post('/wallets/check-balance', [WalletController::class, 'checkBalance']);
Route::post('/wallets/checkout', [WalletController::class, 'checkout']);
Route::post('/wallets/confirm-checkout', [WalletController::class, 'confirmCheckout']);
