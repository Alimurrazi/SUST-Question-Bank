@extends('layouts.app')

@section('content')
<style type="text/css">
	.single-ques
	{
		background-color: #E1E1E1;
		margin: 5px;
		text-align: center;
		text-decoration: none;
    padding: 5px; 
	}
	.title
	{
		font-size: 30px;
		text-align: center;
		margin-bottom: 10px;
    color: #6D9C91;
	}
  img
  {
    height: 60px;
  }
  #date
  {
    padding:0;
    text-align: left;
    display: inline;
    padding-right: 35%;
  }
  #answer
  {
    padding:0;
    text-align: right;
    display: inline;
    padding-left: 35%;
  }
  #dateAnswer
  {
    margin-top: 10px;
  }
  #all_tag 
  {
    float: left;
  }
  .tag
  {
    background-color: #b9a7a7;
    padding: 5px;
  }

</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Latest Question</h1></div>
                <div class="panel-body">
                  <?php
                   $i=0;
                  ?>
                @foreach($list as $list)
   <a href="/show_question/{{$list->id}}">
   <div class="single-ques">                
                <div class="title">{{$list->title}}</div>
                <div id="clear"></div> 
                  <?php
       $data=$list->content;
       $content=htmlspecialchars_decode($data);
       echo $content;
                  ?>
                  <div id="clear"></div>
                  <div id="all_tag">
                   
                  @php
                  $newtag = json_decode($ques_tag[$list->id], true);
                  @endphp
                  @foreach($newtag as $ntag) 
                  <span class="tag">{{$ntag["tag_name"]}}</span>
                  @endforeach

                  </div>
                  <br>
                  <div id="dateAnswer">
                    <div id="date">{{$list->created_at}}</div>
                    <div id="answer">
                    @if($total_answer[$loop->index]==0)  
                    no answer yet
                    @else
                    {{$total_answer[$loop->index]}} Comments
                    @endif
                  </div>
                </div>

                 </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
