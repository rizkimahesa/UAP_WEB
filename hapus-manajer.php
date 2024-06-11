<?php
    include 'koneksi.php';

    if(isset($_GET['id_manajer'])) {
        $id = $_GET['id_manajer'];

        $delete = $conn->prepare("DELETE FROM manajer WHERE id_manajer=?");
        $delete->bind_param("s", $id);

        if ($delete->execute()) {
            header("Location: manajer.php");
            exit();
        } else {
            echo "Gagal menghapus data.";
        }
    } else {
        echo "ID tidak ditemukan.";
    }
?>