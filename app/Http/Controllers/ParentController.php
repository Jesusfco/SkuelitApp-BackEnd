<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Image;
use App\Schedule;
use App\Group;
use App\Qualifications;
use App\Subject;
use App\User;
use App\PermissionRequestPhoto;
use App\PermissionRequest;


class ParentController extends Controller
{
    public $auth;
    public $children = [];

    public function __construct(){
        $this->auth = JWTAuth::parseToken()->authenticate();
    }

    public function setChildren() {

        $str = explode('>', $this->auth->students_id);
        array_splice($str, count($str) - 1, 1);                      

        foreach($str as $s ) {
        
            $y = explode('<', $s);
            
            $this->children[] = User::find((int)$y[1]);
                  
        }
        
    }

    public function getOneChildren($id) {

        $u;
        foreach($this->children as $user) {
            if($user->id = $id) {
                return $user;

            }
        }
    }

    public function getChildrens() {
        $this->setChildren();
        return response()->json($this->children);
    }

    public function getSchedule($id) {
        $user = User::find($id);

        $teachers = User::where('user_type', 3)->get();
    
        $schedules = Schedule::where('group_id', $user->group_id)->get();
        $subjects = Subject::where([
            ['grade', $user->grade],
            ['school_level_id', $user->school_level_id]])->get();

        for ($i = 0; $i < count($schedules); $i++) {

            foreach($teachers as $te) {

                if($schedules[$i]->teacher_id == $te->id){

                    $schedules[$i]->teacher = $te->name . ' ' . $te->patern_surname . ' ' . $te->matern_surname;
                    break;

                }

            }

            foreach($subjects as $sub) {

                if($schedules[$i]->subject_id == $sub->id){

                    $schedules[$i]->subject = $sub->name;
                    break;

                }

            }
            
        }

        return response()->json($schedules);

    }

    public function createPermission(Request $request) {

        $permission = new PermissionRequest();
        $permission->user_id = $request->user_id;
        $permission->subject = $request->subject;
        $permission->description = $request->description;
        $permission->from = $request->from;
        $permission->to = $request->to;
        $permission->save();

        return response()->json($permission);

    }

    public function saveImagePermission(Request $request) {

        $this->validate($request, [
            'image' => 'required|image'
        ]);

        $img = $request->file('image');
        
        $path = $this->getImagePath($img->getClientOriginalName());
        $image = Image::make($img);
        
        if ($image->width() >= $image->height()) {            

            $image->resize(1300, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            $image->save(directories::getPermissionPath() . $path);


        } else { 
            $image->resize(null, 1300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            $image->save(directories::getPermissionPath() . $path);
        }

        $requestPhoto = new PermissionRequestPhoto();
        $requestPhoto->img = $path;
        $requestPhoto->permission_request_id = $request->id;
        $requestPhoto->save();

        return response()->json($requestPhoto);

    }

    public function getImagePath($name) {

        $path = '';
        $str = explode('.', $name);

        for($i = 0; $i < count($str); $i++){

            if($i == count($str) - 2){

                $path .= $str[$i] . time() . '.';

            } else if($i == count($str) - 1){

                $path .= $str[$i];

            } else {

                $path .= $str[$i] . '.';

            }

        }

        return $path;

    }


}
