<?php
	include('db_connect.php');
	$dayakmaster = $_GET['id_dayakmaster'];
	$query = "DELETE FROM `dayakmaster` WHERE `dayakmaster`.`id_dayakmaster` = '$dayakmaster'";

	mysqli_query($link,$query);
	header('Location: ../masterdayak.php');
?>