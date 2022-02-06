<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
// memasukkan function koneksi database
require 'function.php'; // bisa juga menggunakan include
// ambil data dari tabel mahasiswa / query data mahasiswa
// $result = mysqli_query($connecdb, "SELECT * FROM mahasiswa");

$mahasiswa = query("SELECT * FROM siswa ORDER BY id DESC");

if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keywords"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP MYSQL</title>

    <link rel="stylesheet" href="css/load.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body>

    <div class="container">

        <a href="logout.php">Logout</a>

        <h2>Daftar Mahasiswa</h2>
        <a class="btn btn-primary btn-sm" href="tambah.php">Tambah Data Mahasiswa</a>
        <br><br>
        <form action="" method="post">
            <input type="text" name="keywords" size="40" autofocus placeholder="Cari data mahasiswa..." autocomplete="off" id="keywords">
            <!-- <button type="submit" id="tombol-cari" name="cari">Cari Data</button> -->

            <img src="img/load.gif" class="load">
        </form>
        <br>
        <div id="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Aksi</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Nim</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($mahasiswa as $row) : ?>
                        <tr>
                            <td><?php echo $i++; ?> </td>
                            <td>
                                <a href="ubah.php?id=<?php echo $row["id"]; ?>">Ubah</a> |
                                <a href="hapusdata.php?id=<?php echo $row["id"]; ?>" onclick="return confirm ('yakin?')">Hapus</a>
                            </td>
                            <td><img src="img/<?php echo $row["gambar"]; ?> " height="100"></td>
                            <td><?php echo $row["nama"]; ?> </td>
                            <td><?php echo $row["nim"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["jurusan"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="Javascript/jquery-3.6.0.min.js"></script>
    <script src="Javascript/script.js"></script>
</body>

</html>