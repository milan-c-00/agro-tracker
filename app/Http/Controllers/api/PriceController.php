<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Services\PricesService;
use App\Models\Price;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PriceController extends Controller
{
    protected $pricesService;

    public function  __construct(PricesService $pricesService){
        $this->pricesService = $pricesService;
    }

    public function index() {

        $prices = $this->pricesService->index();
        if(!$prices){
            return response(['message' => 'Unprocessable entity!'], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response($prices, ResponseAlias::HTTP_OK);

    }
    public function prices_widget() {

        $prices_widget = $this->pricesService->prices_widget();
        if($prices_widget){
            return $prices_widget;
        }
        else{
            return response(['message' => 'Not found!'], ResponseAlias::HTTP_NOT_FOUND);
        }

    }

    public function store(Request $request){
        $price = $this->pricesService->store($request);
        if(!$price)
            return response(['message' => 'Unprocessable entity!'], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        return response(['price' => $price], ResponseAlias::HTTP_CREATED);
    }

    public function update(Price $price, Request $request) {
        $updated = $this->pricesService->update($price, $request);
        if (!$updated){
            return response(['message' => 'Update failed!'], ResponseAlias::HTTP_BAD_REQUEST);
        }
        return response(['message' => 'Update successful!'], ResponseAlias::HTTP_OK);
    }

    public function destroy(Price $price) {
        $deleted = $this->pricesService->destroy($price);
        if (!$deleted){
            return response(['message' => 'Delete failed!'], ResponseAlias::HTTP_BAD_REQUEST);
        }
        return response(['message' => 'Delete successful!'], ResponseAlias::HTTP_OK);
    }

}
