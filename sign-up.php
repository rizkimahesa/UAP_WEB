<?php
    include 'koneksi.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["admin_username"];
    $number = $_POST["phone"];
    $password = $_POST["admin_password"];

    if (empty($username) || empty($number) || empty($password)) {
        echo "Semua bidang harus diisi.";
    } else {
        // Buat kueri SQL untuk memeriksa keberadaan username di dalam tabel pengguna
        $check_query = "SELECT * FROM akun_admin WHERE nama_admin = '$username'";

        // Eksekusi kueri SQL
        $result = mysqli_query($conn, $check_query);

        // Periksa hasil kueri
        if (mysqli_num_rows($result) > 0) {
            // Jika username sudah ada, tampilkan pesan kesalahan
            echo "<script>alert('Username sudah digunakan. Silakan coba dengan username yang lain.');</script>";
        } else {
            $sql = "INSERT INTO akun_admin (nama_admin, no_telepon, password) VALUES ('$username', '$number', '$password')";
            
            if (mysqli_query($conn, $sql)) {
                header("Location: login-admin.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
    // Tutup koneksi
    mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="gambar/icon.png">
    <style>
        .card-header{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login-link{
            text-decoration: none;
            align-item: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="gambar/icon.png" alt="logo-icon" width="20%">
                        <h3 class="mb-0">Sign Up</h3>
                    </div>
                    <div class="card-body">
                        <form action="sign-up.php" method="POST">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="admin_username" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">No Telepon:</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="admin_password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="login-admin.php" class="login-link">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
