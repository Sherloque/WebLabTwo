<?php
	session_start();
	if(isset($_POST["login"], $_POST["fname"], $_POST["lname"]))
	{
		if ($_POST["login"] == '' || $_POST["fname"] == '' || $_POST["lname"] == '' || $_POST["password"] == '')
		{
			echo "There are empty fields, try again";
		}
		else
		{
			if(isset($_SESSION["someones_id"]))
			{
				$id = $_SESSION["someones_id"];
				unset($_SESSION["someones_id"]);
				$login = $_POST["login"];
				$password = $_POST["password"];
				$fname = $_POST["fname"];
				$lname = $_POST["lname"];

				$login = stripslashes($login);
				$login = htmlspecialchars($login);
				$login = trim($login);

				$password = stripslashes($password);
   			$password = htmlspecialchars($password);
				$password = trim($password);

				$fname = stripslashes($fname);
   			$fname = htmlspecialchars($fname);
				$fname = trim($fname);

				$lname = stripslashes($lname);
   			$lname = htmlspecialchars($lname);
				$lname = trim($lname);
				include("connection.php");

				$query ="UPDATE users SET login='$login', password='$password', fname='$fname', lname='$lname' WHERE id='$id'";
   				$result = mysqli_query($con, $query) or die("Error " . mysqli_error($con));
    				if($result)
        				echo "Information updated";
			}
			else
			{
				$id = $_SESSION["id"];
				$login = $_POST["login"];
				$password = $_POST["password"];
				$fname = $_POST["fname"];
				$lname = $_POST["lname"];

				$login = stripslashes($login);
   			$login = htmlspecialchars($login);
				$login = trim($login);

				$password = stripslashes($password);
   			$password = htmlspecialchars($password);
				$password = trim($password);

				$fname = stripslashes($fname);
   			$fname = htmlspecialchars($fname);
				$fname = trim($fname);

				$lname = stripslashes($lname);
   			$lname = htmlspecialchars($lname);
				$lname = trim($lname);
				include("connection.php");

				$query ="UPDATE users SET login='$login', password='$password', fname='$fname', lname='$lname' WHERE id='$id'";
   				$result = mysqli_query($con, $query) or die("Error " . mysqli_error($con));
    				if($result)
						        				echo "Information updated";
					$_SESSION['login'] = $login;
					$_SESSION['name'] = $fname;
					$_SESSION['surname'] = $lname;
					$_SESSION["password"] = $password;
			}
		}
	}
?>
