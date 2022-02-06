<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
// koneksi database => sudah dilakukan melalui function
require 'function.php';

// ambil data di URL dengan $_GET
$id = $_GET["id"];

// query mahasiswa berdasarkan id
$mhs = query("SELECT * FROM siswa WHERE id = $id ")[0];

if (isset($_POST["submit"])) {

    // cek apakah data berhasil masuk ke database atau tidak
    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert ('data berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "
            <script>
                alert ('data gagal diubah!');
                document.location.href = 'index.php';
            </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body>
    <h1>Ubah data Mahasiswa</h1>
    <div style="display: block;" class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $mhs["id"]; ?> ">
            <input type="hidden" name="gambarLama" value="<?php echo $mhs["gambar"]; ?> ">
            <ul>
                <li>
                    <label for="nama"> Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" required value="<?php echo $mhs["nama"] ?>">
                </li>
                <li>
                    <label for="nim"> Nim</label>
                    <input type="text" class="form-control" name="nim" id="nim" required value="<?php echo $mhs["nim"] ?>">
                </li>
                <li>
                    <label for="jurusan"> Jurusan</label>
                    <input type="text" class="form-control" name="jurusan" id="jurusan" required value="<?php echo $mhs["jurusan"] ?>">
                </li>
                <li>
                    <label for="email"> Email</label>
                    <input type="text" class="form-control" name="email" id="email" required value="<?php echo $mhs["email"] ?>">
                </li>
                <div class="card" style="width: 18rem;">
                    <img src="img/<?= $mhs['gambar']; ?>" class="card-img-top" width="100">
                    <input class="form-control" type="file" name="gambar" id="gambar">
                    <div class="card-body">
                        <h5 class="card-title">Foto <?php echo $mhs["nama"]; ?></h5>
                        <p class="card-text"></p>
                    </div>
                </div>
                <!-- <li>
                    <label for="gambar"> Gambar</label> <br>
                    <img src="img/<?= $mhs['gambar']; ?>" width=" 80"> <br>
                    <input class="form-control" type="file" name="gambar" id="gambar">
                </li> -->
                <br>
                <li>
                    <button class="btn btn-info" type="submit" name="submit">Ubah data!</button>
                </li>
            </ul>
        </form>
    </div>
</body>

</html>