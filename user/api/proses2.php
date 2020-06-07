<?php

include ('db_connect.php');
$sub = $_POST ['sub'];
$kata = $_POST ['kata'];

echo "Sub : ".$sub;
echo "<br>";
echo "Kata yang dicari : ".$kata;
echo "<hr>";

$hasilterjemahan = array ();
    
    function multiexplode ($delimiters,$data) {
        $MakeReady = str_replace($delimiters, $delimiters[0], $data);
        $Return    = explode($delimiters[0], $MakeReady);
        return  $Return;
    }
    
    $kalimat = multiexplode(array(" ",", "," () ",","),$kata);


    $getdayakkata = mysqli_query($link, "SELECT * FROM dayakkata INNER JOIN bindo ON dayakkata.id_bindo = bindo.id_bindo WHERE dayakkata.id_dayakmaster = $sub");
    $high = mysqli_num_rows($getdayakkata);
    $low = 0;
    $max = $high-1;

    $getDataAll = array ();
    $getkeykata = array ();

    foreach ($kalimat as $kata) {
        # code...
        echo $kata;
        echo "<br>";
    }


    foreach ($getdayakkata as $key => $value) {
        # code...
        $keykata = $value['id_bindo'];

        $katanya = $value['teks_indo'];
        $lowdatakata = strtolower($katanya); //untuk kondisi
        echo $lowdatakata;
        echo "<br>";


        $teks = $value['teks_indo'];
        $getDataAll[] = $keykata;
    }
    
    
    print_r($getDataAll);

    echo "<hr>";
    echo "Nilai A[Hi] : ". $max;
    echo "<br>";
    echo "Nilai A [Lo] : ". $low;
    echo "<hr>";

    echo "Nilai Hi : ". $getDataAll[$max];
    echo "<br>";
    echo "Nilai Lo : ". $getDataAll[$low];


?>