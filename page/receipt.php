<?php
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
ini_set('date.timezone', 'Asia/Jakarta');

require_once("../dompdf/autoload.inc.php");
include('../php_function/function.php');
include('../core/database.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$db1            = "billing_rsbh";
$db2            = "antrian";
// $kode_booking   = "2022090800316"; //tapi harus di insert di noantrian dulu ya
$kode_booking   = $_GET['kode_booking'];
$sql            = "SELECT CONCAT(xx.loket,'-',xx.antrian) no_antrean, d.no_rm, d.nama pasien, IF(d.sex = 'L', 'LAKI-LAKI', 'PEREMPUAN') jk, d.alamat, e.nama poli, f.nama dokter, c.tgl
FROM " . $db2 . ".noantrian xx
LEFT JOIN pendaftaran a ON xx.pendaftaran_id = a.id
LEFT JOIN " . $db1 . ".b_pelayanan b ON a.id_pelayanan = b.id
LEFT JOIN " . $db1 . ".b_kunjungan c  ON b.kunjungan_id = c.id
LEFT JOIN " . $db1 . ".b_ms_pasien d ON c.pasien_id = d.id
LEFT JOIN " . $db1 . ".b_ms_unit e ON c.unit_id = e.id
LEFT JOIN " . $db1 . ".b_ms_pegawai f ON c.id_dokter = f.id
WHERE a.kode_booking = '$kode_booking'
ORDER BY xx.id DESC LIMIT 1;";

// echo $sql; exit();

$data_px        = $db->query_row($sql);
$count          = $db->get_num_rows($db->query($sql));
?>
<style>
    .logo {
        filter: gray;
        /* IE6-9 */
        -webkit-filter: grayscale(1);
        /* Google Chrome, Safari 6+ & Opera 15+ */
        filter: grayscale(1);
        /* Microsoft Edge and Firefox 35+ */
    }

    .lbl {
        font-weight: bolder;
    }

    .lbl2 {
        font-weight: bolder;
        text-align: left;
    }

    .lbl3 {
        text-align: left;
        padding: 0;
        margin: 0;
    }

    .h3 {
        font-size: 100px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-weight: 800;
    }

    .table {
        text-align: center;
        border-collapse: collapse;
        border-spacing: 0px;
        border-width: 0px;
        padding: 0;
    }
</style>
<table class="table" width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td rowspan="3" width="20%">
            <img class="logo" src="../mono/theme/images/logo.png" style="max-width: 100px;">
        </td>
        <td colspan="2" class="lbl2">
            RUMAH SAKIT BHAYANGKARA SURABAYA
        </td>
    </tr>
    <tr>
        <td colspan="2" class="lbl3">
            Jl. Ahmad Yani No.116, Ketintang, Gayungan, Kota SBY, Jawa Timur 60331
        </td>
    </tr>
    <tr>
        <td colspan="2" class="lbl3">
            Telp. Customer Care : 081331770271
        </td>
    </tr>
</table>
<hr>
<table class="table" width="100%" align="center" border="1">
    <tr>
        <td colspan="3" style="border: 0px;">
            <?= day_in_indo(); ?>, <?= today(); ?>
        </td>
    </tr>
    <tr>
        <td class="lbl" colspan="3" style="border: 0px;">
            Nomor Antrian Anda :
        </td>
    </tr>
    <tr>
        <td class="h3" colspan="3">
            <?= strtoupper($data_px['no_antrean']); ?>
        </td>
    </tr>
    <tr>
        <td class="lbl2" colspan="3" style="border: 0px;"><?= strtoupper($data_px['pasien']); ?></td>
    </tr>
    <tr>
        <td class="lbl3" width="10%" style="border: 0px;">No RM</td>
        <td width="1%" style="border: 0px;">:</td>
        <td class="lbl3" width="94%" style="border: 0px;"><?= strtoupper($data_px['no_rm']); ?></td>
    </tr>
    <tr>
        <td class="lbl3" width="10%" style="border: 0px;">Dokter</td>
        <td width="1%" style="border: 0px;">:</td>
        <td class="lbl3" width="94%" style="border: 0px;"><?= strtoupper($data_px['dokter']); ?></td>
    </tr>
    <tr>
        <td class="lbl3" width="10%" style="border: 0px;">Poli</td>
        <td width="1%" style="border: 0px;">:</td>
        <td class="lbl3" width="94%" style="border: 0px;"><?= strtoupper($data_px['poli']); ?></td>
    </tr>
    <tr>
        <td colspan="3" style="border: 0px;">
            Silahkan menunggu antrian Anda dipanggil.
        </td>
    </tr>
    <tr>
        <td colspan="3" style="border: 0px;">
            Jika Anda ketinggalan 3 nomor antrian, maka Anda diwajibkan untuk mengambil nomor antrian kembali.
        </td>
    </tr>
</table>
<?php
$dompdf->loadHtml(ob_get_clean());
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('sample.pdf', array('Attachment' => '0'));
?>