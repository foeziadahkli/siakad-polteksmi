<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Mengambil konfigurasi dari Environment Variables di Cloud Run
$db_host = getenv('DB_HOST') ?: '127.0.0.1';
$db_user = getenv('DB_USER') ?: 'admin_db_siakad';
$db_pass = getenv('DB_PASS') ?: 'Rahasia@00';
$db_name = getenv('DB_NAME') ?: 'db_demo1';

// Jika menggunakan Cloud SQL Auth Proxy, port defaultnya tetap 3306 via localhost
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
