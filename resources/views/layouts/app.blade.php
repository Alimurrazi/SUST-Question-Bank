<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Question Bank</title>

    <!-- Styles --> 
    <link href="/css/app.css" rel="stylesheet">
   <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href={{ URL::asset('welcome/css/style.css')}} rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript" src={{ URL::asset('js/notification.js') }}></script>


    <style type="text/css">
        #clear
        {
            margin:10px;
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
         #number_notification
         {
            position: absolute;
            z-index: 100;
            width: 30px;
            height: 30px;
            border-radius:50%;
            background-color: green;
            color: white;
            padding: 2px;
            text-align: center;
         }
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

    <div id="app">
        @if(Auth::user())
        <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
        @endif
        <nav class="navbar navbar-default navbar-static-top" style="background-color: #f5f5f5">
            <div class="container">

                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                            <div class="navbar-brand">
                                <a href="{{url('/')}}"><h1 style="margin-top: 5px">Question Bank</h1></a>
                            </div>


                                            <div class="menu">
                            <ul class="nav nav-tabs" role="tablist">
                <!--    <li role="presentation" class="active"><a href="index.html">Home</a></li> -->
                                <li role="presentation"><a href="{{url('/tag')}}">Tags</a></li>
                                <li role="presentation"><a href="{{url('/home')}}">Questions</a></li>
                            <li role="presentation"><a href="{{url('/ask_question')}}">Ask Question</a></li>
                            <li role="presentation"><a href="{{url('/users')}}">users</a></li>
                                <li role="presentation"><a href="{{url('#')}}">Academic Archieve</a>
                                @if(Auth::user())
                                <li role="presentation" id="notification">
                            <span id="number_notification"></span>
                                    <a href="#">Notification</a>

                                </li>
                                @endif
                            </ul>
                        </div>
 
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right" style="margin-top: 15px;margin-right: 0px">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position: relative;padding-left: 50px">
                                    <img src="/img/{{Auth::user()->avatar}}" style="width: 35px;height: 35px;position: absolute;top: 10px;left: 10px;border-radius: 50%">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
    <li><a href="/profile/{{Auth::user()->id}}">Profile<i class="fa fa-btn fa-user" style="padding-left: 8px;"></i></a></li>                                 
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="container">
            
          <!-- Modal-->
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
        @yield('content')
        </div>
    </div>

    <!-- Scripts -->
  <!--  <script src="/js/app.js"></script>  -->
</body>
</html>
