<?php

namespace App\Http\Services;

use App\Models\Animal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnimalService
{

    public function index(){
        return Animal::query()->where('farm_id', auth()->user()->farm->id)->get();
    }

    public function store(Request $request) {
        return Animal::query()->create([
            'animal_passport' => $request->animal_passport,
            'species' => $request->species,
            'birth_date' => $request->birth_date,
            'name' => $request->name,
            'farm_id' => auth()->user()->farm->id
        ]);
    }

    public function update(Animal $animal, Request $request) {
        return $animal->update([
            'species' => $request->species,
            'birth_date' => $request->birth_date,//Carbon::createFromFormat('d/m/Y', $request->birth_date),
            'name' => $request->name,
        ]);
    }

    public function destroy(Animal $animal){
        return $animal->delete();
    }

}
