<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Period;
use App\Group;
use App\User;
use App\Subject;
use App\Schedule;
use App\SchoolLevel;
use App\SchoolLevelModality;

class GroupController extends Controller
{
    
    public function getPeriods() {
        return response()->json(Period::orderBy('from', 'DESC')->get());
    }

    public function getLevels(){
        return response()->json(SchoolLevel::all());
    }

    public function getSchoolLevelModalities(){
        return response()->json(SchoolLevelModality::all());
    }

    public function show($id) { 
        $group = Group::find($id);
        $students = [];

        $users = User::where('user_type', 1)->get();


        $str = explode('>', $group->students_id);
        array_splice($str, count($str), 1);
        
        foreach($users as $user) {

            foreach($str as $s ) {
            
                $y = explode('<', $s);

                if(isset($y[1])) {

                    if($user->id == (int)$y[1]) {
                        $students[] = $user;
                    }

                }
    
            }

        }
        
        return response()->json(['group' => $group, 'students' => $students ]); 

    }

    public function posibleStudents($id) {
        $group = Group::find($id);
        $users = User::where([
            ['user_type', 1],
            ['grade', $group->grade], 
            ['school_level_id', $group->school_level_id], 
            ['group_id', NULL]])->get();
        return response()->json($users);
    }

    public function getGroups(Request $request) {

        $groups = Group::where('period_id',  $request->id )->get();
        return response()->json($groups);

    }

    public function storeGroup(Request $request) {

        $group = new Group();
        $group->grade =  $request->grade;
        $group->group =  $request->group;
        $group->period_id =  $request->period_id;
        $group->school_level_id =  $request->school_level_id;
        $group->save();

        return response()->json($group);

    }

    public function storeGroups(Request $request) {

        $groups = [];

        foreach($request->groups as $g) {

            $group = new Group();
            $group->grade =  $g['grade'];
            $group->group =  $g['group'];
            $group->period_id = $g['period_id'];
            $group->school_level_id =  $g['school_level_id'];
            $group->save();

            $groups[] = $group;

        }

        return response()->json($groups);


    }

    public function deleteGroup($id) {

        $g = Group::find($id);

        if($g->students_id == NULL) {
            $g->delete();
            return response()->json(true);
        }

        return response()->json(true, 401);
        

    }

    public function getAllSubjects($id) {

        $g = Group::find($id);
        $subject = Subject::where([
            ['grade', $g->grade],
            ['school_level_id', $g->school_level_id],
        ])->get();

        return response()->json($subject);
    }

    public function updateSubjects(Request $request) {

        $group = Group::find($request->id);
        $group->subjects_id = $request->subjects_id;
        $group->save();

        return response()->json(true);

    }

}
