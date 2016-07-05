<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Title</title>
</head>
<body>
<p id="times"></p>
<p id="funny"></p>

<p id="sum"></p>
<button id="push">push</button>

<script src="/static/js/jquery-3.0.0.min.js"></script>
<script>
  var es = new EventSource('flush');
  es.addEventListener('message', function(e) {
    var myDate = new Date();
    var d = JSON.parse(e.data);
    document.getElementById(d.symbol).innerHTML = '<br/>'+d.bid;
    document.getElementById('times').innerHTML = '<br/>'+d.timestamp+'|'+myDate.getSeconds()+'.'+myDate.getMilliseconds();
  }, false);

  $('#push').click(function() {
    $.post('/say', {

    }, function(data, textStatus) {
//      alert(data);
      $('#sum').html(data.replay);
    }, 'json');
  });
</script>
</body>
</html>