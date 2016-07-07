<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Title</title>
</head>
<body>
<p id="times"></p>
<p id="funny"></p>
<input type="text" id="in"/>
<p id="sum"></p>
<button id="push">push</button>

<script src="/static/js/jquery-3.0.0.min.js"></script>
<script>
  var es = new EventSource('/flush');
  es.addEventListener('message', function(e) {
    var myDate = new Date();
    var d = JSON.parse(e.data);
    document.getElementById(d.symbol).innerHTML = '<br/>'+d.bid;
    document.getElementById('times').innerHTML = '<br/>'+d.timestamp+'|'
        +myDate.getSeconds()+'.'+myDate.getMilliseconds()
        +'|'+d.global;
    $('#sum').text(d.global);
  }, false);

  $('#push').click(function() {
//    var xhr = new XMLHttpRequest();
//    xhr.open('post', '/say', true);
//    xhr.setRequestHeader('Content-type', 'text/plain;charset=utf8');
//    xhr.send('in='+$('#in').val());

    $.post('/say', {
      'in':$('#in').val()
    }, function(data, textStatus) {
//      $('#sum').text(data);
    }, 'text');
  });
</script>
</body>
</html>