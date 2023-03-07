<?php
SESSION_START();
include '../lib/database.php';

if ($_SESSION['level'] != 'admin') {
    header('Location:/pengaduan_masyarakat/logout.php');
}


$query = "  SELECT m.nama as nama, p.tgl_pengaduan as tgl_pengaduan, p.isi_laporan as isi_laporan, p.foto as foto, p.status as status
            FROM pengaduan p JOIN masyarakat m WHERE p.nik = m.nik";
$execQuery = mysqli_query($koneksi, $query);
$getData = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate laporan</title>
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="justify-content-center">
            <center>
                <h2>Seluruh Laporan Yang Masuk</h2>
            </center>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pengadu</th>
                        <th>Tanggal Aduan</th>
                        <th>Isi Aduan</th>
                        <th>Foto Aduan</th>
                        <th>Status Aduan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=0;
                    foreach ($getData as $data) {
                        $no+=1;
                        if ($data['status'] == NULL) {
                            $status = 'Belum Valid';
                        } else if ($data['status'] == '0'){
                            $status = 'Valid';
                        } else {
                            $status = $data['status'];
                        }
                        echo "
                            <tr>
                                <td>$no</td>
                                <td>$data[nama]</td>
                                <td>$data[tgl_pengaduan]</td>
                                <td>$data[isi_laporan]</td>
                                <td>
                                <img src=$data[foto] width=100px height=100px />
                                </td>
                                <td>$status</td>
                            </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script type="text/javascript">
    window.print()
</script>
</html>