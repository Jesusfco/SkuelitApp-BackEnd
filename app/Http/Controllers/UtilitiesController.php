<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SchoolLevel;

class UtilitiesController extends Controller
{
    public function schoolLevels(){
        return response()->json(SchoolLevel::all());
    }
}
