   @extends('layouts.app')

   @section('content')
   
   <head>
 <link rel="stylesheet" href="{{ URL::asset('own/lightbox/dist/css/lightbox.css')}}" />
 <!--style type="text/css">
   .thumbnail:hover {
   transform: scale(1.05,1.02);
   transition-duration: 100;
  border:2px solid #cccccc;
  border-radius: 5px;
 -webkit-transition: width 2s;
   }
 </style-->
   </head> 

   <body>
 <div class="container">

    <div class="row" style="padding-top: 100px;">
    @foreach($data as $data)
      <div class="col-md-3 ">
        <div class="thumbnail">
          <a href="{{$data->file}}"  data-lightbox="roadtrip" data-title= " {{$data->subject}} , {{$data->session}}, {{$data->semester}} "><img class="img-rounded" src="{{$data->file}}"></a> 
        </div>
      </div>
     @endforeach
   
    </div>
  </div>
</body>

  <script src="{{ URL::asset('own/lightbox/dist/js/lightbox.js')}}"></script>
@endsection