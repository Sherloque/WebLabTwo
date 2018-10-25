<?php
session_start();
include("connection.php");
mysqli_select_db($con,"users");
$result=mysqli_query($con,"select * from users");


echo 'Welcome, guest';
echo '<a href="index.php"> Login</a>';

echo "<table border='1' >
<tr>
<td> <b>Id</b></td>
<td><b>Login</b></td>";

while($data = mysqli_fetch_row($result))
{
    echo "<tr>";
    echo "<td>$data[0]</td>";
    echo "<td>$data[1]</td>";
    echo "</tr>";
}
echo "</table>";
?>
