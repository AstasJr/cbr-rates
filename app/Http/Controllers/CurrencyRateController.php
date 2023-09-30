<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRateRequest;
use App\Models\Currency;
use App\Models\CurrencyRate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class CurrencyRateController extends Controller
{
    public function index(CurrencyRateRequest $request)
    {
        $currencyCode = $request->input('code');
        $currency = Currency::where('code', $currencyCode)->first();
        if (!$currency) {
            return response()->json(['error' => 'Currency not found'], 404);
        }

        $date = $request->input('date');
        $previousDate = Carbon::parse($date)->subDay()->format('Y-m-d');

        $cacheKey = "currency_rate_{$currency->id}_{$date}";
        if (Cache::has($cacheKey)) {
            $rate = Cache::get($cacheKey);
        } else {
            $rate = CurrencyRate::where('currency_id', $currency->id)
                ->where('date', $date)
                ->first();
        }

        $previousCacheKey = "currency_rate_{$currency->id}_{$previousDate}";
        if (Cache::has($previousCacheKey)) {
            $previousRate = Cache::get($previousCacheKey);
        } else {
            $previousRate = CurrencyRate::where('currency_id', $currency->id)
                ->where('date', $previousDate)
                ->first();
        }

        $diff = $rate->rate - $previousRate->rate;
        $rate->diff = round($diff, 4);

        $result = [
            'value' => floatval($rate->rate),
            'diff' => $rate->diff,
        ];

        return response()->json($result);
    }
}
