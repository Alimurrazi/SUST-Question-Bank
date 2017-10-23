<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;
use App\Answer;

class AnswerSubmitController extends Controller
{
    public function submit($id,Request $request)
    {
    	//echo Input::all();
      $msg = $request->comment;

      $user=DB::table('users')
            ->where('id','=',Auth::user()->id)
            ->first();

      $name=$user->name;
      $image=$user->avatar;
/*
 DB::table('answers')->insert(
    ['user_id' => Auth::user()->id,'ques_id'=> $id,'content'=>$msg]
);
*/
     
     $answer=new Answer;
     $answer->user_id=Auth::user()->id;
     $answer->ques_id=$id;
     $answer->content=$msg;
     $answer->save();

      return response()->json(array('msg'=> $msg,'name'=>$name,'image'=>$image), 200);
    }
}
