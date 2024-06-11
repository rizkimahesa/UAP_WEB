<?php
    include 'koneksi.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_karyawan = $_POST["nama_karyawan"];
        $jabatan = $_POST["jabatan"];
        $gaji = $_POST["gaji"];
        $id_tim = $_POST["id_tim"];

        if (empty($nama_karyawan) || (empty($jabatan)) || (empty($gaji)) || (empty($id_tim))) {
            echo "Semua bidang harus diisi.";
        } else {
            $check_query = "SELECT * FROM karyawan WHERE nama_karyawan = '$nama_karyawan'";
            $result = mysqli_query($conn, $check_query);
            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('Karyawan sudah ada.');</script>";
            } else{
                $sql = "INSERT INTO karyawan (nama_karyawan, jabatan, gaji, id_tim) VALUES ('$nama_karyawan', '$jabatan', '$gaji', '$id_tim')";
                
                if(mysqli_query($conn, $sql)){
                    header("Location: karyawan.php");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
    }

    $query =  "SELECT * FROM karyawan";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Konstruksi</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="gambar/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .custom-navbar{
            background-color: #ADD2C9;
        }

        img{
            width: 90px;
            height: 90px;
        }

        a{
            text-decoration: none;
            color: white;
        }

        .btn-primary{
            margin: 15px;
        }

        table {
            border: 1px solid black;
            text-align: center;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            text-align: center;
            vertical-align: middle;
        }

        .table-container {
            margin: auto;
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #eef7ff;
            width: 90%;
            }

        .table-container:hover {
            border-color: #5c9cb5;
        }
    
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="gambar/icon.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Data
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="manajer.php">Manajer</a></li>
                        <li><a class="dropdown-item" href="tim.php">Tim</a></li>
                        <li><a class="dropdown-item" href="proyek.php">Proyek</a></li>
                        <li><a class="dropdown-item" href="karyawan.php">Karyawan</a></li>
                        <li><a class="dropdown-item" href="material.php">Material</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="login-admin.php">Log Out</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>

    <br>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahTimModal">Tambah Karyawan</button>
    <div class="modal fade" id="tambahTimModal" tabindex="-1" aria-labelledby="tambahTimModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahTimModalLabel">Tambah Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tambahTimForm" action="karyawan.php" method="post">
                        <div class="mb-3">
                            <label for="namaProyek" class="form-label">Nama Karyawan</label>
                            <input type="text" class="form-control" id="namaProyek" name="nama_karyawan" required>
                            <label for="lokasi" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="lokasi" name="jabatan" required>
                            <label for="deskripsi" class="form-label">Gaji</label>
                            <input type="number" class="form-control" id="deskripsi" name="gaji" required>
                            <label for="tanggalMulai" class="form-label">Id Tim</label>
                            <input type="number" class="form-control" id="tanggalMulai" name="id_tim" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <button class="btn btn-danger"><a href="tim.php">Batal</a></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if(mysqli_num_rows($result) > 0){
    ?>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Id Karyawan</th>
                    <th scope="col">Nama Karyawan</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Gaji</th>
                    <th scope="col">Id Tim</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $nomor = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $nomor ."</td>";
                    echo "<td>" . $row['id_karyawan'] . "</td>";
                    echo "<td>" . $row['nama_karyawan'] . "</td>";
                    echo "<td>" . $row['jabatan'] . "</td>";
                    echo "<td>" . $row['gaji'] . "</td>";
                    echo "<td>" . $row['id_tim'] . "</td>";
                    echo "<td>
                            <a href='edit-karyawan.php?id_karyawan=" . $row['id_karyawan'] . "' class='btn btn-warning btn-sm' >Edit</a>
                            <a href='hapus-karyawan.php?id_karyawan=" . $row['id_karyawan'] . " ' onclick='return confirm(\"Apakah yakin ingin menghapus karyawan?\")' class='btn btn-danger btn-sm' >Hapus</a>
                        </td>";
                    echo "</tr>";
                    $nomor++;
                }
            ?>
            </tbody>
        </table>
    </div>
    <?php
    } else {
        echo "<table><tr><th colspan='5'>Karyawan Belum Ada</th></tr></table>";
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>