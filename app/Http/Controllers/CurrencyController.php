<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CurrencyResource;
use App\Http\Resources\CurrencyCharCodeResource;
use App\Http\Resources\CurrencyHistoryResource;
use App\Models\Currency;
use App\Models\CurrencyRate;

class CurrencyController extends Controller {

    /**
     * Return list of currencies.
     */
    public function index(Request $request) {
        $date = CurrencyRate::max('date');

        $currencies = Currency::query()
                ->leftJoin('currency_rates', function ($join) use ($date) {
                    $join->on('currency_rates.currency_id', '=', 'currencies.id')
                    ->where('currency_rates.date', $date);
                })
                ->selectRaw('currencies.*, currency_rates.rate')
                ->paginate($request->per_page ?? 10)
                ->setPath(null);

        return CurrencyResource::collection($currencies);
    }

    /**
     * Return list of  char codes.
     */
    public function charCodes() {

        $charCodes = Currency::select('char_code')
                ->get();

        return CurrencyCharCodeResource::collection($charCodes);
    }

    /**
     * Return list of  currency history.
     */
    public function history(Request $request) {
        $dailyRates = CurrencyRate::query()
                ->whereHas('currency', function($query) use($request) {
                    $query->where('char_code', $request->charCode);
                })
                ->orderBy('date', 'desc');

        if ($request->dt_from && $request->dt_to) {
            $dailyRates->whereBetween('date', [$request->dt_from, $request->dt_to]);
        }

        $res = $dailyRates->paginate($request->per_page ?? 10)
                ->setPath(null);

        return CurrencyHistoryResource::collection($res);
    }

}
