<?php
    include 'koneksi.php';

    if(isset($_POST['submit'])){
        $id_material = $_POST['id_material'];
        $nama_material =  $_POST['nama_material'];
        $harga = $_POST['harga'];

        $update = "UPDATE material SET nama_material = '$nama_material', harga = '$harga' WHERE id_material = '$id_material'";
        if(mysqli_query($conn, $update)){
            header('Location: material.php');
            exit();
        } else{
            echo "Gagal mengupdate data";
        }
    } else{
        echo "ID tidak ditemukan";
    }
?>