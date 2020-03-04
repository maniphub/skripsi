<?php 
	include ('db_connect.php');
    $dayak_sub = $_POST ['dayak_sub'];
    $penutur = $_POST ['penutur'];

    // $query = "INSERT INTO `dayakmaster`(`dayak_sub`, `penutur`) VALUES ('$dayak_sub','$penutur')";
	$query = "INSERT INTO dayakmaster (dayak_sub, penutur) VALUES ('$dayak_sub','$penutur')";
	// echo $query;

	mysqli_query($link,$query);
	header('Location: ../masterdayak.php');
 ?>