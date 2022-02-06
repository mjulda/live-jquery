<?php
session_start();

if ( !isset ($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
// koneksi database => sudah dilakukan melalui function
require 'function.php';

if (isset($_POST["submit"])) {

    // cek apakah data berhasil masuk ke database atau tidak
    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert ('data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "
            <script>
                alert ('data gagal ditambahkan!');
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
    <title>Tambah data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body>
    <h1>Tambah data Mahasiswa</h1>
    <div style="display: block;" class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <ul>
                <li >
                    <label for="nama"> Nama</label>
                    <input type="text"  class="form-control"  name="nama" id="nama" placeholder="Cth: Julda"  required>
                </li>
                <li>
                    <label for="nim"> Nim</label>
                    <input type="text"  class="form-control"  name="nim" id="nim"  required>
                </li>
                <li>
                    <label for="jurusan"> Jurusan</label>
                    <input type="text"  class="form-control"  name="jurusan" id="jurusan"  required>
                </li>
                <li>
                    <label for="email"> Email</label>
                    <input type="text"  class="form-control"  name="email" id="email"  required>
                </li>
                <li>
                    <label for="gambar"> Gambar</label>                    
                    <input type="file"  class="form-control"  name="gambar" id="gambar"  required>
                </li>
                <li>
                    <button class="btn btn-primary btn-sm"  type="submit" name="submit">Tambah data!</button>
                    <!-- <a class="btn btn-primary btn-sm" href="tambah.php"> -->
                </li>
            </ul>
        </form>
    </div>
</body>

</html>