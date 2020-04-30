<?php
function chat_dates($date){
	$yesterday_array = explode("-", date("Y-m-d"));
	$yesterday_array[2] -= 1;
	$yesterday = join("-", $yesterday_array);
	$date_array = explode(" ", $date);
	$chat_date = explode(":", $date_array[1]);
	if($date_array[0] == date('Y-m-d')){
		return "today at " . $chat_date[0] . ":" . $chat_date[1];
	}elseif($date_array[0] == $yesterday){
		return "yesterday at " . $chat_date[0] . ":" . $chat_date[1];
	}else{
		return $date;
	}
}
?>