<?php
// usleep(2000);
require '../function.php';
// ajax.open('GET','ajax/mahasiswa.php?keywords='+ keywords.value,true);
// pada saat kita mengambil data di mahasiswa.php degan GET
// kita juga sambil mengirim data keywords
// lalu di tangkap dari keywords.value di atas
$keywords = $_GET["keywords"];
$query = "SELECT * FROM siswa
            WHERE 
            nama LIKE '%$keywords%' OR
            nim LIKE '%$keywords%' OR
            jurusan LIKE '%$keywords%' OR
            email LIKE '%$keywords%'
            ";
$mahasiswa = query($query);

?>
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
                <td><img src="img/<?php echo $row["gambar"]; ?> " width="50"></td>
                <td><?php echo $row["nama"]; ?> </td>
                <td><?php echo $row["nim"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["jurusan"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>