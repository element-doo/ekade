<!DOCTYPE html>
<html id="home" lang="en">
<head>
  <title>Uber secret dev panel</title>
</head>

<body>

  <!-- FORM START -->
  <div id="form">

    <h3><span>API test</span></h3>

    <form id="email_form" action="/zahtjev-check" method="post">
    <ul>
      <li>
        <label class="labelfor" id="email_for" for="email">Emajl:</label>
        <input type="text" name="email" id="email" tabindex="1" class="input" size="80" value="&quot;Đoni Šiš&quot; &lt;đonatan.čevapčić@example.com&gt;" />
      </li>
      <li>
        <input type="submit" id="submit" tabindex="2" value="Go!" disabled="disabled" />
      </li>
    </ul>
    </form>

    <pre id="email_response" />
    
  </div>
  <!-- FORM END -->

 <script type="text/javascript">
 
    var asyncLoad = function(url, cb) {
      var g = document.createElement('script'),
          s = document.getElementsByTagName('script')[0];

      if (cb) g.addEventListener('load', cb, true);

      g.src = url;
      g.type = 'text/javascript';
      g.async = 1;
      s.parentNode.insertBefore(g, s);
    }

    asyncLoad('https://static.emajliramokade.com/js/jquery-1.10.2.min.js', function() {
      $('#submit').removeAttr('disabled');
      
      $('#submit').click(function(e){
        e.preventDefault();
        
        var email = $('#email').val();
        var payload = JSON.stringify({"email": email});
        var url = $('#email_form').attr('action');
        
        $.ajax({
          type: "POST",
          url: url,
          contentType: 'application/json; charset=UTF-8',
          data: payload,
          dataType: 'text',
          success: function(data){
            $("#email_response").text(data);
          }
        });
        
      });
    });
    
  </script>
  <!-- tail end -->

</body>
</html>
