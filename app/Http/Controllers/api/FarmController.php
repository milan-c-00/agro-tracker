<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Services\FarmService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class FarmController extends Controller
{

    protected $farmService;

    public function __construct(FarmService $farmService)
    {
        $this->farmService = $farmService;
    }

    public function my_farm(){
        $my_farm = $this->farmService->my_farm();
        if(!$my_farm)
            return response(['message' => 'Unprocessable entity!'], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        return response($my_farm, ResponseAlias::HTTP_OK);
    }
    public function store(Request $request){
        $my_farm = $this->farmService->store($request);
        if(!$my_farm)
            return response(['message' => 'Unprocessable entity!'], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        return response($my_farm, ResponseAlias::HTTP_CREATED);
    }

}
