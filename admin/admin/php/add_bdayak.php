<?php 
	include ('db_connect.php');
    $id_bindo = $_POST ['id_bindo'];
    $id_dayakmaster = $_POST ['id_dayakmaster'];
    $teks_dayak = addslashes($_POST ['teks_dayak']);
    // $suara_dayak = $_POST ['suara_dayak'];

    if (($_FILES['suara_dayak']['name']!="")){
        // Where the file is going to be stored
         $target_dir = "../upload/";
         $file = $_FILES['suara_dayak']['name'];
         $path = pathinfo($file);
         $filename = $path['filename'];
         $ext = $path['extension'];
         $temp_name = $_FILES['suara_dayak']['tmp_name'];
         $path_filename_ext = $target_dir.$filename.".".$ext;

         $namasuara =$filename.".".$ext;
         
        // Check if file already exists
        if (file_exists($path_filename_ext)) {
         echo '<script language="javascript" type="text/javascript"> 
                alert("Gagal, Data Telah Tersedia !");
                window.location = "../bdayak.php";
                </script>';
        //  "Sorry, file already exists.";
         }else{
             $query = "INSERT INTO dayakkata (id_bindo, id_dayakmaster, teks_dayak, suara_dayak) VALUES ('$id_bindo','$id_dayakmaster','$teks_dayak','$namasuara')";
             move_uploaded_file($temp_name,$path_filename_ext);
            //  echo $query;
        //  echo $query;
         mysqli_query($link,$query);
         header('Location: ../bdayak.php');
        //  echo "Congratulations! File Uploaded Successfully.";
         }
        }

    // $query = "INSERT INTO `dayakmaster`(`dayak_sub`, `penutur`) VALUES ('$dayak_sub','$penutur')";
	// echo $query;

 ?>