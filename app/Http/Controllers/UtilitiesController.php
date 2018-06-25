<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SchoolLevel;
use App\User;
use Image;
use JWTAuth;
use File;

class UtilitiesController extends Controller
{
    public function schoolLevels(){
        return response()->json(SchoolLevel::all());
    }

    public function saveImageProfile(Request $request) {

        $this->validate($request, [
            'image' => 'required|image'
        ]);

        $auth = JWTAuth::parseToken()->authenticate();

        $img = $request->file('image');
        $path = $this->getImagePath($img->getClientOriginalName());

        $image = Image::make($img);                

        // $image->resize(250, 250, function ($constraint) {
        //     $constraint->aspectRatio();
        //     $constraint->upsize();
        // });
        
        $image->fit(250, 250);

        $image->save(directories::getUserPath() . $path);

        $user = User::find($auth->id);

        if($user->img != NULL) {
            File::delete(directories::getUserPath() . $user->img);
        }
        $user->img = $path;
        $user->save();

        return response()->json($path);
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
