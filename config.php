<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Mengambil konfigurasi dari Environment Variables di Cloud Run
$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER') ?: 'admin_db_siakad';
$db_pass = getenv('DB_PASS') ?: 'Rahasia@00';
$db_name = getenv('DB_NAME') ?: 'db_demo1';

// Cek apakah DB_HOST diisi dengan jalur Unix Socket (berawalan /cloudsql)
if (strpos($db_host, '/cloudsql') === 0) {
    // KONEKSI CLOUD RUN (Unix Socket)
    // Parameter host wajib diisi NULL atau localhost, lalu socket ditaruh di parameter ke-6
    $conn = mysqli_connect(null, $db_user, $db_pass, $db_name, null, $db_host);
} else {
    // KONEKSI LOKAL / IP (Jika DB_HOST berisi IP seperti 127.0.0.1 atau IP Private)
    $host_address = $db_host ?: '127.0.0.1';
    $conn = mysqli_connect($host_address, $db_user, $db_pass, $db_name);
}

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
