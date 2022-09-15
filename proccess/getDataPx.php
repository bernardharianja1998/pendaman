<?php
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
header("Content-Type: application/json");
ini_set('date.timezone', 'Asia/Jakarta');

include('../core/database.php');
include('../php_function/function.php');

$data           = array();

$db1            = "billing_rsbh";

// $kode_booking   = "2022090700418";
$kode_booking   = $_GET['kode_booking'];
$sql            = "SELECT a.id id_pendaftaran, c.unit_id, c.pasien_id, d.nama pasien, IF(d.sex = 'L', 'LAKI-LAKI', 'PEREMPUAN') jk, d.alamat, e.nama poli, f.nama dokter, c.tgl
FROM pendaftaran a
LEFT JOIN " . $db1 . ".b_pelayanan b ON a.id_pelayanan = b.id
LEFT JOIN " . $db1 . ".b_kunjungan c  ON b.kunjungan_id = c.id
LEFT JOIN " . $db1 . ".b_ms_pasien d ON c.pasien_id = d.id
LEFT JOIN " . $db1 . ".b_ms_unit e ON c.unit_id = e.id
LEFT JOIN " . $db1 . ".b_ms_pegawai f ON c.id_dokter = f.id
WHERE a.kode_booking = '$kode_booking';";
$count          = $db->get_num_rows($db->query($sql));

if ($data_px        = $db->query_row($sql)) {
    // echo "jumlah=".$count;
    $data["code"]               = 200;
    $data["message"]            = "Success";
    $data["id_pasien"]          = $data_px["pasien_id"];
    $data["id_poli"]            = $data_px["unit_id"];
    $data["id_pendaftaran"]     = $data_px["id_pendaftaran"];

    if ($count > 0) {
        $data["detail"] = "<div class='row detailPx'>
        <div class='col-lg-12'>
            <div class='card h-100 text-white bg-primary mb-3'>
                <h5 class='card-header text-white h2'>DETAIL PASIEN</h5>
                <div class='card-body detailPxTable'>
                    <table width='100%' class='text-white h3'>
                        <tr>
                            <td class='pb-1' width='25%'>NAMA</td>
                            <td class='pb-1' width='1%'>:</td>
                            <td class='pb-1' width='69%'>&nbsp;" . strtoupper($data_px["pasien"]) . "</td>
                        </tr>
                        <tr>
                            <td class='pb-1' width='25%'>JENIS KELAMIN</td>
                            <td class='pb-1' width='1%'>:</td>
                            <td class='pb-1' width='69%'>&nbsp;" . $data_px['jk'] . "</td>
                        </tr>
                        <tr>
                            <td class='pb-1' width='25%'>ALAMAT</td>
                            <td class='pb-1' width='1%'>:</td>
                            <td class='pb-1' width='69%'>&nbsp;" . strtoupper($data_px['alamat']) . "</td>
                        </tr>
                        <tr>
                            <td class='pb-1' width='25%'>POLI</td>
                            <td class='pb-1' width='1%'>:</td>
                            <td class='pb-1' width='69%'>&nbsp;" . strtoupper($data_px['poli']) . "</td>
                        </tr>
                        <tr>
                            <td class='pb-1' width='25%'>DOKTER DPJP</td>
                            <td class='pb-1' width='1%'>:</td>
                            <td class='pb-1' width='69%'>&nbsp;" . strtoupper($data_px['dokter']) . "</td>
                        </tr>
                        <tr>
                            <td class='pb-1' width='25%'>TANGGAL KUNJUNGAN</td>
                            <td class='pb-1' width='1%'>:</td>
                            <td class='pb-1' width='69%'>&nbsp;" . convert_tgl($data_px['tgl']) . "</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>";
    }
} else {
    $data["code"]       = 500;
    $data["message"]    = "Error";

    $data["detail"] = "<div class='row detailPx'>
        <div class='col-lg-12'>
            <div class='card h-100 text-white bg-primary mb-3'>
                <h5 class='card-header text-white h2'>DETAIL PASIEN</h5>
                <div class='card-body detailPxTable'>
                    <div class='row justify-content-center mt-5'>
                        <div class='text-center page-404'>
                            <h1 class='error-title'>404&nbsp;<i class='mdi mdi-emoticon-sad'></i></h1>
                            <p class='pt-1 pb-4 error-subtitle'>Oopss maaf data yang kamu cari tidak ditemukan.</p>
                            <a href='#' class='btn btn-info btn-pill'>Mohon cek kembali kode booking Anda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>";
}

echo json_encode($data);
