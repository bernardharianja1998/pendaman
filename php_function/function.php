<?php

function convert_tgl($tgl) //yyyy-mm-dd to dd-mm-yyyy
{
    // Creating timestamp from given date
    $timestamp = strtotime($tgl);

    // Creating new date format from that timestamp
    $new_date = date("d-m-Y", $timestamp);
    return $new_date; // Outputs: 31-03-2019
}

function today()
{
    $today = date('d/m/Y H:i:s');

    return $today;
}

function today_sql_timestamp()
{
    $date = date('Y-m-d H:i:s');

    return $date;
}

function day_in_indo()
{
    $hari   = date('l');

    $hari_indonesia = array(
        'Monday'  => 'Senin',
        'Tuesday'  => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
        'Sunday' => 'Minggu'
    );
    
    return $hari_indonesia[$hari];
}

function date_in_indo(){
    $tanggal = date('Y-m-d');

	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
