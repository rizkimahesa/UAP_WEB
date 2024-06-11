<?php
    include 'koneksi.php';

    if(isset($_GET['id_proyek'])) {
        $id = $_GET['id_proyek'];

        $delete = $conn->prepare("DELETE FROM proyek WHERE id_proyek=?");
        $delete->bind_param("s", $id);

        if ($delete->execute()) {
            header("Location: proyek.php");
            exit();
        } else {
            echo "Gagal menghapus data.";
        }
    } else {
        echo "ID tidak ditemukan.";
    }
?>