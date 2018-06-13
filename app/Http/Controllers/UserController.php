<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Address;
use App\PaymentType;
use JWTAuth;
use App\Group;
use App\Period;


class UserController extends Controller
{
    
    public function store(Request $request) {



    }

    public function update(Request $request) {



    }

    public function get(Request $request) {



    }
    
    public function checkUniqueEmail(Request $request) {
        
        $user =  User::where('email', $request->email)->first();
        if($user == NULL) return response()->json(true);
        else return response()->json(false);

    }

    public function posibleGroups(Request $request) {

        $periods = Period::where([['school_level_id', $request->school_level_id], ['status', '<', 3] ])->get();
        $groups = [];

        foreach($periods as $p) {
            $gro = Group::where([['period_id', $p->id], ['grade', $request->grade]])->get();

            foreach($gro as $g) {
                $groups[] = $g;
            }
        }

        return response()->json(['periods' => $periods, 'groups'=> $groups]);

    }

    public function posiblePayments(Request $request) {
        return response()->json(PaymentType::where([
                ['period_type_id', $request->period_type_id],
                ['school_level_id', $request->school_level_id],
            ])->get());
    }

}
