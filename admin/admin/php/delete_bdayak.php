<?php
	include('db_connect.php');
	$bdayak = $_GET['id_dayakkata'];
	$query = "DELETE FROM `dayakkata` WHERE `dayakkata`.`id_dayakkata` = '$bdayak'";

	mysqli_query($link,$query);
	header('Location: ../bdayak.php');
?>