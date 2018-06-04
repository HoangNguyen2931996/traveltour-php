<?php 
	function currentPrice($price, $discount){
		return round($price - ($discount/100)*$price);
	}
	function convertDate($strDate){
		$date = date_create($strDate);
		return date_format($date, "d/m/Y");
	}
	function slotEmpty($slot, $slotOrdered){
		$result = $slot - $slotOrdered;
		if($result <= 0){
			return 0;
		} else{
			return $result;
		}
	}
?>