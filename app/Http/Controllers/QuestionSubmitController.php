<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input; 
use Illuminate\Http\Request;
use View;
use Auth;
use App\question;

class QuestionSubmitController extends Controller
{
    public function submit(Request $request)
    {
    	// return Input::all();
       $title=Input::get('title');
       $content=Input::get('myDoc');
       $content=htmlspecialchars($content);
      // $content=htmlspecialchars_decode($content);

      // echo $content;
       
       $question=new question;
       $question->user_id=Auth::user()->id;
       $question->content=$content;
       $question->date=time();
       $question->save(); 
 
       return view::make('show_question')->with('content',$content)->with('title',$title);
    }
}
