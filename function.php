<?php
// koneksi ke database
$connecdb = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query)
{
    global $connecdb;
    $result = mysqli_query($connecdb, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function tambah($data)
{
    // mengambil data dari setiap element yang ada di form
    global $connecdb;
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);
    

    // jalankan fungsi upload gambar dulu
    // upload gambar
    // $gambar kalau berhasil akan di isi dengan nama gambar
    // kalau fungsi $upload gagal tidak ada nama yang dikirimkan
    
    $gambar = upload();
    if (!$gambar){
        return false;
    }

    // query insert data
    $query = "INSERT INTO siswa 
                VALUES 
                ('','$nama','$nim','$jurusan', '$email', '$gambar')
            ";
    mysqli_query($connecdb,$query);
    // setelah di jalankan query
    // function akan mengembalikan angka
    return mysqli_affected_rows($connecdb);

}
function upload (){
    
    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $error = $_FILES ["gambar"]["error"];
    $tmpName =  $_FILES ["gambar"]["tmp_name"];


    // cek apakah tidak ada gambar yang di upload
    if ($error === 4){
        echo "<script>
             alert ('pilih gambar terlebih dahulu!')
        </script>";
        
    return false;
    }

    // cek apakah yang di upload adalah gambar
    $extensiGambarValid = ['jpg', 'png', 'jpeg'];
    // memisahkan sana dan extensi gambar menggunakan parm (.),
    $extensiGambar = explode('.',$namaFile);
    $extensiGambar = strtolower(end($extensiGambar));
    if (!in_array($extensiGambar,$extensiGambarValid)){
        echo "<script>
            alert ('Yang anda upload bukan gambar!')
            </script>";
        return false;
    }

    // cek jika ukuran file terlalu besar
    if($ukuranFile >1000000){
        echo "<script>
            alert ('ukuran gambar terlalu besar!')
            </script>";
        return false;
    }
    // lolos pengecekan, gambar siap di upload
    // generate nama gambar baru 
    // agar ketika di upload tidak di timpah pada foto dengan nama yang sama
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensiGambar;


    move_uploaded_file($tmpName, 'img/'. $namaFileBaru );
    return $namaFileBaru;

}


function hapus ($id){
    global $connecdb;
    mysqli_query($connecdb, "DELETE FROM siswa WHERE id =$id");
    return mysqli_affected_rows($connecdb);
  
}
function ubah ($data){
    global $connecdb;

    // mengambil data dari setiap element yang ada di form
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES ['gambar']['error'] === 4){
        // jika user tidak mengubah gambar
        $gambar = $gambarLama ;
    } else {
        // jika user mengubah gambar, maka jalankan fungsi upload
        $gambar = upload();
    }

      // query insert data
    $query = "UPDATE siswa SET  
             nama = '$nama',
             nim = '$nim',
             jurusan ='$jurusan',
             email = '$email',
             gambar = '$gambar'

             WHERE id = $id
            ";
    mysqli_query($connecdb,$query);
    // setelah di jalankan query
    // function akan mengembalikan angka
    return mysqli_affected_rows($connecdb);

}

function cari ($keywords){
    $query = "SELECT * FROM siswa
            WHERE 
            nama LIKE '%$keywords%' OR
            nim LIKE '%$keywords%' OR
            jurusan LIKE '%$keywords%' OR
            email LIKE '%$keywords%'
            ";
    return query($query);
}
function registrasi ($data){
    global $connecdb;
    $username = strtolower(stripslashes($data["username"])) ; // kita harus membersihkan inputan user seperti // \\ dll
    $password = mysqli_real_escape_string ($connecdb,$data ["password"]);
    $confpassword = mysqli_real_escape_string ($connecdb, $data ["confpassword"]);

    // cek apakah username sudah ada di database atau belum
    $result = mysqli_query($connecdb, "SELECT username FROM users WHERE username = '$username' ");
   
    if (mysqli_fetch_assoc($result)){
        echo "<script>
        alert ('username sudah terdaftar!');
        </script>";
    return false;
    }


    // cek konfirmasi password
    if ($password !== $confpassword){
        echo "<script>
            alert ('konfirmasi password tidak sesuai!');    
        </script>";
        return false;
    }
    // enkripsi password
    $password = password_hash($password,PASSWORD_DEFAULT); 
         // $password = md5($password); (jangan menggunakan algoritmai md5 untuk enkripsi password)
         // var_dump($password);
    // tambahkan user baru ke data base
    mysqli_query($connecdb, "INSERT INTO users VALUES('', '$username', '$password')");
    return mysqli_affected_rows($connecdb);
}
?>