<?php
// Konfigurasi koneksi ke database
$servername = "localhost"; // Host MySQL
$username = "root";        // Username MySQL (default untuk XAMPP adalah "root")
$password = "";            // Password MySQL (default untuk XAMPP adalah kosong)
$dbname = "suryaekasa";     // Nama database yang digunakan

// Membuat koneksi
$mysqliconnect = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$mysqliconnect) {
    die("Connection failed: " . mysqli_connect_error());
// tes
}
?>
