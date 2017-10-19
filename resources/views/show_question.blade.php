 @extends('layouts.app')
 
  @section('content')
<html>
<head>
	<title>SUST Question Bank</title>
	<style type="text/css">
		h1
		{
			text-align: center;
		}
		#tag
		{
			background-color: #808080;
			margin: 2px;
		}
	</style>
</head>
<body> 
  
     <h1>{{$question[0]->title}}</h1>
 
   <?php
       $data=$question[0]->content;
       $content=htmlspecialchars_decode($data);
       echo $content;
    ?>
  
  <div>
  @foreach($tag as $tag)
  <span id="tag">{{$tag->tag_name}}</span>
  @endforeach 
  </div>

</body>
</html>
@endsection