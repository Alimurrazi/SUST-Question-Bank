$(document).ready(function(){
  // ajax setup
  /*
  $.ajaxSetup({
    url: 'ajaxvote.php',
    type: 'POST',
    cache: 'false'
  });
  */

  // any voting button (up/down) clicked event
  $('.vote').click(function(){
    var ques_id = document.getElementById('ques_id').value;
      $.ajaxSetup({
    url: '/voting/'+ques_id.value,
    type: 'POST',
    cache: 'false',
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
  });

    var self = $(this); // cache $this
    var action = self.data('action'); // grab action data up/down 
    var parent = self.parent().parent(); // grab grand parent .item
    var postid = parent.data('postid'); // grab post id from data-postid
    var score = parent.data('score'); // grab score form data-score
    
   // console.log(self+" "+action+" "+parent+" "+postid+" "+ques_id);

    // only works where is no disabled class
    if (!parent.hasClass('.disabled')) {
      // vote up action
      if (action == 'up') {
        // increase vote score and color to orange
        parent.find('.vote-score').html(++score).css({'color':'orange'});
        // change vote up button color to orange
        self.css({'color':'orange'});
        // send ajax request with post id & action
        $.ajax({data: {'postid' : postid, 'action' : 'up','ques_id':ques_id}});
      }
      // voting down action
      else if (action == 'down'){
        // decrease vote score and color to red
        parent.find('.vote-score').html(--score).css({'color':'red'});
        // change vote up button color to red
        self.css({'color':'red'});
        // send ajax request
        $.ajax({data: {'postid' : postid, 'action' : 'down','ques_id':ques_id}});
      };

      // add disabled class with .item
      parent.addClass('.disabled');
    };
  });
});