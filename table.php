<?php
session_start();
?>

<!DOCTYPE html>
<html>
 <script type="text/javascript" src="js/jquery-3.3.1.js"> </script>
 <link   href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

 <script type="text/javascript">

 $(document).ready(function() {

      $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "display.php",
        dataType: "html",   //expect html to be returned
        success: function(response){
            $("#responsecontainer").html(response);
            //alert(response);
        }

    });
});

</script>

<body>
<table border="1">
   <tr>
   </tr>
</table>
<div id="responsecontainer">

</div>
</body>
</html>
