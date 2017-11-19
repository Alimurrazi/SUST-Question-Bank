<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use DB;

class QuestionEditController extends Controller
{
    public function index($id)
    {
    	$ques_content=DB::table('questions')
    	              ->where('id','=',$id)
    	              ->value('content');
    	$update=1;
    	return view::make('ask_question')->with('update',$update)->with('ques_id',$id)->with('ques_content',$ques_content);
    }
}
