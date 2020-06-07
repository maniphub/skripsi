<?php
 
include('db_connect.php');


$query = "SELECT * FROM `dayakmaster`";

$result = mysqli_query($link,$query) or die(mysqli_error());	

//  print_r($result);


 $arr = array();
	while ($row = mysqli_fetch_assoc($result)) {
	    $temp = array(
		"id"=> $row["id_dayakmaster"],
	    "sub" => $row["dayak_sub"]);
	    array_push($arr, $temp);
	}
	 
	// print_r($arr);
	$data = json_encode($arr);
	echo $data;
	 
	/*echo "{\"data\":" . $data . "}";*/
?>