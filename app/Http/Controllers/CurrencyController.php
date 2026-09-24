<?php

namespace App\Http\Controllers;

use App\Services\Currency\CurrencyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * The visitor's local currency and its rate per 1 BDT, or {"currency": null}
     * when BDT should be shown alone. Fetched by the page after it has loaded.
     */
    public function show(Request $request, CurrencyService $currencies): JsonResponse
    {
        $local = $currencies->forRequest($request);

        return response()
            ->json($local ?? ['currency' => null])
            ->header('Cache-Control', 'private, max-age=600');
    }
}
