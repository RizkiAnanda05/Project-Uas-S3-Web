<?php
require 'funtion.php';
//mengambil data di url

$id = $_GET["id"];
//query data berdasatkan id

$buku = query("SELECT * FROM buku_perpus WHERE id = $id")[0];

if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert('data gagal diUbah!');
                document.location.href = 'Ubah.php';
            </script>";
    } else {
        echo "<script>
                alert('data Berhasil diUbah!');
                document.location.href = 'index.php';
            </script>";
    }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>

<body>
    <h1>Ubah Data</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $buku["id"]; ?>">
        <input type="hidden" name="gambarlama" value="<?= $buku["gambar"]; ?>">
        <ul>
            <li>
                <label for="nama_buku">Nama Buku : </label>
                <br>
                <input type="text" name="nama_buku" id="nama_buku" required value="<?= $buku["nama_buku"] ?>">
            </li>
            <li>
                <label for="jenis_buku">Jenis Buku : </label>
                <br>
                <input type="text" name="jenis_buku" id="jenis_buku" required value="<?= $buku["jenis_buku"] ?>">
            </li>
            <li>
                <label for="no_buku">Nomor Buku : </label>
                <br>
                <input type="text" name="no_buku" id="no_buku" required required value="<?= $buku["no_buku"] ?>">
            </li>
            <li>
                <label for="stok_buku">Stok : </label>
                <br>
                <input type="text" name="stok_buku" id="stok_buku" required required value="<?= $buku["stok_buku"] ?>">
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <br>
                <img src="image/<?= $buku['gambar']; ?>" width="50">
                <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <button type="submit" name="submit">Ubah</button>
        </ul>

    </form>

</body>

</html>