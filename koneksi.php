<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "uap_pemweb";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
