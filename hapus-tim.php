<?php
    include 'koneksi.php';

    if(isset($_GET['id_tim'])) {
        $id = $_GET['id_tim'];

        $delete = $conn->prepare("DELETE FROM tim_proyek WHERE id_tim=?");
        $delete->bind_param("s", $id);

        if ($delete->execute()) {
            header("Location: tim.php");
            exit();
        } else {
            echo "Gagal menghapus data.";
        }
    } else {
        echo "ID tidak ditemukan.";
    }
?>