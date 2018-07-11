<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receipt;
use App\Group;
use App\PaymentDates;
use App\Period;
use App\User;

class ReceiptController extends Controller
{
    public function get(Request $request) {

        $receipts = Receipt::orderBy('created_at', 'DESC')->paginate($request->pageIndex);

        $users = User::where([
            ['user_type', 1]
            ])->get();

        for($i = 0; $i < count($receipts); $i++) {

            foreach ($users as $user) {

                if($receipts[$i]->user_id == $user->id){

                    $receipts[$i]->user_name = $user->name . ' ' . $user->patern_surname . ' ' . $user->matern_surname;
                    break;

                }

            }

        }

        return response()->json($receipts);
    }

    public function sugestUser(Request $request) {

        $users = User::where([
            ['name', 'LIKE', '%' . $request->name . '%'],
            // ['patern_surname', 'LIKE', '%$request->patern_surname%'],
            // ['matern_surname', 'LIKE', '%$request->matern_surname%'],
        ])->limit(15)->get();

        return response()->json($users);

    }
}
