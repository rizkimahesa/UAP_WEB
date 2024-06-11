<?php
    include 'koneksi.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_material = $_POST["nama_material"];
        $harga = $_POST["harga"];

        if (empty($nama_material) || (empty($harga))) {
            echo "Semua bidang harus diisi.";
        } else {
            $check_query = "SELECT * FROM material WHERE nama_material = '$nama_material'";
            $result = mysqli_query($conn, $check_query);
            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('Material sudah ada.');</script>";
            } else{
                $id_query = "SELECT MIN(t1.id_material + 1) AS next_id FROM material t1 LEFT JOIN material t2 ON t1.id_material + 1 = t2.id_material WHERE t2.id_material IS NULL";
                $id_result = mysqli_query($conn, $id_query);
                $row = mysqli_fetch_assoc($id_result);
                $next_id = $row['next_id'] ?? 1;

                $sql = "INSERT INTO material (id_material, nama_material, harga) VALUES ('$next_id', '$nama_material', '$harga')";
                
                if(mysqli_query($conn, $sql)){
                    header("Location: material.php");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
    }

    $query =  "SELECT * FROM material";
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
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahTimModal">Tambah Material</button>
    <div class="modal fade" id="tambahTimModal" tabindex="-1" aria-labelledby="tambahTimModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahTimModalLabel">Tambah Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tambahTimForm" action="material.php" method="post">
                        <div class="mb-3">
                            <label for="namaProyek" class="form-label">Nama Material</label>
                            <input type="text" class="form-control" id="namaProyek" name="nama_material" required>
                            <label for="lokasi" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="lokasi" name="harga" required>
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
                    <th scope="col">Id Material</th>
                    <th scope="col">Nama Material</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $nomor = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $nomor ."</td>";
                    echo "<td>" . $row['id_material'] . "</td>";
                    echo "<td>" . $row['nama_material'] . "</td>";
                    echo "<td>" . $row['harga'] . "</td>";
                    echo "<td>
                            <a href='edit-material.php?id_material=" . $row['id_material'] . "' class='btn btn-warning btn-sm' >Edit</a>
                            <a href='hapus-material.php?id_material=" . $row['id_material'] . " ' onclick='return confirm(\"Apakah yakin ingin menghapus material?\")' class='btn btn-danger btn-sm' >Hapus</a>
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
        echo "<table><tr><th colspan='5'>Material Belum Ada</th></tr></table>";
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>