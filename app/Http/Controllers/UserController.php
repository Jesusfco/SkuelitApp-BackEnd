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
    public function search(Request $request) {

        $users = User::where([
            ['name', 'LIKE', '%' . $request->name . '%'],
            ['patern_surname', 'LIKE', '%' . $request->patern_surname . '%'],
            ['matern_surname', 'LIKE', '%' . $request->matern_surname . '%'],
            ])->get();

        return response()->json($users);

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

    public function store(Request $request) {

        $user = $request->user;

        $user = new User();
        $user->name = $request->name;
        $user->patern_surname = $request->patern_surname;
        $user->matern_surname = $request->matern_surname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->CURP = $request->CURP;

        if($request->password != null)
            $user->password = bcrypt($request->password);
        if((int)$request->group_id != 0 )
            $user->group_id = $request->group_id;

        $user->grade = $request->grade;
        $user->school_level_id = $request->school_level_id;
        $user->subjects_id = $request->subjects_id;
        $user->students_id = $request->students_id;
        $user->user_type = $request->user_type;
        $user->gender = $request->gender;
        $user->address_id = $request->address_id;
        $user->cash_register_id = $request->cash_register_id;
        $user->payment_type_id = $request->payment_type_id;
        $user->birthday = $request->birthday;
        
        $user->save();

        if($user->address_id == NULL) {
            $address = $this->storeAddress($request->address);
            $user->address_id = $address->id;
            $user->save();
        }

        if($user->user_type == 1 && $user->group_id != NULL) {
            
            $group = Group::find($user->group_id);
            
            if($group->students_id == NULL) {

                $group->students_id = '<' . $user->id . '>';

            } else {

                $group->students_id .= '<' . $user->id . '>';

            }

            $group->save();

        }

        return response()->json($user);

    }

    public function storeAddress($address) {

        $ad = new Address();
        $ad->street = $address['street'];
        $ad->house_number = $address['house_number'];
        $ad->city = $address['city'];
        $ad->CP = $address['CP'];
        $ad->save();

        return $ad;

    }

}
