<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Services\AnimalService;
use App\Models\Animal;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AnimalController extends Controller
{

    protected $animalService;

    public function __construct(AnimalService $animalService){
        $this->animalService = $animalService;
    }

    public function index() {
        $livestock = $this->animalService->index();
        if(!$livestock)
            return response(['message' => 'Unprocessable entity!'], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        return response($livestock, ResponseAlias::HTTP_OK);
    }

    public function store(Request $request){
        $animal = $this->animalService->store($request);
        if(!$animal)
            return response(['message' => 'Unprocessable entity!'], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        return response($animal, ResponseAlias::HTTP_CREATED);
    }

    public function update(Animal $animal, Request $request){
        $updated = $this->animalService->update($animal, $request);
        if (!$updated){
            return response(['message' => 'Update failed!'], ResponseAlias::HTTP_BAD_REQUEST);
        }
        return response(['message' => 'Update successful!'], ResponseAlias::HTTP_OK);
    }

    public function destroy(Animal $animal){
        $deleted = $this->animalService->destroy($animal);
        if (!$deleted){
            return response(['message' => 'Delete failed!'], ResponseAlias::HTTP_BAD_REQUEST);
        }
        return response(['message' => 'Delete successful!'], ResponseAlias::HTTP_OK);
    }


}
