<?php 
	include ('db_connect.php');
    $sub = $_POST ['sub'];
    $kata = $_POST ['kata'];
    
    echo $kata;

    $hasilterjemahan = array ();
    
    function multiexplode ($delimiters,$data) {
        $MakeReady = str_replace($delimiters, $delimiters[0], $data);
        $Return    = explode($delimiters[0], $MakeReady);
        return  $Return;
    }
    
    $kalimat = multiexplode(array(" ",", "," () ",","), $kata);

    // print_r($kalimat);
    print_r($kalimat);
    
    // kunci pencarian (konversi)
    
    // get data 
    $getdayakkata = mysqli_query($link, "SELECT * FROM dayakkata WHERE dayakkata.id_dayakmaster = $sub");
    $high = mysqli_num_rows($getdayakkata);
    // print_r($high);
    
    $low = 0;
    $max = $high-1;
    
    //get Data High and low
    $getDatahigh = "SELECT * FROM `dayakkata` WHERE dayakkata.id_dayakmaster = $sub";
    $data = mysqli_query($link, $getDatahigh);
    
    
    $getDataAll = array ();
    foreach ($data as $key => $value) {
        $idbindo = $value['id_dayakkata'];
        $getDataAll[] = $idbindo; //all data 
    }
    $datalow = $getDataAll[$low];
    $datahigh = $getDataAll[$max];

    // print("<pre>".print_r($getDataAll,true)."</pre>");
 
    $getKeyKata = array ();

    // foreach ($kalimat as $kata) {
    //     # code...
    //     // $query = "SELECT * FROM `dayakkata` INNER JOIN bindo ON dayakkata.id_bindo = bindo.id_bindo INNER JOIN dayakmaster ON dayakkata.id_dayakmaster = dayakmaster.id_dayakmaster WHERE `bindo`.`teks_indo` = '$kata' AND `dayakkata`.`id_dayakmaster` = $sub";
    //     // $st = mysqli_query($link, $query);
    //     $query = "SELECT * FROM `dayakkata` INNER JOIN bindo ON dayakkata.id_bindo = bindo.id_bindo INNER JOIN dayakmaster ON dayakkata.id_dayakmaster = dayakmaster.id_dayakmaster WHERE `bindo`.`teks_indo` = '$kata' AND `dayakkata`.`id_dayakmaster` = $sub";
    //     $st = mysqli_query($link, $query);
    //     while($row = mysqli_fetch_array($st)) {
    //         $key = $row['id_dayakkata']; // get Key Kata
    //     }

    //     // echo $st;
    //     echo "<br>" .$kata;
    //     echo " : ";
    //     echo $key;
    // }

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
                $key = $row['id_dayakkata']; // get Key Kata
            }

            echo "<br>";
            echo "key : ".$key."<br>";
            echo "data low : ".$datalow."<br>";
            echo "data high : ".$datahigh."<br>";
            echo "max : ".$max."<br>";
            echo "low : ".$low."<br>";
    
            // posisi == index
            $posisi = ($key-$datalow)/($datahigh-$datalow)*($max-$low)+$low;
            echo "posisi : ".round($posisi);
            

            
            // echo $posisi;
            // jika data key = data yang dicari 
            $datakey = "SELECT * FROM `dayakkata` WHERE dayakkata.id_dayakmaster = $sub";
            $datakunci = mysqli_query($link, $datakey);
            $datakunciall = array ();
    
            foreach ($datakunci as $key2 => $value) {
                # code...
                $datakunciall[] = $value;
            }
            
            // print("<pre>".print_r($datakunciall,true)."</pre>");
            // print_r($datakunciall);
            
            $dataposisi = $datakunciall[$posisi];
            // print("<pre>".print_r($dataposisi,true)."</pre>");
            echo "<hr>";
            echo "nilai posisi : ".$nilaiposisi = $dataposisi['id_dayakkata'];
            echo "<hr>";

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
            
            if ($key < $nilaiposisi) {
                $dataposisinew = $datakunciall[$posisinew];
                // print_r ($dataposisinew);
                $max = $posisinew - 1;
                // echo $max;
                $posisibaru = ($key-$datalow)/($datahigh-$datalow)*($max-$low)+$low;
                echo round($posisibaru);
            }
            elseif ($key > $nilaiposisi) {
                # code...
                // jika data key > data yang dicari 
                $low = round($posisi) + 1;
                $posisi = ($key-$datalow)/($datahigh-$datalow)*($max-$low)+$low;
                $posisi2 = round($posisi);

                return $posisinew;

                // $dataposisinew = $datakunciall[$posisinew];
                // // print_r ($dataposisinew);
                // $max = $posisinew - 1;
                // // echo $max;
                // $posisibaru = ($key-$datalow)/($datahigh-$datalow)*($max-$low)+$low;
                // echo round($posisibaru);

                // $dataposisibaru = $datakunciall[$posisibaru];
                // print_r($dataposisibaru);



                
                //end
            } 
        }
    }

    // print("<pre>".print_r($hasilterjemahan,true)."</pre>");
    

    // $gabungan = implode(' ', array_map(function ($entry) {
    //     return $entry['kata'];
    //   }, $hasilterjemahan));

    // // $suara = "hello";
    
    // $suara = $hasilterjemahan[0]['suaradayak'];
      
    // $titlesuara = array();
    // foreach ($hasilterjemahan as $key => $item) {
        
    //     $titlesuara[] = $item['suaradayak'];

    //     // echo "<br>";
    // }
      
    // // $kalimatterjemahan = array('kata' => $gabungan,'suara' => $suara);
    // $kalimatterjemahan = array('kata' => $gabungan,'suara' => $titlesuara);
    // $data = json_encode($kalimatterjemahan);
    // echo $data;
 ?>