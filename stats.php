<?php

class stats {

	public $x, $y, $size_of_y = 0, $size_of_x = 0, $sum_of_y = 0, $sum_of_xy = 0;
	
	/*****************************************************************************/
	// Constructor method to set our class vars
	/*****************************************************************************/
	public function __construct($x, $y) 
	{
		// set the class var so we can use the values in other methods
		$this->y = $y;
		$this->x = $x;

		// n of y
		$this->size_of_y = sizeof($this->y);
		// n of x
		$this->size_of_x = sizeof($this->x);
		
	}
	
	/*****************************************************************************/
	// Method to calculate the variance of x
	/*****************************************************************************/
	public function variance() 
	{
		$sum_of_x = 0;
		// sum of x
		foreach ($this->x as $xi) 
		{
			$sum_of_x		+= $xi;
		}
		
		// mean of x
		$mean_of_x = $sum_of_x / $this->size_of_x;
		
		// value subtracted by the average/mean
		$subtraction_of_x_and_mean_squared = 0;
		
		foreach ($this->x as $xi) 
		{
			$subtraction_of_x_and_mean_squared += pow(($xi - $mean_of_x), 2);
		}
				
		$variance = $subtraction_of_x_and_mean_squared / ($this->size_of_x - 1);
		return $variance;
		
	}
	
	/*****************************************************************************/
	// Method to calculate the covariance of x and y
	/*****************************************************************************/
	public function covariance() 
	{

		// We can use n of y  OR n of x - they should be the same value
		$n = $this->size_of_y;
		$counter  = 0;
		$sum_of_x = 0;
		foreach ($this->y as $yi) 
		{
			$this->sum_of_y		+= $yi;
			$sum_of_x			+= $this->x[$counter];
			$this->sum_of_xy 	+= ($yi * $this->x[$counter]);
			$counter++;
		}
		
		$covariance = (1/($n-1)) * ($this->sum_of_xy - ($n * ($this->sum_of_y / $n) * ($sum_of_x / $n)));
		return $covariance;
	}
}

$y = array("1", "3", "2", "5", "8", "7", "12", "2", "4"); 
$x = array("8", "6", "9", "4", "3", "3", "2", "7", "7"); 

$stats  	= new stats($x, $y);
$variance	= $stats->variance();
$covariance = $stats->covariance();

echo "Variance: " . $variance;
echo "<hr>";
echo "Covariance: " . $covariance;

?>