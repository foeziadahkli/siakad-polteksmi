<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$db_user = getenv('DB_USER') ?: 'admin_db_siakad';
$db_pass = getenv('DB_PASS') ?: 'Rahasia@00';
$db_name = getenv('DB_NAME') ?: 'db_demo1';

// Cloud Run secara otomatis menyediakan Unix Socket di folder /cloudsql/
// jika Cloud SQL Connection (di Langkah 1) sudah Anda aktifkan.
$connection_name = getenv('CLOUD_SQL_CONNECTION_NAME'); 

if ($connection_name) {
    // KONEKSI UNTUK PRODUCTION (CLOUD RUN)
    // Menggunakan socket bawaan GCP, parameter host diisi null/empty
    $conn = mysqli_connect(null, $db_user, $db_pass, $db_name, null, "/cloudsql/$connection_name");
} else {
    // KONEKSI UNTUK LOKAL (XAMPP / LAPTOP ANDA)
    $db_host = getenv('DB_HOST') ?: '127.0.0.1';
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
}

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
