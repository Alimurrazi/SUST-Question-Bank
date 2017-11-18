 @extends('layouts.app')
 
@section('content')
<style type="text/css">

a.selected
{
  background-color: red;
}

</style>
<div class="container">
  <div>
             <h1>{{$user->name}}</h1>
   <img src="/img/{{$user->avatar}}" id="img" style="width: 150px; height: 150px; margin-right: 25px;">
 </div>
   @if(Auth::user())
   @if($user->id==Auth::user()->id)
    <label>Update Profile Image</label>
   <form method="post" action="/profile" class="form" accept-charset="UTF-8" enctype="multipart/form-data" style="margin-top: 0">
   <input type="file" id="file" name="avatar" style="margin-bottom: 5px">
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
   <input type="submit" class="btn btn-sm btn-primary">	
   </form>
   @endif
   @endif

<div id="nav">
  <a href="#asked">Asked Questions</a>
  <a href="#answered">Answered Questions</a>
</div>

<div id="asked" class="activity" style="display: none;">
  @foreach($asked as $asked)
  <li>
   <a href="/show_question/{{$asked->id}}">{{$asked->title}}</a>
 </li>
  @endforeach
</div>
<div id="answered" class="activity" style="display: none;">
    @foreach($answered as $answered)
  <li>
   <a href="/show_question/{{$answered->id}}">{{$answered->title}}</a>
 </li>
  @endforeach
</div>

    </div>

<script type="text/javascript">
  function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#img').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#file").change(function() {
  readURL(this);
});

$("#nav a").click(function(e){
   // e.preventDefault();
    $(".activity").hide();
    var toShow = $(this).attr('href');
    $(toShow).show();
});

$("#nav a").on('click', function(){
    $('a').removeClass('selected');
    $(this).addClass('selected');
});

</script>

@endsection
