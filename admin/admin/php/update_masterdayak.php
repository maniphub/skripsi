<?php
	include('db_connect.php');
	$id_dayakmaster = $_POST ['id_dayakmaster'];
    $dayak_sub = $_POST ['dayak_sub'];
    $penutur = $_POST ['penutur'];
    
    // echo $id_bindo;
    // echo $bindo;
	

	$query = "UPDATE `dayakmaster` SET `dayak_sub` = '$dayak_sub',`penutur` = '$penutur' WHERE `dayakmaster`.`id_dayakmaster` = '$id_dayakmaster'";
	// echo $query;
	mysqli_query($link,$query);
	// $query;
	header('Location: ../masterdayak.php');
?>