<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use Image;
use View;

class UserController extends Controller
{
    public function profile($id)
    {
      $user=DB::table('users')
            ->where('id','=',$id)
            ->first();

      $asked=DB::table('questions')
             ->where('user_id','=',$id)
             ->get();

      $answered=DB::table('questions')
                ->join('answers','questions.id','=','answers.ques_id')
                ->where('answers.user_id','=',$id)
                ->select('questions.id','questions.title')
                ->distinct()
                ->get();

    return view::make('profile')->with('user',$user)->with('asked',$asked)->with('answered',$answered);
    }

    public function update(Request $request)
    {
       if(Input::hasFile('avatar')) 
      //  if($request->file('avatar'))
       {
       	$avatar=$request->file('avatar');
       	$filename=time().'.'.$avatar->getClientOriginalExtension();
     Image::make($avatar)->resize(300,300)->save(public_path('/img/'.$filename));

        $user=Auth::user();
        $user->avatar=$filename;
        $user->save();
       }

       return view('profile',array('user'=>Auth::user()));
    }
}
