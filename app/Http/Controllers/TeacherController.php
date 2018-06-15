<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

use App\Schedule;
use App\Group;
use App\Qualifications;
use App\Subject;
use App\User;

class TeacherController extends Controller
{
    public $auth;

    public function __construct(){
        $this->auth = JWTAuth::parseToken()->authenticate();
    }

    public function schedule() {
    
        $schedules = Schedule::where('teacher_id', $this->auth->id)->get();

        if(isset($schedules[0])) {

            $group = Group::find($schedules[0]->group_id);
            $subjects = Subject::where([
                ['grade', $group->grade],
                ['school_level_id', $group->school_level_id]])->get();

            for ($i = 0; $i < count($schedules); $i++) {

                foreach($subjects as $sub) {
    
                    if($schedules[$i]->subject_id == $sub->id){
    
                        $schedules[$i]->subject = $sub->name;
                        break;
    
                    }
    
                }
                
            }

        }

        return response()->json($schedules);

    }
   
}
