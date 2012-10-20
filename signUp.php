<title>Sign Up with rideSynth </title>
<h2>Please enter the requested information in order to sign up with rideSynth </h2>

<?php
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = '';
$mysql_db = 'carpooling';
error_reporting (E_ALL ^ E_NOTICE);
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
	$ssn_verify = "^\d{3}-?\d{2}-?\d{4}$|^XXX-XX-XXXX$";
	
	if(!empty($username) && !empty($password) && !empty($firstName) && !empty($lastName) && !empty($socialSecurity) && !empty($homeAddress) && !empty($workAddress)
		&& !empty($contactNumber) && !empty($emailAddress) && !empty($prefferedMethod) && !empty($gender) && !empty($carName)) {
	
		$query = "SELECT userId FROM user WHERE User_Id = '$username'";
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
<form action = "signUp.php" method = "POST">
<div id = "search_results"></div>
	Username:   <br /><input required title = "username is required" id = "search" type = "text" name = "username"><br /><br />
	Password:   <br /><input type = "password" name = "password" required title = "password is required"><br /><br />
	First Name: <br /><input type = "text" name = "firstName" required title = "Firstname is required"><br /><br />
	Last Name:  <br /><input type = "text" name = "lastName" required title = "Lastname is required"><br /><br />
	Social Security Number: <br/>(XXX-XX-XXXX format) <br /><input type = "text" name = "socialSecurity" maxlength = "12" required pattern = "^\d{3}-?\d{2}-?\d{4}$|^XXX-XX-XXXX$" title = "Enter a social security number"><br /><br />
	Home Address:   <br /><input type = "text" name = "homeAddress" required title = "Home Address required"><br /><br />
	Work Address:   <br /><input type = "text" name = "workAddress" required title = "Work Address required"><br /><br />
	Contact Number: <br/>(XXX-XXX-XXXX format) <br /><input type = "tel" name = "contactNumber" required pattern = "^\d{3}-?\d{3}-?\d{4}$|^XXX-XXX-XXXX$" title = "Enter a Phone number"><br /><br />
	Email Address: <br /><input type = "email" name = "emailAddress" required><br /><br />
	Preffered Contact Method: <br /><select id = "contactMethod" name = "prefferedMethod">
							<option value = "Em" selected>E-mail</option>
							<option value = "Ph">Phone </option>
							</select><br /><br />
	Gender: <br /><select id = "gender" name = "gender">
			<option value = "M" selected>Male</option>
			<option value = "F">Female</option>
			</select><br/><br/>
	Car Name: <br /><input required title = "Car name required" type = "text" name = "carName"><br /><br />
	<input type = "submit" value = "Submit">
</form>

<script type = "text/javascript" src = "jquery.js"></script>
<script type = "text/javascript" src = "search.js"></script>
