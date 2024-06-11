<?php
    include 'koneksi.php';

    if(isset($_POST['submit'])){
        if(isset($_POST['id_tim'])){
            $id_tim = $_POST['id_tim'];
            $nama_tim = $_POST['nama_tim'];

            $update = "UPDATE tim_proyek SET nama_tim = '$nama_tim' WHERE id_tim = '$id_tim'";
            if(mysqli_query($conn, $update)){
                header('Location: tim.php');
                exit();
            } else{
                echo "Gagal mengupdate data";
            }
        } else{
            echo "ID tidak ditemukan";
        }
    }
?>