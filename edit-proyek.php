<?php
include 'koneksi.php';

$id = $_GET['id_proyek'];
$query = "SELECT * FROM proyek WHERE id_proyek = '$id'";
$result = mysqli_query($conn, $query);

// Check if the query executed successfully
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch the team data
$row = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Proyek</title>
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

    <div class="container">
        <h2>Edit Proyek</h2>
        <form id="editTeamForm" action="update-proyek.php" method="post">
            <div class="mb-3">
                <label for="editIdProyek" class="form-label">Id Proyek</label>
                <input type="text" name="id_proyek" class="form-control" value="<?php echo $row['id_proyek']; ?>" readonly>
                <label for="editNamaProyek" class="form-label">Nama Proyek</label>
                <input type="text" class="form-control" id="editNamaProyek" name="nama_proyek" value="<?php echo $row['nama_proyek']; ?>" readonly>
                <label for="editLokasi" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="editLokasi" name="lokasi" value="<?php echo $row['lokasi']; ?>" readonly>
                <label for="editDeskripsi" class="form-label">Deskripsi</label>
                <input type="text" class="form-control" id="editDeskripsi" name="deskripsi" value="<?php echo $row['deskripsi']; ?>" required>
                <label for="editTanggalMulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="editTanggalMulai" name="tanggal_mulai" value="<?php echo $row['tanggal_mulai']; ?>" required>
                <label for="editTanggalSelesai" class="form-label">Tanggal Selesai</label>
                <input type="date" class="form-control" id="editTanggalSelesai" name="tanggal_selesai" value="<?php echo $row['tanggal_selesai']; ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
            <a href="proyek.php" class="btn btn-danger">Batal</a>
        </form>
    </div>

    <!-- Bootstrap and other scripts -->
</body>
</html>
