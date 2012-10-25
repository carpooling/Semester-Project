// Rating Algorithm
// Oct 1, Vaibhav Aggarwal, Ankit Kumar

<?php
	// fields to hold the initial and current Ratings
	// initial is zero because they will have to earn it over time
	$initRating=0;
	$currentRating=0;
	// count keeps a track of how many ratings have been provided so far
	$count=0;
	$i=0;
	
	// method 
	function CalculateRating($stars, $count)
	{
	global $currentRating;
	   // For 5 stars
		for($i=1;$i<6;$i++)
		{
		// if stars divided by i=1.0, we will no the value of i, and hence multiply stars by i * 2
		// We are multiplying by i*2 so that we have a greater granularity between stars
		// that is better shown on a bar
			if($stars/$i==1.0)
			{
				$stars= $stars*$i*2;
			}
		}
		// if it is the first rating
		if($count==0)
		{
			$currentRating=$stars;
			
			$count++;
		}
		else if($count>0)
		{
		// we ensure that the rating is not skewed by the new incoming star value
		// so we take carrent rating, convert it into previous total, divide by the count that it will have afterwards
		// and do same with the incoming star value
		//echo($currentRating);
		$currentRating= (($currentRating*$count)+ $stars)/($count+1);
		$count++;
		}
		
		echo "<input type='button' name='something' value='{$currentRating}'>";
	}
	
	
	CalculateRating(5,0);
	
	CalculateRating(4,1);
	
	
	
	
	
	echo CalculateRating(4,2);
	echo CalculateRating(3,3);
	echo CalculateRating(5,4);
	echo CalculateRating(5,5);
	
	
?>
