


<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">

<html>
<title> Register your car! </title>
<head>
<link rel="stylesheet" type="text/css" href="styleCarInfo.css">
</head>
<header id="header">
Register your vehicle and get a unique name for your ride!<br><br>
</header>

<body>

 <script type="text/javascript">
 /*var RecaptchaOptions = {
    theme : 'clean'
 };*/
 </script>   
        
 <div class="inputForm">     
<form action="" method="POST">

Email ID:  	    <br><input class="tb" required  title="Email ID required" id="emailID" name="emailID" type="email" placeholder="Your notification mail ID" value="<?php echo $emailID;?>" /><br>
Nick Name: 		<br><input class="tb" required class="tb" title="You have to enter a unique nick name" id="nickName" name="nickName" type="text" placeholder="Unique ID for your Car" maxlength="15" value="<?php echo $nickName;?>" /><br>
Model Name: 	<br><input class="tb" id ="model" name="model" type="text" placeholder="Car Model" value="<?php echo $model;?>"required/><br>
Manufacturer: 	<br><input class="tb" id="manufacturer" name="manufacturer" type="text" placeholder="Manufacturer/Brand" value="<?php echo $manufacturer;?>"required/><br>
Year: 			<br><input class="tb" id name="year" name="year" type="text" placeholder="Year of manufacture"value="<?php echo $year;?>"required/><br>
Color: 			<br><input class="tb" id ="color" name="color" type"text" placeholder="Color of your car"value="<?php echo $color;?>"required/><br>
VIN Number: 	<br><input class="tb" id="vin" name="vin" type="text" placeholder="VIN on your title"value="<?php echo $vin;?>"required/><br>
Type: <br>	<select class="tb" id="typeOfVehicle" name="typeOfVehicle"> 
			<option value="Sedan" >Sedan</option>
			<option value="SUV">SUV</option>
			<option value="HatchBack">HatchBack</option>
			<option value="Coupe" selected>Coupe</option>
			</select> <br>	
How Many seats you want to share: <input class="tb" id="howManySeats" name="howManySeats" type="text" placeholder="Seats you want to share" value="<?php echo $seatCount; ?>"required/><br>
Time of departure: <input class="tb" id="timeOfDeparture" name="timeOfDeparture" type="text" placeholder="When do you leave" value="<?php echo $timeDeparture; ?>"/>
				   <select id="amOrPm" name="amOrPm">
				   <option value="AM" > AM</option>
				   <option value="PM" > PM</option>
				   </select><br>
Origin: <input class="tb" id="origin" name="origin" type="text" placeholder="Where do you leave from?" value="<?php echo $origin; ?>" required/><br> 
Destination: <input class="tb" id="destination" name="destination" type="text" placeholder="Where are you going?" value="<?php echo $destination; ?>" required/><br>

<?php
		  require("phpsqlsearch_dbinfo.php");
          require_once('recaptchalib.php');
          $publickey = "6LccqNcSAAAAANZEYK9BNSS55w73niGyIxCK_3yx"; // you got this from the signup page
          echo recaptcha_get_html($publickey);
        ?>
<input class="button" name="registerButton"  type="submit" value="Register" /><br>


</form>
</div>
<form action="upload_file.php" method="post"
enctype="multipart/form-data">
<label for ="file">File:</label>
<input type="file" name="file" id="file"/>
</br>
<input type="submit" name="upload" value="Upload" />

</form>

</body>
 <?php
 
	
  
  
 

/***********

placeholder is used to place helping text in the text boxes
maxlenght allows to limit how much data is entered in the textbox
We are checking that no text boxes are empty


we have some refresh-send email again issues.
make the no of seats also drop down
drop dpwn values are not preserved
after registration, take the user back to his homepage
Take username directly using a session variable
 
***************/




// checks if all the fieds are set, does not check if they are empty or not
if(isset($_POST['nickName'])&& isset($_POST['model']) &&isset($_POST['manufacturer'])
			&&isset($_POST['year'])&&isset($_POST['color'])&& isset($_POST['vin'])
			&& isset($_POST['typeOfVehicle'])&& isset($_POST['howManySeats'])&& isset($_POST['timeOfDeparture'])
			&& isset($_POST['origin']) && isset($_POST['destination']))
	{
	require_once('recaptchalib.php');
  $privatekey = "6LccqNcSAAAAADlk-Y8QGXFJiC2fe3znW_U2uR7z";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("Sorry, We could not verify the CAPTCHA you entered!.\n Try again") ;
         
		 //"(reCAPTCHA said: " . $resp->error . ")");
  } else {
    // Your code here to handle a successful verification
			// creating local variables for all the data that is being posted from the form
		$mailID=$_POST['emailID'];	
		$nickName=$_POST['nickName'];	
		$model=$_POST['model'];	
		$manufacturer=$_POST['manufacturer'];	
		$year=$_POST['year'];	
		$color=$_POST['color'];	
		$vin=$_POST['vin'];	
		$type=$_POST['typeOfVehicle'];
		
		$seatCount=$_POST['howManySeats'];
		$timeDeparture=$_POST['timeOfDeparture'];
		if(!empty($timeDeparture))
		{
		$ampm=$_POST['amOrPm'];
		}
		$origin=$_POST['origin'];
		$destination=$_POST['destination'];
		// checking if all the fields are filled or not
		if(!empty ($mailID) &&!empty($nickName) && !empty($model) && !empty($manufacturer)
			&& !empty($year) && !empty($color) && !empty($vin) && !empty($type) && !empty($seatCount) 
				&& !empty($origin) && !empty($destination))
			{
			
				if(strlen($nickName)>15)
				{
					echo 'Nickname should be smaller than 15 characters!';
				}
				else
				{
				
				// Set all the parameters for all sending the email
				$to      = $mailID;
				$subject = 'Registration Complete!';
				$body = 'Congratulations! Your registration is complete'."\n\n" .'Your car\'s nickname: '.$nickName."\n".
						 'Model: '.$model."\n".'Manufacturer: '.$manufacturer."\n".'Year: '.$year."\n".'Color: '.$color."\n".
						 'VIN Number: '.$vin."\n".'Type: '.$type."\n".'Seats you are looking to fill: '.$seatCount."\n".'You leave at: '.$timeDeparture.' '.$ampm."\n".'From '.$origin.' to '.$destination."\n\n".
						 'Thank you for registering!'."\n".'We will notify you once we have someone to share ride with you'.
						 "\n\n".'Regards,'."\n".'Team rideSynth';
				$headers = 'From: admin@rideSynth.com' . "\r\n" .
				'Reply-To: vaibhav.aggarwal@my.ndsu.edu' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
				
					// Connect to the database and save all the information to the DB
				
				$connection=mysql_connect(localhost,$username,$password);
				if(!$connection)
					{
						die("There was an error connecting to the database\n Please try later " );
						
					}
				else
					{
					mysql_select_db($database, $connection);
					$queryToCheckVinNumber = "SELECT vinNumber FROM vehicle WHERE vinNumber = '$vin'";
					$queryToCheckNickName = "SELECT vehicleNickName FROM vehicle WHERE vehicleNickName = '$nickName'";
					$query_run_vinNumber = mysql_query($queryToCheckVinNumber);
					$query_run_nickName = mysql_query($queryToCheckNickName);
					if(mysql_num_rows($query_run_vinNumber) == 1) 
					{
					echo 'The VIN Number ' .$vin. ' is already registered';
					}
					else if(mysql_num_rows($query_run_nickName) == 1) 
					{
					echo 'Sorry! The Nick Name ' .$nickName. ' is already taken';
					}
					
					else
					
					{
							$queryToVehicle= "INSERT INTO vehicle (vinNumber,model,make,color,year,type,userId, vehicleNickName)
											VALUES('$vin','$model','$manufacturer','$color','$year','$type','Bob','$nickName')";
							
							$queryToReservation="INSERT INTO reservation (userId,timeDeparture,origin,destination,vinNumber)
												VALUES('bob','$timeDeparture','$origin','$destination','$vin')";
							
								if( $query_run=mysql_query($queryToVehicle)&& $query_ran=mysql_query($queryToReservation))
									{
										echo "Information Saved Succesfully!<br/>";
										echo "Your Vehicle is now registered in our system <br/>"; 
									}
								else
									{
										die('problem occured'.mysql_error());
									}
											
									
					
				
					// Send the Email
					if(mail($to, $subject, $body, $headers))
					{
						echo "A confirmation Email has been sent to ".$to ."\n";
						// set all varialbes =null
						
					} 			
					else
					{
						echo 'There was an error sending the email.';

					}
				}
			}
		}
	}
				}
	
}

?>


</html>