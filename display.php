<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <link   href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>

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
  echo '<table class="table table-bordered">';
  echo '<thead>';
  echo  '<tr>';
  echo    '<th scope="col">id</th>';
  echo    '<th scope="col">Login</th>';
  echo    '<th scope="col">Actions</th>';
  echo  '</tr>';
  echo '</thead>';
  echo '<tbody>';
    while($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo  '<th scope="row">'.$row["id"].'</th>';
    echo  '<td>'.$row["login"].'</td>';
    echo '<td><a class = "btn" href="profile.php?id='.$row["id"].'">View profile</a>&nbsp&nbsp&nbsp';
    echo '<a class = "btn btn-danger" href="delete.php?id='.$row["id"].'">Delete user</a></td>';
    echo '</tr>';
    }
  echo '</tbody>';
    echo '</table>';
}

if(isset($_SESSION["login"]) and $_SESSION["role"]=="user"){
  echo '<table class="table table-bordered">';
  echo '<thead>';
  echo  '<tr>';
  echo    '<th scope="col">id</th>';
  echo    '<th scope="col">Login</th>';
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
  echo '<table class="table table-bordered">';
  echo '<thead>';
  echo  '<tr>';
  echo    '<th scope="col">id</th>';
  echo    '<th scope="col">Login</th>';
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
