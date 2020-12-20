<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: Login.php");
}

require 'funtion.php';
if (isset($_POST["submit"])) {

    if (tambahdata($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahakn!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "<script>
                alert('data gagal ditambahakn!');
                document.location.href = 'tambah.php';
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
    <h1>Tambah Data</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama_buku">Nama Buku : </label>
                <br>
                <input type="text" name="nama_buku" id="nama_buku" required>
            </li>
            <li>
                <label for="jenis_buku">Jenis Buku : </label>
                <br>
                <input type="text" name="jenis_buku" id="jenis_buku">
            </li>
            <li>
                <label for="no_buku">Nomor Buku : </label>
                <br>
                <input type="text" name="no_buku" id="no_buku" required>
            </li>
            <li>
                <label for="stok_buku">Stok : </label>
                <br>
                <input type="text" name="stok_buku" id="stok_buku" required>
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <br></br>
            <button type="submit" name="submit">Tambah</button>
        </ul>

    </form>

</body>

</html>