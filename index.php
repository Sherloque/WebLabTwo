<?php
	session_start();
?>

<html>
<head>
<link href="login_style.css" type="text/css" rel="stylesheet"/>
	  <link   href="css/bootstrap.min.css" rel="stylesheet">
 <script type="text/javascript" src="js/jquery-3.3.1.js"> </script>
<script type="text/javascript">
function do_login()
{
 var login=$("#login").val();
 var pass=$("#password").val();
 if(login!="" && password!="")
 {
  $("#loading_spinner").css({"display":"block"});
  $.ajax
  ({
  type:'post',
  url:'login.php',
  data:{
   do_login:"do_login",
   login:login,
   password:pass
  },
  success:function(response) {
  if(response=="success")
    window.location.href="table.php";
  else
  {
    $("#loading_spinner").css({"display":"none"});
    alert("Wrong Details");
  }
  }
  });
 }

 else
 {
  alert("Please Fill All The Details");
 }

 return false;
}
</script>
</head>
<body>
 <form method="post" action="login.php" onsubmit="return do_login();">
Username:<br>
<input type="text" name="login"><br>
User password:<br>
<input type="password" name="password"><br>
<input type ="Submit" value = "Enter" ><br>
</form>
</body>
</html>
