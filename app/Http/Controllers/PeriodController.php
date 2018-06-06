<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Period;
use App\Partial;

class PeriodController extends Controller
{
    public function getPeriods(Request $request) {
        $periods = Period::orderBy('from', 'ASC')->get();
        return response()->json($periods);
    }

    public function storePeriod(Request $request) {

        $period = new Period();
        $period->from = $request->from;
        $period->to = $request->to;
        $period->partials = $request->partials;
        $period->save();

        for($i = 0; $i < $period->partials; $i++) {
            
            $partial = new Partial();
            $partial->period_id = $period->id;
            $partial->partial =  $request->partialsArray[$i]['partial'];
            $partial->from = $request->partialsArray[$i]['from'];
            $partial->to = $request->partialsArray[$i]['to'];
            $partial->save();

        }

        return response()->json($period);

    }

    public function show($id){
        $period = Period::find($id);
        $partials = Partial::where('period_id', $id)->get();
        $period->partialsArray =  $partials;
        return response()->json($period);
    }
    public function update(Request $request) {

        $period = Period::find($request->id);
        $period->from = $request->from;
        $period->to = $request->to;
        $period->save();

        for($i = 0; $i < $period->partials; $i++) {
            
            $partial = Partial::find($request->partialsArray[$i]['id']);            
            $partial->from = $request->partialsArray[$i]['from'];
            $partial->to = $request->partialsArray[$i]['to'];
            $partial->save();

        }

        return response()->json($period);
    }
}
