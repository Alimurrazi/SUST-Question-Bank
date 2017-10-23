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
      
      return Input::all();

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
/*
      $users = DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();
*/
         $question=DB::table('questions')
                   ->where('id','=',$id)
                   ->get();

         $tag=DB::table('tag_relations')
              ->join('tags','tag_relations.tag_id','=','tags.id')
                  ->where('question_id','=',$id)
                  ->get();

         $answer=DB::table('answers')
                 ->join('users','answers.user_id','=','users.id')
                 ->where('ques_id','=',$id)
                 ->get();         

  return view::make('show_question')->with('question',$question)->with('tag',$tag)->with('answer',$answer);

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