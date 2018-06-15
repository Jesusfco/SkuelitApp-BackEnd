<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;

class ScheduleController extends Controller
{
    public function store(Request $request) {

        if($request->id != NULL){
            $schedule = Schedule::find($request->id);
        } else {
            $schedule = new Schedule();
        }

        $schedule->check_in = $request->check_in;
        $schedule->check_out = $request->check_out;
        $schedule->group_id = $request->group_id;
        $schedule->subject_id = $request->subject_id;
        $schedule->teacher_id = $request->teacher_id;
        $schedule->day = $request->day;
        $schedule->save();

        return response()->json($schedule);

    }

    public function delete($id) {
        Schedule::find($id)->delete();
        return response()->json(true);
    }

}
