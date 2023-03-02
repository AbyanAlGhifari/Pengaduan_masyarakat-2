<?php
include '../lib/database.php';

if (isset($_POST['registrasi'])) {

    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telp = $_POST['telp'];

    $query = "INSERT INTO masyarakat (nik, nama, username, password, telp) VALUE ('$nik', '$nama', '$username', '$password', '$telp');";
    $execQuery = mysqli_query($koneksi, $query);

    if ($execQuery) {
        header('Location:/pengaduan_masyarakat/index.php');
    } else {
        echo '<script> alert ("data anda ada yang salah")</script>';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar">

    </nav>
    <div class="container">
        <div class="row justify-content-center align-middle">
            <div class="card col-lg-6">
                <div class="card-header">
                    <center>Daftar Akun Masyarakat</center>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <input type="text" name="nik" placeholder="Nomor Induk Kependudukan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="nama" placeholder="Nama Asli Anda" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="username" placeholder="Username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="Password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="telp" placeholder="Nomor Telepon" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="registrasi" value="Registrasi" class="form-control btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>