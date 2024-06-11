<?php
    include 'koneksi.php';

    if(isset($_GET['id_karyawan'])) {
        $id = $_GET['id_karyawan'];

        $delete = $conn->prepare("DELETE FROM karyawan WHERE id_karyawan=?");
        $delete->bind_param("s", $id);

        if ($delete->execute()) {
            header("Location: karyawan.php");
            exit();
        } else {
            echo "Gagal menghapus data.";
        }
    } else {
        echo "ID tidak ditemukan.";
    }
?>