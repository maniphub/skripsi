<?php
        include('db_connect.php');
        $id_dayakkata = $_POST['id_dayakkata'];
        $id_bindo = $_POST['id_bindo'];
        $id_dayakmaster = $_POST['id_dayakmaster'];
        $teks_dayak = $_POST['teks_dayak'];

        echo $id_bindo;
        echo $id_dayakmaster;
        // $suara_dayak = $_POST['suara_dayak'];

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
        echo "Sorry, file already exists.";
        }
        else
        
                {
                move_uploaded_file($temp_name,$path_filename_ext);
                //  $query = "INSERT INTO dayakkata (id_bindo, id_dayakmaster, teks_dayak, suara_dayak) VALUES ('$id_bindo','$id_dayakmaster','$teks_dayak','$namasuara')";
                $query = "UPDATE `dayakkata` SET `id_bindo` = '$id_bindo',`id_dayakmaster` = '$id_dayakmaster',`teks_dayak` = '$teks_dayak', `suara_dayak` = '$namasuara'  WHERE `dayakkata`.`id_dayakkata` = '$id_dayakkata'";
                        
                //  echo $query;
                mysqli_query($link,$query);
                // echo $query;
                header('Location: ../bdayak.php');  
                        
                }
        }	 
        // echo $query = "UPDATE `dayakkata` SET `id_bindo` = '$id_bindo',  `id_dayakmaster` = '$id_dayakmaster', `teks_dayak` = '$teks_dayak', `suara_dayak` = '$suara_dayak'  WHERE `dayakkata`.`id_dayakkata` = '$id_dayakkata'";
        // echo $id_dayakkata;
        // echo $id_bindo;
        // echo $id_dayaksub;

        // mysqli_query($link,$query);
        // header('Location: ../edit_bdayak.php');
?>
