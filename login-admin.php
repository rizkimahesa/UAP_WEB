<?php
    include 'koneksi.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["admin_username"];
        $password = $_POST["admin_password"];

        $check_query = "SELECT * FROM akun_admin WHERE nama_admin = '$username' AND password = '$password'";

        $result = mysqli_query($conn, $check_query);

        if ($result) {
            // Jika baris yang dikembalikan lebih dari 0
            if (mysqli_num_rows($result) > 0) {
              session_start();
              $_SESSION['admin_username'] = $username;
              header("Location: index.php");
              exit();
            } else {
                echo "<script>alert('Username dan password tidak ada.');</script>";
            }
        } else {
            echo "<script>alert('Terjadi kesalahan dalam eksekusi query.');</script>";
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
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="gambar/icon.png">
    <style>
        .card-header{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sign-up-link{
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
                        <h3 class="mb-0">Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="login-admin.php" method="post">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="admin_username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="admin_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="sign-up.php">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
