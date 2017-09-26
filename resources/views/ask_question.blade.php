  @extends('layouts.app')
 
  @section('content')
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<title>SUST Question Bank</title>
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

<img class="intLink" title="image" src="img/picture.png" onclick="document.execCommand('insertImage', false, 'http://lorempixel.com/40/20/sports/')">


<!--
<input type="button" value="image" onclick="document.execCommand('insertImage', false, 'http://lorempixel.com/40/20/sports/')" />
<input type="button" value="image" onclick="document.execCommand('insertImage', false, 'img/insert.png')" />
-->

<!--
<i class="material-icons" value="image" 
onclick="formatDoc('underline')" >&#xe439</i>

<i class="intLink" value="image" 
onclick="formatDoc('insertImage','http://lorempixel.com/40/20/sports/')" >&#xe439</i>
-->


</div>
<div id="textBox" contenteditable="true"><p>Write your Question</p></div>


<p id="editMode"><input type="hidden" name="switchMode" id="switchBox" onchange="setDocMode(this.checked);" /> <label for="switchBox"><!--Show HTML--></label></p>

<p><input type="submit" value="Submit" /></p>

</form>
</body>
</html>
@endsection
