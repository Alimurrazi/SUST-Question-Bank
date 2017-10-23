<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;

class VotingController extends Controller
{
    public function submit(Request $request)
    {
       //echo "hello";
       //echo $request->ques_id;
       //DB::table('')
       if($request->action=="up")
       {
         DB::table('questions')->where('id','=',$request->ques_id)->increment('upvote');
       }
       else
       {
          DB::table('questions')->where('id','=',$request->ques_id)->decrement('upvote');
       }
    }
}
