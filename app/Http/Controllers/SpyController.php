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

    public function list(Request $request){
        $filters = $request->input('filters') ?? [];
        $sorting = $request->input('sort')?? [];
        $fetch = $request->input('fetch')?? null;

        try {
            $qry='';
            foreach ($filters as $filter){
                if($filter == 'name'){
                    $qry .= ' name = "'. $request->input('name') .'" AND ';
                }elseif($filter == 'surname'){
                    $qry .= ' surname = "'. $request->input('surname').'" AND ';
                }
                elseif($filter == 'exact_age'){
                    $qry .= ' TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) = '.$request->input('age').' AND ';
                }elseif($filter == 'range_age'){
                    $qry .= ' TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >= '.$request->input('from'). ' AND TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) <= '.$request->input('to').' AND ';
                }
                else{
                    return response()->json('Not a supported filter', 500);
                }
            }
            $qry = rtrim($qry, ' AND ');
            if($qry == '') $qry = '1=1';
            $spies = SpyModel::whereRaw($qry);
            foreach ($sorting as $sort){
                if($sort == 'fullname'){
                    $spies = $spies->orderBy('name','desc')->orderBy('surname', 'desc');
                }elseif($sort == 'date_of_birth'){
                    $spies = $spies->orderBy('date_of_birth', 'desc');
                }elseif($sort == 'date_of_death'){
                    $spies = $spies->orderBy('date_of_death', 'desc');
                }else{
                    return response()->json('Not a supported sort', 500);
                }
            }


            if($fetch){
                $spies = $spies->paginate($fetch)->getCollection();
            }else{
                $spies = $spies->get();
            }
        }catch (\Exception $ex){
            return response()->json($ex->getMessage(), 500);

        }
        return response()->json($spies, 200);
    }
}
