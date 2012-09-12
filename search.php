<?php
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = '';
$mysql_db = 'car_pooling';

if(!mysql_connect($mysql_host, $mysql_user, $mysql_pass) || !mysql_select_db($mysql_db)) {
	die(mysql_error());
}

if(isset($_POST['search_term'])) {
	$search_term = mysql_real_escape_string(htmlentities($_POST['search_term']));
	
	if(!empty($search_term)) {
		
		$search = mysql_query("SELECT userId FROM user WHERE User_Id = '$search_term'");
		
		if(mysql_num_rows($search) == 1) {
			echo 'The username ' .$search_term. ' already exists. Please select a different username';
		}
		else
		{
			echo 'username available';
		}
	}
}

?>