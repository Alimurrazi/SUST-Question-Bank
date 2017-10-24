 @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
             <h1>My Profile</h1>
<img src="/img/{{$user->avatar}}" id="img" style="width: 150px; height: 150px; float:left;border-radius: 50%; margin-right: 25px;">

   <form method="post" action="/profile" class="form" accept-charset="UTF-8" enctype="multipart/form-data">
 
   <label>Update Profile Image</label>
   <input type="file" id="file" name="avatar">
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
   <input type="submit" class="pull-right btn btn-sm btn-primary">	

   </form>
        </div>
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
</script>

@endsection
