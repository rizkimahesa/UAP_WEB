<?php
    include 'koneksi.php';

    if(isset($_POST['submit'])){
        $id_karyawan = $_POST['id_karyawan'];
        $nama_karyawan =  $_POST['nama_karyawan'];
        $jabatan = $_POST['jabatan'];
        $gaji = $_POST['gaji'];
        $id_tim = $_POST['id_tim'];

        $update = "UPDATE karyawan SET nama_karyawan = '$nama_karyawan', jabatan = '$jabatan', gaji = '$gaji', id_tim = '$id_tim'  WHERE id_karyawan = '$id_karyawan'";
        if(mysqli_query($conn, $update)){
            header('Location: karyawan.php');
            exit();
        } else{
            echo "Gagal mengupdate data";
        }
    } else{
        echo "ID tidak ditemukan";
    }
?>