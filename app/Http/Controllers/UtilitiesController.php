<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SchoolLevel;
use App\User;
use App\Message;
use App\Conversation;
use App\Events\NewMessage;
use Image;
use JWTAuth;
use File;

class UtilitiesController extends Controller
{

    public $auth;

    public function __construct(){
        $this->auth = JWTAuth::parseToken()->authenticate();
    }

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

    public function getConversation(Request $request) {
            
        $conversation = Conversation::where([ 
            ['users_id', 'LIKE', '%<' . $request->id1 . '>%'],
            ['users_id', 'LIKE', '%<' . $request->id2 . '>%'],
            ])->first();

        return response()->json($conversation);
    }

    public function createConversation(Request $request) {

        $conversation = new Conversation();
        $conversation->users_id = '<' . $request->id1 . '>' . '<' . $request->id2 . '>';
        $conversation->save();

        return response()->json($conversation);

    }

    public function getMessages(Request $request) {

        $messages = Message::where('conversation_id', $request->id)->get();

        return response()->json($messages);

    }

    public function sentMessage(Request $request) {

        $message = New Message();

        $message->message = $request->message;
        $message->from_id = $request->from_id;
        $message->conversation_id = $request->conversation_id;
        $message->created_at = date_create();
        $message->save();

        event(new NewMessage($message));

        return response()->json($message);

    }

    public function undefinedContact($id) {

        return response()->json(User::find($id));

    }

    public function setMessagesRead(Request $request) {

        Message::where([
            ['from_id', '<>', $this->auth->id],
            ['conversation_id', $request->id]
            ])->update(['checked' => true]);

        return response()->json(true);

    }

}
