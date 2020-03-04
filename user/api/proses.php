<?php 
	include ('db_connect.php');
    $sub = $_POST ['sub'];
    $kata = $_POST ['kata'];
    
    // echo $sub;

    $hasilterjemahan = array ();
    
    function multiexplode ($delimiters,$data) {
        $MakeReady = str_replace($delimiters, $delimiters[0], $data);
        $Return    = explode($delimiters[0], $MakeReady);
        return  $Return;
    }
    
    $kalimat = multiexplode(array(" ",", ","-"," () ",","),$kata);
    
    
    // kunci pencarian (konversi)
    // get data 
    $getdayakkata = mysqli_query($link, "SELECT * FROM dayakkata WHERE dayakkata.id_dayakmaster = $sub");
    $high = mysqli_num_rows($getdayakkata);
    $low = 0;
    $max = $high-1;

    //get Data High and low
    $getDatahigh = "SELECT * FROM `dayakkata` WHERE dayakkata.id_dayakmaster = $sub";
    $data = mysqli_query($link, $getDatahigh);
    
    $getDataAll = array ();
    foreach ($data as $key => $value) {
        $idbindo = $value['id_bindo'];
        $getDataAll[] = $idbindo; //all data 
    }
    $datalow = $getDataAll[$low];
    $datahigh = $getDataAll[$max];
 
    $getKeyKata = array ();

    // print_r($kalimat);
    foreach ($kalimat as $kata) {
        // echo $kata;

        $query = "SELECT * FROM `dayakkata` INNER JOIN bindo ON dayakkata.id_bindo = bindo.id_bindo INNER JOIN dayakmaster ON dayakkata.id_dayakmaster = dayakmaster.id_dayakmaster WHERE `bindo`.`teks_indo` = '$kata' AND `dayakkata`.`id_dayakmaster` = $sub";
        // echo $query;
        $st = mysqli_query($link, $query);

        // echo $st;

        if($st->num_rows == 0) {
            $hasil = $kata;
            $hasilterjemahan[] = array('kata' => $kata, 'teks_dayak' => $kata, 'suaradayak' => 'Tidak Ada Suara');
        } else {
        
            while($row = mysqli_fetch_array($st)) {
                $key = $row['id_bindo']; // get Key Kata
            }

            // echo $key;
    
            // posisi == index
            $posisi = ($key-$datalow)/($datahigh-$datalow)*($max-$low)+$low;

            
            // echo $posisi;
            // jika data key = data yang dicari 
    
            $datakey = "SELECT * FROM `dayakkata` WHERE dayakkata.id_dayakmaster = $sub";
            $datakunci = mysqli_query($link, $datakey);
            $datakunciall = array ();
    
            foreach ($datakunci as $key2 => $value) {
                # code...
                $datakunciall[] = $value;
            }
            
            // print_r($datakunciall);

            $dataposisi = $datakunciall[$posisi];
            $nilaiposisi = $dataposisi['id_bindo'];
            $kata = $dataposisi['teks_dayak'];
            
    
            if ($key == $nilaiposisi) {
                $queryHasil = "SELECT * FROM `dayakkata` INNER JOIN bindo ON dayakkata.id_bindo = bindo.id_bindo INNER JOIN dayakmaster ON dayakkata.id_dayakmaster = dayakmaster.id_dayakmaster WHERE `dayakkata`.`id_bindo` = '$nilaiposisi' AND `dayakkata`.`id_dayakmaster` = $sub";
                $sthasil = mysqli_query($link, $queryHasil);
                
                $arrayterjemahan = array();
                while($rowhasil = mysqli_fetch_array($sthasil)) {
                    $teksdayak = $rowhasil['teks_dayak']; // get Key Kata
                    $suaradayak = $rowhasil['suara_dayak']; // get Key Kata

                    $hasilterjemahan[] = array('kata' => $kata,'teksdayak' => $teksdayak, 'suaradayak' => $suaradayak);
                }
            }
            elseif ($key < $nilaiposisi) {
                $low = $posisi - 1;
                $posisi = ($key-$datalow)/($datahigh-$datalow)*($max-$low)+$low;
                //end
            }
            elseif ($key > $nilaiposisi) {
                # code...
                // jika data key > data yang dicari 
                $max = $posisi + 1;
                $posisi = ($key-$datalow)/($datahigh-$datalow)*($max-$low)+$low;
                //end
            } 
        }
    }
    

    $gabungan = implode(' ', array_map(function ($entry) {
        return $entry['kata'];
      }, $hasilterjemahan));

    // $suara = "hello";
    
    $suara = $hasilterjemahan[0]['suaradayak'];
      
    $titlesuara = array();
    foreach ($hasilterjemahan as $key => $item) {
        
        $titlesuara[] = $item['suaradayak'];

        // echo "<br>";
    }
      
    // $kalimatterjemahan = array('kata' => $gabungan,'suara' => $suara);
    $kalimatterjemahan = array('kata' => $gabungan,'suara' => $titlesuara);
    $data = json_encode($kalimatterjemahan);
    echo $data;
 ?>