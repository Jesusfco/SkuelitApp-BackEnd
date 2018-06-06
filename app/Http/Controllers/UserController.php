<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Address;
use JWTAuth;

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

}
