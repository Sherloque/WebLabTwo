<?php
include "connection.php";

$id = $_POST['id'];


$query = "DELETE FROM users WHERE id=".$id;
mysqli_query($con,$query);

echo "success";
