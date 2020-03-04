<?php 
	include ('db_connect.php');
    $bindo = $_POST ['bindo'];
    
    $query = "INSERT INTO bindo (teks_indo) VALUES ('$bindo')";

	mysqli_query($link,$query);
	header('Location: ../bindo.php');
	
 ?>