<?php
//memanggil file dari php lain
require 'funtion.php';

$databuku1 = query("SELECT * FROM buku_perpus ORDER BY nama_buku ASC");

if (isset($_POST["cari"])){

    $databuku1 = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Admin</title>
</head>

<body>
    <h1>Daftar Buku</h1>
    <a href="tambah.php">Tambah data buku</a>
    <br></br>
    <form action="" method="POST">
        <input type="text" name="keyword" autofocus placeholder="Masukan Pencarian" autocomplete="off">
        <button type="submit" name="cari" size="30">Cari</button>
        <br></br>
    </form> 
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
        <?php foreach ($databuku1 as $row) : ?>
            <tr>
                <td><?= $nomor; ?></td>
                <td><img src="image/<?= $row["gambar"] ?>" width="50"></td>
                <td><?= $row["nama_buku"] ?></td>
                <td><?= $row["jenis_buku"] ?></td>
                <td><?= $row["no_buku"] ?></td>
                <td><?= $row["stok_buku"] ?></td>
                <td>
                    <a href="Ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
                    <a href=" hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Anda Yakin Akan menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php $nomor++; ?>
        <?php endforeach; ?>
    </table>
</body>

</html>