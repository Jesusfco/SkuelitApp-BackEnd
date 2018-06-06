<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Period;
use App\Partial;

class PeriodController extends Controller
{
    public function getPeriods(Request $request) {

    }

    public function storePeriod(Request $request) {

        $period = new Period();
        $period->from = $request->period['from'];
        $period->to = $request->period['to'];
        $period->partials = $request->period['partials'];
        $period->save();

        for($i = 0; $i < $period->partials; $i++) {
            
            $partial = new $partial();
            $partial->period_id = $period->id;
            $partial->partial =  $i + 1;
            $partial->from = $request->partials[$i]['from'];
            $partial->to = $request->partials[$i]['to'];
            $partial->save();

        }

        return response()->json($period);

    }
}
