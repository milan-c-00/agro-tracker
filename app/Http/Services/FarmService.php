<?php

namespace App\Http\Services;

use App\Models\Farm;
use Illuminate\Http\Request;
class FarmService
{

    public function my_farm(){
        return Farm::query()->where('user_id', auth()->user()->id)->get();
    }
    public function show(Farm $farm) {
        return Farm::query()->where('id', $farm->id)->get();
    }

    public function store(Request $request) {
        return Farm::query()->create([
            'farm_number' => $request->farm_number,
            'user_id' => auth()->user()->id,
            'address' => $request->address
        ]);
    }

    public function update(Farm $farm, Request $request) {

    }

    public function delete(){

    }

}
