<?php
//konek database
$connectdb = mysqli_connect("localhost", "root", "", "data_buku");
//mengambil data dari table /query data
$result = mysqli_query($connectdb, "SELECT * FROM buku_perpus");

//mengembalikan nilai numerik
// $data1 = mysqli_fetch_row($result);
// var_dump($data1[3]);
//array assosiatif
// $data1 = mysqli_fetch_assoc($result);
// var_dump($data1["nama_buku"]);
//array numerik dan assosiatof kekurangan = data double
// $data1 = mysqli_fetch_array($result);
// var_dump($data1[3]);

// while( $data1 = mysqli_fetch_assoc($result)){
//     var_dump($data1["nama_buku"]);
// };


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Admin</title>
</head>

<body>
    <h1>Daftar Buku</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Gambar<d>
            <th>Nama</th>
            <th>Jenis Buku</th>
            <th>No Buku</th>
            <th>Stok</th>
            <th>Aksi</hd>
        </tr>
        <?php $nomor = 1; ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $nomor; ?></td>
                <td><img src="image/<?= $row["gambar"] ?>" width="50"></td>
                <td><?= $row["nama_buku"] ?></td>
                <td><?= $row["jenis_buku"] ?></td>
                <td><?= $row["no_buku"] ?></td>
                <td><?= $row["stok_buku"] ?></td>
                <td>
                    <a href="">Ubah</a> |
                    <a href="">Hapus</a>
                </td>

            </tr>
            <?php $nomor++; ?>
        <?php endwhile; ?>
    </table>
</body>

</html>