<?php
	include('db_connect.php');
	$id_bindo = $_POST ['id_bindo'];
    $bindo = $_POST ['bindo'];
    
    // echo $id_bindo;
    // echo $bindo;
	

	$query = "UPDATE `bindo` SET `teks_indo` = '$bindo' WHERE `bindo`.`id_bindo` = '$id_bindo'";
	// echo $query;
	mysqli_query($link,$query);
	// $query;
	header('Location: ../bindo.php');
?>