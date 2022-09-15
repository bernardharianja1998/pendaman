<?php
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
header("Content-Type: application/json");
ini_set('date.timezone', 'Asia/Jakarta');

include('../core/database.php');
include('../php_function/function.php');

$data           = array();

$db1            = "antrian";
$tbl1           = "noantrian";

//START GANTI DB
$db->select_db($db1);
//END GANTI DB

// $dt                     = $_POST['postData'];

$antrian;
$loket                  = $_POST['loket'];
$id_pasien              = $_POST['id_pasien'];
$id_poli                = $_POST['id_poli'];
$id_pendaftaran         = $_POST['id_pendaftaran'];
$status                 = 0;
$tgl_jam                = today_sql_timestamp();

$sql            = "SELECT (antrian+1) AS noantrean FROM $db1.$tbl1 WHERE loket = '$loket' AND DATE(tgl_jam) = CURDATE() 
AND poli_id = '$id_poli'
ORDER BY id DESC LIMIT 1;";

// echo $sql;
// exit();

$data_sql       = $db->query_row($sql);
$count          = $db->get_num_rows($db->query($sql));

if($count > 0)
{
    $antrian        = $data_sql["noantrean"];

    // echo $antrian;
    // exit();

    $dataantrian = array(
        'antrian'              => $antrian,
        'loket'                => $loket,
        'tgl_jam'              => $tgl_jam,
        'status'               => $status,
        'pasien_id'            => $id_pasien,
        'poli_id'              => $id_poli,
        'pendaftaran_id'       => $id_pendaftaran
    );

    $concatdb = $db1 . "." . $tbl1;

    if ($antrian_id = $db->insert($tbl1, $dataantrian)) {
        $data["code"]           = 200;
        $data["message"]        = "Success [0]";
        $data["antrian_id"]     = $antrian_id;
    } else {
        $data["code"]           = 500;
        $data["message"]        = "Error [0]";
        $data["antrian_id"]     = 0;
    }
}
else
{
    $data["code"]           = 500;
    $data["message"]        = "Error [1]";
    $data["antrian_id"]     = 0;
}
echo json_encode($data);

// print_r($data);
