<?php
header('Content-Type: application/json');
include("helper.php"); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("../../connect.php");
    $input = json_decode(file_get_contents("php://input"));

    $tahun = $input->tahun;
    $unit = $input->unit;
    $konsumsi = $input->konsumsi;
    

    if ($tahun == "" || $unit == "" || $konsumsi == "") {
         $array_api = response_json(400, "Harus diisi");
    }
    else {
        $store = $connect->query("INSERT INTO users (tahun, unit, konsumsi) VALUES ('$tahun', '$unit', '$konsumsi')");

        $array_api = response_json(200, "Data berhasil disimpan");
    }
    
} else {
    $array_api = response_json(405, "Method Not Allowed");
}

echo json_encode($array_api);

?>