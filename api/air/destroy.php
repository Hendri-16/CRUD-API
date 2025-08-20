<?php

header('Content-Type: application/json');

include("helper.php");

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    include("../../connect.php");

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        if ($id != "") {
            $read = $connect->query(query: "SELECT * FROM users WHERE id = '$id'");
            $user = $read->fetch_assoc();

            if($user){
                $destroy = $connect->query(query: "DELETE FROM users WHERE id = '$id'");

                $array_api = response_json(status: 200, message: "Data berhasil dihapus");
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