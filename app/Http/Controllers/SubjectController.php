<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Schedule;
use App\Group;

class SubjectController extends Controller
{
    
    public function get(Request $request) {

        $subjects = Subject::all();
        return response()->json($subjects);

    }

    public function store(Request $request) {

        $s = new Subject();
        $s->name = $request->name;
        $s->grade = $request->grade;
        $s->school_level_id = $request->school_level_id;
        $s->save();

        return response()->json($s);

    }

    public function update(Request $request) {

        $s = Subject::find($request->id);
        $s->name = $request->name;
        $s->grade = $request->grade;
        $s->school_level_id = $request->school_level_id;
        $s->save();

        return response()->json($s);

    }

    public function delete($id) {

        $subject = Subject::find($id);

        $sch = Schedule::where([['subject_id', $id]])->get();
        $group = Group::where('subjects_id', 'LIKE', '%<'.$id.'>%')->get();

        
        if(count($sch) != 0 || count($group) != 0) {
            return response()->json(false);    
        }

        $subject->delete();
        return response()->json(true);
    }
}
