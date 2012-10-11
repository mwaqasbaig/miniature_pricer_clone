<?php
/*
F = S * e ^ (r*t)

F : Future Contract S : Current spot price, you will receive it from a third party provider in a realtime manner. t: time in year for finding future price. r : Annualized Interest rate. It is defined based on the following table

Data Table.
1 | 10% 30 | 5% 60 | 4% 90 | 2% 210 | 2

To find interest rates that are not in the table use interpolation.

For example:

Future contract if current price is 10 in thirty days is

F = 10 * e ^ (5/100 * 30/365)
*/
function miniature_pricer($s, $t){
	if(isset($s) && isset($t) &&  $t !='' && $s !=''){  //CHECK FOR INCOMIMG PARAMERTS
		//GET CURRENT SPOT PRICE
		$sort_price = $s;
		//GET TIME IN YEAR FOR FINDING FUTURE PRICE
		$time_in_year = $t;
		//SET YEAR DAYS
		$total_days_in_year = 365;
		//SET Interest TABLE
		$Intrest_rate['1'] = 10/100;   //10 %
		$Intrest_rate['30'] = 5/100;   //5 %
		$Intrest_rate['60'] = 4/100;   //4 %
		$Intrest_rate['90'] = 2/100;   //2 %
		$Intrest_rate['210'] = 2;   //2
		
		if(!isset($Intrest_rate[$time_in_year])){
			echo 'No Interest For This Time Frame ONLY USE 1 / 30 / 60 / 90 / 210 DAYS';  // MATCHING VALUES FOR INTREST TABLE DATA // CURRENTLY I PASS WITH ECHO.. CORRECT WAY IS RETURN VALUE
			exit();
		}
		$t = (float)$time_in_year/(float)$total_days_in_year;  // total Time in year divide by Total Days in year.
		$intrestrate = (float)$Intrest_rate[(string)$time_in_year]; // Generate Intrest Rate
		$mergeInterst = ((float)$intrestrate)*((float)($t));   // Mearge Interest with Total Time finding future price
		
		//echo intval($Intrest_rate[(string)$time_in_year]).'<br>';
		$F = (float)$sort_price * exp($t); 
			echo 'Future contract = '.$F; // ANSWER  // CURRENTLY I PASS WITH ECHO.. CORRECT WAY IS RETURN VALUE
    }else{
			echo 'Missing Parameter';  // ERROR MISSING PARAMERTER  // CURRENTLY I PASS WITH ECHO.. CORRECT WAY IS RETURN VALUE
	}
}
@miniature_pricer($_REQUEST['s'], $_REQUEST['t']); // FOR USE WITH API
//miniature_pricer('10', '30');   // FOR USE IN FUNCTION

?>