   @extends('layouts.app')

   @section('content')
   
   <head>
 <link rel="stylesheet" href="{{ URL::asset('own/lightbox/dist/css/lightbox.css')}}" />
 <!--style type="text/css">
   .thumbnail:hover {
 
   transition-duration: 100;
  border:2px solid #cccccc;

 -webkit-transition: width 2s;
   }
 </style-->
   </head> 

   <body>
 <div class="container">

 <div class="row col-xs-12 align-items-cneter">
            <div class="col-xs-2 column1">

            </div>
            <div class="col-xs-8  column2 center-block">


               <div class="jumbotron jumbotron-fluid">
                  <div class="container">

                     <form  enctype="multipart/form-data" id="upload" method="post"  action="{{action('academicArchiveController@search')}}" > 
                        {{ csrf_field() }}


                        <select  name="subject" class="form-control">
                           <option  hidden="true" value="null">Select Subject</option>
                           <option value="C">C</option>
                           <option value="java">Java</option>
                           <option value="S/w">S/W E</option>
                        </select>
                        <br>
                        <select name="semester" class="form-control" >
                           <option hidden="true" value="null">Select Semester</option>
                           <option value="1/1">1/1</option>
                           <option value="1/2">1/2</option>
                           <option value="2/1">2/1</option>
                           <option value="2/2">2/2</option>
                           <option value="3/1">3/1</option>
                           <option value="3/2">3/2</option>
                           <option value="4/1">4/1</option>
                           <option value="4/2">4/2</option>

                        </select>  
                        <br>
                        <!-- session start--> 
                        <select required="true" class="form-control" name="session" id="session">

                           <option hidden="true">Please select a Session</option>

                        </select> 


                        <script session="text/javascript">

                           var select, i, option;

                           select = document.getElementById( 'session' );

                           for ( i = 2010; i <= 2199; i += 1 ) {
                              option = document.createElement( 'option' );
                              option.value = option.text = i;
                              select.add( option );
                           }
                        </script>

                        <!-- session ended--> 
                        <br>
                        <div>
                           <button type="submit" class="btn btn-sreach btn-primary" name="add" style="margin-bottom: 50px; float: right;" ><i class="fa  fa-search fa-lg" aria-hidden="true"></i> Search</button>
                        </div>
                        
                     </form>

                  </div>
               </div>


            </div>
            <div class="col-xs-2 column3">

            </div>
         </div>






    <div class="row" style="padding-top: 100px;">
    @foreach($data as $data)
      <div class="col-md-3 ">
        <div class="thumbnail">

          <a  href="/arc/{{$data->session}}"> <button style="width: 100%;height: 100%" type="button" class="btn">Session:{{$data->session}}</button>   </a>
        </div>
      
        

      </div>
     @endforeach
    </div>
  </div>
</body>
  <script src="own/lightbox/dist/js/lightbox.js"></script>
@endsection