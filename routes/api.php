<?php

use App\Facades\Money;
use App\Http\Requests\ConversionRequest;
use App\Models\Currency;
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


Route::get('/convert/{currency}', function (ConversionRequest $request, Currency $currency) {
    return response()->json(Money::convertToArray($request->input('value'), $currency));
});
