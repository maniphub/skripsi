<?php
	include('db_connect.php');
	$bindo = $_GET['id_bindo'];
	$query = "DELETE FROM `bindo` WHERE `bindo`.`id_bindo` = '$bindo'";

	mysqli_query($link,$query);
	header('Location: ../bindo.php');
?>