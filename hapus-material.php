<?php
    include 'koneksi.php';

    if(isset($_GET['id_material'])) {
        $id = $_GET['id_material'];

        $delete = $conn->prepare("DELETE FROM material WHERE id_material=?");
        $delete->bind_param("s", $id);

        if ($delete->execute()) {
            header("Location: material.php");
            exit();
        } else {
            echo "Gagal menghapus data.";
        }
    } else {
        echo "ID tidak ditemukan.";
    }
?>