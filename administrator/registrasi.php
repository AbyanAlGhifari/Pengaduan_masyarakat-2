<?php
include '../lib/database.php';
SESSION_START();

if ($_SESSION['level'] != 'admin') {
    header('Location:/pengaduan_masyarakat/logout.php');
}

if (isset($_POST['registrasi'])) {

    $nama = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telp = $_POST['telp'];
    $level = $_POST['level'];

    $query = "INSERT INTO petugas (nama_petugas, username, password, telp, level) VALUE ('$nama', '$username', '$password', '$telp', '$level');";
    $execQuery = mysqli_query($koneksi, $query);

    if ($execQuery) {
        header('Location:/pengaduan_masyarakat/administrator/index.php');
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
                    <center>Daftar Akun Admin</center>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <input type="text" name="nama_petugas" placeholder="Nama Asli Anda" class="form-control" required>
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
                            <select name="level" class="form-control">
                                <option value="petugas">Petugas</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="registrasi" value="Registrasi" class="form-control btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>