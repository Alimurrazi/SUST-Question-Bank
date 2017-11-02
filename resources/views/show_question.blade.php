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
    p
    {
      margin: 0;
      padding: 0;
    }
		#tag
		{
			background-color: #808080;
			margin: 2px;
		}
		.vote-span{
  width: 60px;
  float: left;
  margin: 5px 0;
}
.vote, .vote-score{
  clear: both;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
  cursor: pointer;
  text-align: center;
  color: #333;
  font-size: 1.8em;
  font-weight: bold;
}
.vote-score{cursor: text}
	</style>
  
<!-- <link type="text/css" rel="stylesheet" href="{{URL::asset('css/style(ans).css')}}"> -->
<link type="text/css" rel="stylesheet" href="{{URL::asset('css/example(ans).css')}}">
<script type="text/javascript" src="{{URL::asset('js/voting.js')}}"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</head>
<body> 
  
     <h1>{{$question[0]->title}}</h1>
    
    <div class="wrap">
     <div class="vote-span"><!-- voting-->
        <div class="vote" data-action="up" title="Vote up">
          <i class="fa fa-chevron-up"></i>
        </div><!--vote up--> 
        <div class="vote-score" id="vote-score">{{$question[0]->upvote-$question[0]->downvote}}</div>
        <div class="vote" data-action="down" title="Vote down">
          <i class="fa fa-chevron-down"></i>
        </div><!--vote down-->
      </div>
      </div>

<div class="content">
   <?php
       $data=$question[0]->content;
       $content=htmlspecialchars_decode($data);
       echo $content;
    ?>
      <div id="clear"></div>

  <div id="all_tag">
  @foreach($tag as $tag)
  <span class="tag" style="color: white">{{$tag->tag_name}}</span>
  @endforeach 
  </div>
</div>  

  <div id="clear"></div>

<div id="clear"></div>

<input type="hidden" id="ques_id" value={{ Request::route('id') }}>

<div class="cmt-container" >
    
     @foreach($answer as $answer)
    <div class="cmt-cnt">
        <img src="/img/{{$answer->avatar}}" />
        <div class="thecom">
            <h5>{{$answer->name}}</h5><span data-utime="1371248446" class="com-dt">{{$answer->created_at}}</span>
            <br/>
            <p>
            {{$answer->content}}
            </p>
        </div>
    </div>
     @endforeach 

    <div class="cmt-cnt">
        <img src="https://lh3.googleusercontent.com/-wWb5i7G84_U/UXTQa3hH4cI/AAAAAAAAATU/ORUCBqDb-dM/s550-no/IMG_7840.JPG" />
        <div class="thecom">
            <h5>Amine Kacem</h5><span data-utime="1371248446" class="com-dt">20-10-2017 08:36</span>
            <br/>
            <p>
                This is my first comment,  Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
            </p>
        </div>
    </div><!-- end "cmt-cnt" -->


    <div class="new-com-bt">
        <span>Write a comment ...</span>
    </div>
    <div class="new-com-cnt">

   <!--     <input type="text" id="name-com" name="name-com" value="" placeholder="Your name" />
        <input type="text" id="mail-com" name="mail-com" value="" placeholder="Your e-mail adress" />  -->
        <textarea class="the-new-com"></textarea>
        <div class="bt-add-com">Post comment</div>
        <div class="bt-cancel-com">Cancel</div>
    </div>
    <div class="clear"></div>
</div><!-- end of comments container "cmt-container" -->

<script type="text/javascript">
   $(function(){ 
        //alert(event.timeStamp);

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

        $('.new-com-bt').click(function(event){    
            $(this).hide();
            $('.new-com-cnt').show();
            $('#name-com').focus();
        });

        /* when start writing the comment activate the "add" button */
        $('.the-new-com').bind('input propertychange', function() {
           $(".bt-add-com").css({opacity:0.6});
           var checklength = $(this).val().length;
           if(checklength){ $(".bt-add-com").css({opacity:1}); }
        });

        /* on clic  on the cancel button */
        $('.bt-cancel-com').click(function(){
            $('.the-new-com').val('');
            $('.new-com-cnt').fadeOut('fast', function(){
                $('.new-com-bt').fadeIn('fast');
            });
        });

        // on post comment click 
        $('.bt-add-com').click(function(){
            var theCom = $('.the-new-com');
            var theName = $('#name-com');
            var theMail = $('#mail-com');
            var ques_id = document.getElementById('ques_id');
           // window.alert(ques_id.value);

            if( !theCom.val()){ 
                alert('You need to write a comment!'); 
            }else{ 
                $.ajax({
                    type: "POST",
                    url: "/add-answer/"+ques_id.value, 
                    data: 'act=add-com&name='+theName.val()+'&email='+theMail.val()+'&comment='+theCom.val(),
                    success: function(html){
                        theCom.val('');
                        theMail.val('');
                        theName.val('');
                        $('.new-com-cnt').hide('fast', function(){
                            $('.new-com-bt').show('fast');
   
   /*                        
     var newData='<div class="cmt-cnt">\
      <img src="/img/"+html.image alt="" />\
      <div class="thecom">\
      <h5>"html.name"</h5>\
      <span  class="com-dt">{{date('d-m-Y H:i')}}</span>\
      <br/>\
      <p>"html.msg"</p>\
      </div>\
      </div>'
*/
       var newAns=document.createElement("div");
       newAns.className="cmt-cnt";

        var img=document.createElement("img");
        img.src="/img/"+html.image;
        img.alt="";
        img.style.height="35px";
        img.style.width="35px";

        var thecom=document.createElement("div");
        thecom.className="thecom";

        var h5=document.createElement("h5");
        h5.innerHTML=html.name;
        var span=document.createElement("span");
        span.className="com-dt";
        span.innerHTML="{{date('d-m-Y H:i')}}";
        var br=document.createElement("br");
        var p=document.createElement("p");
        p.innerHTML=html.msg;
 
        thecom.append(h5,span,br,p);
        newAns.append(img,thecom);

                            $('.new-com-bt').before(newAns);  
                        })
                    }  
                });
            }
        });

    });
</script>


</body>
</html>
@endsection