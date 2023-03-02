<?php
include '../lib/database.php';
SESSION_START();

if (($_SESSION['level'] != 'admin' AND ($_SESSION['level'] != 'petugas'))) {
    header('Location:/pengaduan_masyarakat/logout.php');
}

if (empty($_GET['id'])) {
    header('Location:/pengaduan_masyarakat/administrator/index.php');
}

if (isset($_POST['tanggapi'])) {
    $id_pengaduan = $_GET['id'];
    $tanggapan = $_POST['tanggapan'];
    $id_petugas = $_SESSION['id'];
    $queryTanggapi = "  INSERT INTO tanggapan (id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) 
                        VALUES ('$id_pengaduan',now(), '$tanggapan', $id_petugas);";
    $execQueryTanggapi = mysqli_query($koneksi, $queryTanggapi);
    if ($execQueryTanggapi) {
        header('Location:/pengaduan_masyarakat/administrator/verifikasi/valid.php');
    } else {
        echo '<script>alert("tanggapan anda ada yang salah")</script>';
    }
};

$id_pengaduan = $_GET['id'];
$queryAduan = "SELECT * FROM pengaduan WHERE id_pengaduan='$id_pengaduan';";
$execQueryAduan = mysqli_query($koneksi, $queryAduan);
$getDataAduan = mysqli_fetch_all($execQueryAduan, MYSQLI_ASSOC);
foreach ($getDataAduan as $data) {
    if (($data['status'] != '0' AND ($data['status'] != 'proses'))) {
        header('Location:/pengaduan_masyarakat/administrator/verifikasi/valid.php');
    }
};

$id_pengaduan = $_GET['id'];
$queryTanggapan = " SELECT p.nama_petugas as nama_petugas, t.id_tanggapan as id_tanggapan, t.id_pengaduan as id_pengaduan, t.tgl_tanggapan as tgl_tanggapan, t.tanggapan as tanggapan 
                    FROM tanggapan t JOIN petugas p WHERE t.id_petugas = p.id_petugas AND id_pengaduan='$id_pengaduan';";
$execQueryTanggapan = mysqli_query($koneksi, $queryTanggapan);
$getDataTanggapan = mysqli_fetch_all($execQueryTanggapan, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menulis Tanggapn</title>
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/pengaduan_masyarakat/administrator/verifikasi/nonvalid.php" class="nav-link">Pengaduan Non Valid</a>
                </li>
                <li class="nav-item">
                    <a href="/pengaduan_masyarakat/administrator/verifikasi/valid.php" class="nav-link">Pengaduan Valid</a>
                </li>
                <li class="nav-item">
                    <a href="/pengaduan_masyarakat/administrator/verifikasi/proses.php" class="nav-link">Pengaduan Proses</a>
                </li>
                <li class="nav-item">
                    <a href="/pengaduan_masyarakat/administrator/verifikasi/selesai.php" class="nav-link">Pengaduan Selesai</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center align-middle">
            <div class="card col-lg-6">
                <div class="card-header">
                    <center>
                        <h2>Tanggapan</h2>
                    </center>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Foto Penunjang</th>
                                <th>Tangal Aduan</th>
                                <th>Aduan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($getDataAduan  as $data) {
                                echo "
                                <tr>
                                    <td>
                                        <img src=$data[foto] width=100px height=100px />
                                    </td>
                                    <td>$data[tgl_pengaduan]</td>
                                    <td>$data[isi_laporan]</td>
                                </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-lg-6">
                <div class="card-header">
                    <center>
                        <h2>Beri Tanggapan</h2>
                    </center>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label>Tanggapan</label>
                            <textarea name="tanggapan" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="tanggapi" value="Tanggapi" class="form-control btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <h2 class='padding-top : 10px ;'>
            <center>List Tanggapan</center>
        </h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tangal Tanggapan</th>
                    <th>Tanggapan</th>
                    <th>Nama Penanggap</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no=0;
                foreach ($getDataTanggapan as $data) {
                    $no+=1;
                    echo "
                        <tr>
                            <td>$no</td>
                            <td>$data[tgl_tanggapan]</td>
                            <td>$data[tanggapan]</td>
                            <td>$data[nama_petugas]</td>
                        </tr>
                    ";
                }

                ?>
            </tbody>
        </table>
    </div>
</body>

</html>