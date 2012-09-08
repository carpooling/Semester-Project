<?php
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = '';
$mysql_db = 'car_pooling';

if(!mysql_connect($mysql_host, $mysql_user, $mysql_pass) || !mysql_select_db($mysql_db)) {
	die(mysql_error());
}

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['box3']) && isset($_POST['box4']) && isset($_POST['box5']) && isset($_POST['box6'])) {
	$Textbox1 = $_POST['username'];
	$textbox2 = $_POST['password'];
	$textbox3 = $_POST['box3'];
	$textbox4 = $_POST['box4'];
	$textbox5 = $_POST['box5'];
	$textbox6 = $_POST['box6'];
	$encryptedPassword = md5($textbox2);
	
	if(!empty($Textbox1) && !empty($textbox2) && !empty($textbox3) && !empty($textbox4) && !empty($textbox5) && !empty($textbox6)) {
	
		$query = "SELECT User_Id FROM user WHERE User_Id = '$Textbox1'";
		$query_run = mysql_query($query);
		
		if(mysql_num_rows($query_run) == 1) {
			echo 'The username ' .$Textbox1. ' already exists';
		} else {
			$query = "INSERT INTO user VALUES ('".$Textbox1."', '', '".$textbox3."', '".$textbox4."', '".$encryptedPassword."', '".$textbox5."', '".$textbox6."', '', '', '', '', '', '')";
			if($query_run = mysql_query($query)) {
				echo 'values inserted';
			} else {
				echo 'Problem occurred';
			}
		}
	
	} else {
		echo 'Fill all fields';
	}
}
?>

<form action = "test.php" method = "POST">
	Username: <input type = "text" name = "username"> <br />
	Password: <input type = "password" name = "password"><br />
	TextBox 3: <input type = "text" name = "box3"><br />
	TextBox 4: <input type = "text" name = "box4"><br />
	TextBox 5: <input type = "text" name = "box5"><br />
	TextBox 6: <input type = "text" name = "box6"><br />
	<input type = "submit" value = "Submit">
</form>
