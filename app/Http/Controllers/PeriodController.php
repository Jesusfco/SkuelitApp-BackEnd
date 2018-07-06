<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Period;
use App\Partial;
use App\PeriodsTypes;

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
        $period->period_type_id = $request->period_type_id;
        $period->school_level_id = $request->school_level_id;
        $period->status = 1;
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
        $period->status = $request->status;
        $period->save();

        for($i = 0; $i < $period->partials; $i++) {
            
            $partial = Partial::find($request->partialsArray[$i]['id']);            
            $partial->from = $request->partialsArray[$i]['from'];
            $partial->to = $request->partialsArray[$i]['to'];
            $partial->save();

        }

        return response()->json($period);

    }

    public function checkDelete(Request $request) {

        $period = Period::find($request->id);
        $groups = Group::where('period_id', $period->id)->get();

        if($period->status == 1) {

            return response()->json(['safe' => true, 'groups' => count($groups)]);

        }   else {

            return response()->json(['safe' => false, 'groups' => count($groups)]);
        }

    }

    public function delete(Request $request) {

        $period = Period::find($request->id);

        if($period->status == 1) {

            $groups = Group::where('period_id', $period->id)->get();

            foreach($groups as $group) {                        

                User::where('group_id', $group->id)->update(['group_id' => NULL]);

            }

            $period->delete();
            $groups->delete();

            return response()->json(true);

        } else {

            return response()->json(false, 405);

        }

    }

    public function getPeriodsType() {
        return response()->json(PeriodsTypes::all());
    }
}
