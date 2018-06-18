<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PermissionRequest;
use App\PermissionRequestPhoto;
use App\User;

class PermissionRequestController extends Controller
{
    public function get(Request $request) {

        $users = User::all();
        $permission = PermissionRequest::all();

        for($i = 0; $i < count($permission); $i++) {
            
            foreach($users as $u) {
                
                if($u->id == $permission[$i]->user_id) {
                    $permission[$i]->user_name = $u->name . ' ' . $u->patern_surname . ' ' . $u->matern_surname;
                    break;
                }

            }

        }

        return response()->json($permission);

    }

    public function show(Request $request) {
        $permission = PermissionRequest::find($request->id);
        $user = User::find($permission->user_id);
        $permission->user_name = $user->name . ' ' . $user->patern_surname . ' ' . $user->matern_surname;
        $permission->photos = PermissionRequestPhoto::where('permission_request_id', $permission->id)->get();

        return response()->json($permission);

    }

    public function validatePermission(Request $request) {
        $permission = PermissionRequest::find($request->id);
        $permission->confirmed = true;
        $permission->save();
        return response()->json(true);
    }

    public function negate(Request $request) {
        $permission = PermissionRequest::find($request->id);
        $permission->confirmed = false;
        $permission->save();
        return response()->json(true);
    }

}
