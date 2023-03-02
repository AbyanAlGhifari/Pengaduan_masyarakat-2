<?php
SESSION_START();
include "./lib/database.php";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM masyarakat WHERE username='$username' AND password='$password';";
    $execQuery = mysqli_query($koneksi, $query);

    $getData = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);
    $numRows = mysqli_num_rows($execQuery);

    if ($numRows == 1) {
        foreach ($getData as $data) {
            $_SESSION['id'] = $data['nik'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['level'] = 'masyarakat';
        }
        header('Location:masyarakat/menulis-pengaduan.php');
    } else {
        echo '<script>alert("data anda salah")</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar">

    </nav>
    <div class="container">
        <div class="row justify-content-center align-middle">
            <div class="card col-lg-6">
                <div class="card-header">
                    <center>Login Masyarakat</center>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <input type="text" name="username" placeholder="Username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="Password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="login" value="Login" class="form-control btn btn-primary">
                        </div>
                    </form>
                </div>
                <div class="d-flex flex-row justify-content-between">
                    <a href="/pengaduan_masyarakat/masyarakat/registrasi.php" class="nav-link">Daftar</a>
                    <a href="/pengaduan_masyarakat/administrator/index.php" class="nav-link">Admin</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="dist/js/bootstrap.min.js"></script>

</html>