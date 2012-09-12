<?php
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = '';
$mysql_db = 'car_pooling';

if(!mysql_connect($mysql_host, $mysql_user, $mysql_pass) || !mysql_select_db($mysql_db)) {
	die(mysql_error());
}

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstName']) && isset($_POST['lastName']) 
		&& isset($_POST['socialSecurity']) && isset($_POST['homeAddress']) && isset($_POST['workAddress']) 
		&& isset($_POST['contactNumber']) && isset($_POST['emailAddress']) && isset($_POST['prefferedMethod']) 
		&& isset($_POST['gender']) && isset($_POST['carName'])) {
		
	$username = $_POST['username'];
	$password = $_POST['password'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$socialSecurity = $_POST['socialSecurity'];
	$homeAddress = $_POST['homeAddress'];
	$workAddress = $_POST['workAddress'];
	$contactNumber = $_POST['contactNumber'];
	$emailAddress = $_POST['emailAddress'];
	$prefferedMethod = $_POST['prefferedMethod'];
	$gender = $_POST['gender'];
	$carName = $_POST['carName'];
	$encryptedPassword = md5($password);
	
	if(!empty($username) && !empty($password) && !empty($firstName) && !empty($lastName) && !empty($socialSecurity) && !empty($homeAddress) && !empty($workAddress)
		&& !empty($contactNumber) && !empty($emailAddress) && !empty($prefferedMethod) && !empty($gender) && !empty($carName)) {
	
		$query = "SELECT User_Id FROM user WHERE User_Id = '$username'";
		$query_run = mysql_query($query);
		
		if(mysql_num_rows($query_run) == 1) {
			echo 'The username ' .$username. ' already exists';
		} else {
			$query = "INSERT INTO user VALUES ('".$username."', '', '".$firstName."', '".$lastName."', '".$encryptedPassword."', '".$socialSecurity."', '".$homeAddress."', '".$workAddress."', '".$contactNumber."', '".$prefferedMethod."', '".$emailAddress."', '".$gender."', '".$carName."')";
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
<div id = "search_results"></div>
	Username:   <input id = "search" type = "text" name = "username"><br />
	Password:   <input type = "password" name = "password"><br />
	First Name: <input type = "text" name = "firstName"><br />
	Last Name:  <input type = "text" name = "lastName"><br />
	Social Security Number: <input type = "text" name = "socialSecurity"><br />
	Home Address:   <input type = "text" name = "homeAddress"><br />
	Work Address:   <input type = "text" name = "workAddress"><br />
	Contact Number: <input type = "text" name = "contactNumber"><br />
	Email Address: <input type = "email" name = "emailAddress"><br />
	Preffered Contact Method: <input type = "text" name = "prefferedMethod"><br />
	Gender: <input type = "text" name = "gender" maxlength = "1"><br />
	Car Name: <input type = "text" name = "carName"><br />
	<input type = "submit" value = "Submit">
</form>

<script type = "text/javascript" src = "jquery.js"></script>
<script type = "text/javascript" src = "search.js"></script>
