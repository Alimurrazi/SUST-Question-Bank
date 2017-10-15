<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input; 
use Illuminate\Http\Request;
use View;
use Auth;
use DB;
use App\question;
use App\tag_relation;

class QuestionSubmitController extends Controller
{

    public function submit(Request $request)
    {
       $data=DB::table('questions')
             ->where('user_id','=',Auth::user()->id)
             ->where('id','=',Input::get('ques_id'))
             ->count();

        if($data==0)
        {

       $title=Input::get('title');
       $content=Input::get('myDoc');
       $content=htmlspecialchars($content);

       $question=new question;
       $question->user_id=Auth::user()->id;
       $question->title=$title;
       $question->content=$content;
       $question->date=time();
       $question->save();
       
        foreach ($request->tag_id as $tag_id)
        {
            $tag_relation=new tag_relation;
            $tag_relation->question_id=Input::get('ques_id');
            $tag_relation->tag_id=$tag_id;
            $tag_relation->save();    
        }


        }

       return $this->show(Input::get('ques_id'));
    }

     public function show ($id)
     {
         $question=DB::table('question')
                   ->where('id','=',$id)
                   ->get();

     }

}


/*
$image = Input::file($i.'_'.$j.'_image');
    $original_name = $image->getClientOriginalName();
    $image_extension= $image->getClientOriginalExtension();
        $image->move(public_path().'/'.'temporary'.'/'.$i.'/'.$j.'/',$candidate_name.'.'.$image_extension);


$filename = "";
        if(Input::hasFile('image'))
        {
        $file = Input::file('image');

        $destinationPath = public_path(). '/images/';
        $filename = $file->getClientOriginalName();

        $file->move($destinationPath, $filename);
       }
       */