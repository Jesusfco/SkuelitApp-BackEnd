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
use App\Message;
use App\Conversation;
use App\Events\Test;

class StudentController extends Controller
{
    public $auth;
    public $parents;
    public $group;
    

    public function __construct(){
        $this->auth = JWTAuth::parseToken()->authenticate();
    }

    public function setParents() {
        $this->parents = User::where('students_id', 'LIKE', '%<' . $this->auth->id . '>%')->get();
    }

    public function setGroup(){
        if($this->auth->group_id > 0) {
            $this->group = Group::find($this->auth->group_id);
        }
    }

    public function schedule() {
    
        $teachers = User::where('user_type', 3)->get();

        $schedules = Schedule::where('group_id', $this->auth->group_id)->get();
        $subjects = Subject::where([
            ['grade', $this->auth->grade],
            ['school_level_id', $this->auth->school_level_id]])->get();

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

}

    
    

