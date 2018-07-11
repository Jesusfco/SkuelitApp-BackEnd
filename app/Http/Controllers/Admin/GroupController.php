<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        array_splice($str, count($str) - 1, 1);      
        
        foreach($users as $user) {

            foreach($str as $s ) {
            
                $y = explode('<', $s);
                
                if($user->id == (int)$y[1]) {
                    $students[] = $user;
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

    public function safeDelete(Request $request) {

        $group = Group::find($request->id);
        $period = Period::find($group->period_id);

        if($period->status == 1) {
            return response()->json(['group' => $group, 'safe' => true]);
        } else {
            return response()->json(['group' => $group, 'safe' => false]);
        }

    }

    public function delete($id) {

        $g = Group::find($id);
        $period = Period::find($g->period_id);

        if($period->status == 1) {
            
            $groups = Group::where([
                ['period_id', $g->period_id], 
                ['grade', $g->grade]
                ])->get();
    
                $i = 0;
    
                foreach($groups as $group) {
    
                    $group = Group::find($group->id);
                    
                    $group->group = $i;
                    
                    $group->save();
    
                    $i++;
    
                }
        
            User::where('group_id', $g->id)->update(['group_id' => NULL]);
            Schedule::where('group_id', $g->id)->delete();
            $g->delete();

            return response()->json(true);

        } else {
       
            return response()->json(false, 405);

        }

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

    public function assignGroup(Request $request) {

        $userR = $request->user;
        $groupR = $request->group;

        

        $group = Group::find($groupR['id']);
        $user = User::find($userR['id']);;

        

        $group->students_id = $groupR['students_id'];
        $group->save();

        if($user->group_id == NULL )
            $user->group_id = $group->id;
        else if($user->group_id != NULL)
            $user->group_id = NULL;
        $user->save();

        return response()->json($group->students_id);
        return response()->json(true);

    }

    public function getSchedules($id) { 

        $group = Group::find($id);

        $teachers = User::where('user_type', 3)->get();

        $schedules = Schedule::where('group_id', $id)->get();

        for ($i = 0; $i < count($schedules); $i++) {

            foreach($teachers as $te) {

                if($schedules[$i]->teacher_id == $te->id){

                    $schedules[$i]->teacher = $te->name . ' ' . $te->patern_surname . ' ' . $te->matern_surname;
                    break;

                }

            }
            
        }

        return response()->json($schedules);

    }

    public function searchTeachers(Request $request) {
        $users = User::where([
            ['name', 'LIKE', '%' . $request->name . '%'],
            ['patern_surname', 'LIKE', '%' . $request->patern_surname . '%'],
            ['matern_surname', 'LIKE', '%' . $request->matern_surname . '%'],
            ['user_type', 3],
            ])->get();

        return response()->json($users);
    }
}
