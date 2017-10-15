  @extends('layouts.app')
 
  @section('content')

<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SUST Question Bank</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<script type="text/javascript"> 

var oDoc, sDefTxt; 

function initDoc() {
  oDoc = document.getElementById("textBox");
  sDefTxt = oDoc.innerHTML;
  if (document.compForm.switchMode.checked) { setDocMode(true); }
}

function formatDoc(sCmd, sValue) {
  if (validateMode()) 
    { 
      document.execCommand(sCmd, false, sValue); 
      oDoc.focus(); 
    }
}

function validateMode() {
  if (!document.compForm.switchMode.checked) { return true ; }
  alert("Uncheck \"Show HTML\".");
  oDoc.focus();
  return false;
}

function setDocMode(bToSource) {
  var oContent;
  if (bToSource) {
    oContent = document.createTextNode(oDoc.innerHTML);
    oDoc.innerHTML = "";
    var oPre = document.createElement("pre");
    oDoc.contentEditable = false;
    oPre.id = "sourceText";
    oPre.contentEditable = true;
    oPre.appendChild(oContent);
    oDoc.appendChild(oPre);
  } else {
    if (document.all) {
      oDoc.innerHTML = oDoc.innerText;
    } else {
      oContent = document.createRange();
      oContent.selectNodeContents(oDoc.firstChild);
      oDoc.innerHTML = oContent.toString();
    }
    oDoc.contentEditable = true;
  }
  oDoc.focus();
}

</script>
<style type="text/css">
.intLink { cursor: pointer; }
img.intLink { border: 0; }
#toolBar1 select { font-size:10px; }
#textBox {
  width: 540px;
  height: 200px;
  border: 1px #000000 solid;
  padding: 12px;
  overflow: scroll;
}
#textBox #sourceText {
  padding: 0;
  margin: 0;
  min-width: 498px;
  min-height: 200px;
}
#title
{
  margin-bottom: 15px;
}
#editMode label { cursor: pointer; }
</style>
</head>
<body onload="initDoc();">
<form name="compForm" method="post" action="{{ action('QuestionSubmitController@submit') }}" onsubmit="if(validateMode()){this.myDoc.value=oDoc.innerHTML;return true;}return false;">
<input type="hidden"  name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="myDoc">
<input type="hidden" name="ques_id" value="{{$ques_id}}">
<div id="toolBar2">

<input type="text" name="title" id="title" placeholder="  Title">
<br>
 
<img class="intLink" title="Bold" onclick="formatDoc('bold');" src="img/bold.png" />

<img class="intLink" title="Italic" onclick="formatDoc('italic');" src="img/italic.png" />
<img class="intLink" title="Underline" onclick="formatDoc('underline');" src="img/underline.png" />
<img class="intLink" title="Left align" onclick="formatDoc('justifyleft');" src="img/left_align.png" />
<img class="intLink" title="Center align" onclick="formatDoc('justifycenter');" src="img/center_align.png" />
<img class="intLink" title="Right align" onclick="formatDoc('justifyright');" src="img/right_align.png" />
<img class="intLink" title="Numbered list" onclick="formatDoc('insertorderedlist');" src="img/numbered_list.png" />
<img class="intLink" title="Dotted list" onclick="formatDoc('insertunorderedlist');" src="img/dotted_list.png" />
<img class="intLink" title="Hyperlink" onclick="var sLnk=prompt('Write the URL here','http:\/\/');if(sLnk&&sLnk!=''&&sLnk!='http://'){formatDoc('createlink',sLnk)}" src="img/hyperlink.png" />

<img class="intLink" title="image" onclick="var sLnk=prompt('Write image URL here','http:\/\/');if(sLnk&&sLnk!=''&&sLnk!='http://'){formatDoc('insertImage',sLnk)}" src="img/picture.png" />


</div>
<div id="textBox" contenteditable="true"></div>

<input type="hidden" name="ques_id" value="{{$ques_id}}">

<div id="clear"></div>

    <div class="tag-box">
           <div class="form-group">
               <label for="users">Add Tag</label>
          <select name="tag_id[]" id="users" class="form-control" multiple="multiple">
               </select>
           </div>
    </div>
 
 <div id="clear"></div>

<p id="editMode"><input type="hidden" name="switchMode" id="switchBox" onchange="setDocMode(this.checked);" />   </p>


<input type="submit" value="Submit" />

</form>

   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>

        $(document).ready(function(){
            $('#users').select2({
                placeholder : 'Please select Tag',
                tags:true,
                ajax : {
                    url : '/api/tags',
                    dataType : 'json',
                    delay : 200,
                    data : function(params){
                        return {
                            q : params.term,
                            page : params.page
                        };
                    },
                    processResults : function(data, params){
                        params.page = params.page || 1;

                        return {
                            results : data.data,
                            pagination: {
                                more : (params.page  * 10) < data.total
                            }
                        };
                    }
                },
                minimumInputLength : 1,
                templateResult : function (repo){
                    if(repo.loading) return repo.tag_name;

                    var markup = repo.tag_name;

                    return markup;
                },
                templateSelection : function(repo)
                {
                    return repo.tag_name;
                },
                escapeMarkup : function(markup){ return markup; }
            });
        });
    </script>


</body>
</html>
@endsection