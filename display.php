<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <link   href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
</head>

<script>
$(document).ready(function(){

 $("btn").click(function(){
  var el = this;
  var butid = this.id;

  $.ajax({
   url: 'remove.php',
   type: 'POST',
   data: { id:butid },
   success: function(response){

    $(el).closest('tr').css('background','tomato');
    $(el).closest('tr').fadeOut(800, function(){
     $(this).remove();
    });

   }
  });

 });

});
</script>

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("MyTable");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, login, password, fname, lname FROM users";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

  if(isset($_SESSION["login"])){
  echo 'Welcome, ', $_SESSION['login']," (",$_SESSION['role'],")";
  echo '<a href="logout.php"> Logout</a>';
}
else{
  echo 'Welcome, guest';
  echo '<a href="index.php"> Login</a>';
}
  if(isset($_SESSION["login"]) and $_SESSION["role"]=="admin"){
  echo '<table class="table table-bordered" id="MyTable">';
  echo '<thead>';
  echo  '<tr>';
  echo    '<th onclick="sortTable(1)">id</th>';
  echo    '<th onclick="sortTable(0)"> Login</th>';
  echo    '<th>Actions</th>';
  echo  '</tr>';
  echo '</thead>';
  echo '<tbody>';
    while($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo  '<th scope="row">'.$row["id"].'</th>';
    echo  '<td>'.$row["login"].'</td>';
    echo '<td><a class = "btn" href="profile.php?id='.$row["id"].'">View profile</a>&nbsp&nbsp&nbsp';
    echo '<btn class = "btn btn-danger" id='.$row["id"].'>Delete user</btn></td>';
    echo '</tr>';
    }
  echo '</tbody>';
    echo '</table>';
}

if(isset($_SESSION["login"]) and $_SESSION["role"]=="user"){
  echo '<table class="table table-bordered" id="MyTable">';
  echo '<thead>';
  echo  '<tr>';
  echo    '<th onclick="sortTable(1)">id</th>';
  echo    '<th onclick="sortTable(0)"> Login</th>';
  echo    '<th scope="col">Actions</th>';
  echo  '</tr>';
  echo '</thead>';
  echo '<tbody>';
    while($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo  '<th scope="row">'.$row["id"].'</th>';
      echo  '<td>'.$row["login"].'</td>';
      echo '<td><a class = "btn" href="profile.php?id='.$row["id"].'">View profile</a>&nbsp&nbsp&nbsp';
      echo '</tr>';
    }
    echo '</tbody>';
      echo '</table>';
}

if(!isset($_SESSION["login"])){
  echo '<table class="table table-bordered" id="MyTable">';
  echo '<thead>';
  echo  '<tr>';
  echo    '<th onclick="sortTable(1)">id</th>';
  echo    '<th onclick="sortTable(0)"> Login</th>';
  echo  '</tr>';
  echo '</thead>';
  echo '<tbody>';
    while($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo  '<th scope="row">'.$row["id"].'</th>';
      echo  '<td>'.$row["login"].'</td>';
            echo '</tr>';
    }
    echo '</tbody>';
      echo '</table>';
}
}

else {
    echo "Table is empty";
}


mysqli_close($conn);
?>

</body>
</html>
