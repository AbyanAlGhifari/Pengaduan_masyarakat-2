<?php
include '../lib/database.php';
SESSION_START();

$id_user = $_SESSION['id'];
$queryShowData = "SELECT * FROM pengaduan WHERE nik = '$id_user';";
$execQueryShowData = mysqli_query($koneksi, $queryShowData);
$getAllData = mysqli_fetch_all($execQueryShowData, MYSQLI_ASSOC);


if (isset($_POST['adukan'])) {

    $laporan = $_POST['laporan'];

    $locationTemp = $_FILES['foto']['tmp_name'];
    $destinationFile = '../assets/img/';
    $ServerName = 'http://190.100.0.133/pengaduan_masyarakat/assets/img/';

    $fileName = str_replace(' ','',$_FILES['foto']['name']);
    $locationUpload = $destinationFile.$fileName;
    move_uploaded_file($locationTemp, $locationUpload);

    $query = "INSERT INTO pengaduan (tgl_pengaduan, nik, isi_laporan, foto, status) VALUES (now(), '$id_user', '$laporan', '$ServerName$fileName', NULL);";
    $execQuery = mysqli_query($koneksi, $query);
    if ($execQuery) {
        header('Location:/pengaduan_masyarakat/masyarakat/menulis-pengaduan.php');
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
    <title>Menulis Pengaduan</title>
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar">

    </nav>
    <div class="container">
        <div class="row justify-content-center align-middle">
            <div class="col-lg-6">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Foto Penunjang</label>
                        <input type="file" name="foto" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi Pengaduan</label>
                        <textarea name="laporan" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Adukan" name="adukan" class="form-control btn btn-danger">
                    </div>
                </form>
            </div>
            <div class="col-lg-12">
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Tanggal Aduan</th>
                        <th>Foto</th>
                        <th>Isi Laporan</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <?php
                            $no=0;
                            foreach ($getAllData as $data) {
                                if ($data['status'] == NULL) {
                                    $status = 'Belum Valid';
                                } else {
                                    $status = $data['status'];
                                };
                                $no+=1;
                                echo "
                                    <tr>
                                        <td>$no</td>
                                        <td>$data[tgl_pengaduan]</td>
                                        <td>
                                            <img src=$data[foto] width=100px height=100px/>
                                        </td>
                                        <td>$data[isi_laporan]</td>
                                        <td>$status</td>
                                    </tr>
                                ";
                            };
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>