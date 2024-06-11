<?php
    include 'koneksi.php';

    if(isset($_POST['submit'])){
        $id_manajer = $_POST['id_manajer'];
        $nama_manajer =  $_POST['nama_manajer'];
        $no_telepon = $_POST['no_telepon'];
        $id_proyek = $_POST['id_proyek'];
        $id_tim = $_POST['id_tim'];

        $update = "UPDATE manajer SET nama_manajer = '$nama_manajer', no_telepon = '$no_telepon', id_proyek = '$id_proyek', id_tim = '$id_tim'  WHERE id_manajer = '$id_manajer'";
        if(mysqli_query($conn, $update)){
            header('Location: manajer.php');
            exit();
        } else{
            echo "Gagal mengupdate data";
        }
    } else{
        echo "ID tidak ditemukan";
    }
?>