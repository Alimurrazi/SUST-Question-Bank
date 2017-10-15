<!DOCTYPE html>
<html>
<head>
    <title>PHP Bootstrap - dynamic autocomplete tag input using jquery tag manager plugin </title> 

   <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>    
</head>
<body>
<div class="container">
    
<form name="form" method="post" action="http://localhost:8000/autocomplete-submit" class="form" accept-charset="UTF-8">
<input type="hidden"  name="_token" value="KTd7wfykexmcrhgdiAitUljtTqGWa5qotKtROgYw">
        <div class="form-group"> 
            <label>Add Country Tags:</label>
            <input type="text" name="countries" placeholder="Type here.." class="typeahead tm-input form-control tm-input-info"/>
        </div>
<input type="submit" value="Submit">   
</form>
 
</div>
<script type="text/javascript">
var ara=[];
ara.push("laravel");
ara.push("laravel 5.1");
  $(document).ready(function() {
    var tags = $(".tm-input").tagsManager();
    var url = "http://localhost:8000/autocomplete-ajax";
    console.log(url);
    jQuery(".typeahead").typeahead({
      source: function (query, process) {
        return $.get(url, { query: query }, function (data) {
          console.log(data);
          //data = $.parseJSON(data); 
           //      ara = [];
           // for(var i=0;i<data.length;i++)
           // ara.push(data[i].tag_name);      
          // console.log(ara);
          return process(data);       
         // return process(ara);
        });
      },
      afterSelect :function (item){
        tags.tagsManager("pushTag", item.name);
      }
    });
  });
</script>
</body>
</html>