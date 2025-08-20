<?php

header('Content-Type: application/json');

include("helper.php");

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    include("../../connect.php");

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        if ($id != "") {
            $read = $connect->query(query: "SELECT * FROM users WHERE id = '$id'");
            $user = $read->fetch_assoc();

            if($user){
                $input = json_decode(file_get_contents("php://input"));                                                 

                $tahun = $input->tahun;
                $unit = $input->unit;
                $konsumsi = $input->konsumsi;
                
            
                if ($tahun == "" || $unit == "" || $konsumsi == "") {
                     $array_api = response_json(400, "Harus diisi");
                }else {
                    $update = $connect->query("UPDATE users SET tahun = '$tahun', unit  = '$unit', konsumsi = '$konsumsi' WHERE id = '$id'");
            
                    $array_api = response_json(201, "berhasil update");
                };
            }
            else {
                $array_api = response_json(status: 404, message: "Data tidak ditemukan");
            }
        }
        else {
            $array_api = response_json(status: 400, message: "ID tidak boleh kosong");
        }
    }
    else {
        $array_api = response_json(status: 400, message: "ID harus disertakan");
    }
} 
else {
    $array_api = response_json(status: 405, message: "Method Not Allowed");
}

echo json_encode($array_api);

?>