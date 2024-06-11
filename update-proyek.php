<?php
    include 'koneksi.php';

    if(isset($_POST['submit'])){
        $id_proyek = $_POST['id_proyek'];
        $deskripsi = $_POST['deskripsi'];
        $tanggal_mulai = $_POST['tanggal_mulai'];
        $tanggal_selesai = $_POST['tanggal_selesai'];

        $update = "UPDATE proyek SET deskripsi = '$deskripsi', tanggal_mulai = '$tanggal_mulai', tanggal_selesai = '$tanggal_selesai' WHERE id_proyek = '$id_proyek'";
        if(mysqli_query($conn, $update)){
            header('Location: proyek.php');
            exit();
        } else{
            echo "Gagal mengupdate data";
        }
    } else{
        echo "ID tidak ditemukan";
    }
?>