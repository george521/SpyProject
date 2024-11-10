<?php

namespace App\Http\Controllers;

use App\Models\Spy as SpyModel;
use Illuminate\Http\Request;

class SpyController
{
    public function create(Request $request){
        try {
            $spy = SpyModel::createSpy([
                'name' => $request->input('firstname'),
                'surname' => $request->input('surname'),
                'agency' => $request->input('agency'),
                'country_of_operation' => $request->input('country_of_operation'),
                'date_of_birth' => $request->input('date_of_birth'),
                'date_of_death' => $request->input('date_of_death'),
            ]);
        }catch (\Exception $ex){
            return response()->json($ex->getMessage(), 500);

        }
        return response()->json($spy, 201);
    }

    public function random(Request $request){
        try {
            $spies = SpyModel::inRandomOrder()->limit(5)->get();
        }catch (\Exception $ex){
            return response()->json($ex->getMessage(), 500);

        }
        return response()->json($spies, 200);
    }

}
