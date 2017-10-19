@extends('layouts.app')

@section('content')
<style type="text/css">
	.single-ques
	{
		background-color: #E1E1E1;
		margin: 5px;
		text-align: center;
		text-decoration: none;

	}
	.title
	{
		font-size: 20px;
		text-align: center;
		margin-bottom: 5px;

	}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Latest Question</div>
                <div class="panel-body">
                @foreach($list as $list)
   <a href="/show_question/{{$list->id}}">
   <div class="single-ques">                
                <div class="title">{{$list->title}}</div> 
                  <?php
       $data=$list->content;
       $content=htmlspecialchars_decode($data);
       echo $content;
                  ?>
                 </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
