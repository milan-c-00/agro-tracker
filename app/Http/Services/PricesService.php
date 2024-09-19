<?php

namespace App\Http\Services;

use App\Models\Price;
use Illuminate\Http\Request;

class PricesService
{

    public function index() {
        return Price::query()->get();
    }

    public function prices_widget() {

        $prices = Price::query()->take(3)->get();
        return $prices;

    }

    public function store(Request $request) {
        $price = Price::query()->create([
            'product' => $request->product,
            'price' => $request->price
        ]);
        return $price;
    }

    public function update(Price $price, Request $request) {
        return $price->update([
            'price' => $request->price,
            'dif' => ($request->price - $price->price)
        ]);
//        return $updated_price;
    }

    public function destroy(Price $price) {
        return $price->delete();
    }

}
