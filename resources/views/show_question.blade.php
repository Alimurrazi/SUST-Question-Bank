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
	</style>
</head>
<body>
     
     <h1>{{$title}}</h1>

   <?php
       $content=htmlspecialchars_decode($content);
       echo $content;
    ?>


</body>
</html>
@endsection