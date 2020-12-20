<?php

session_start();
//cek session
if (!isset($_SESSION["login"])) {
    header("Location: Login.php");
}

//memanggil file dari php lain
require 'funtion.php';


//pagination
$jumlahdataperhalaman = 2;
// $result = mysqli_query($connectdb,  "SELECT * FROM buku_perpus");

// $jumlahdata = mysqli_num_rows($result);

$jumlahdata = count(query("SELECT * FROM buku_perpus"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
// if ( isset($_GET["page"] )){
//     $halamanaktif = $_GET["page"];
// }else{
//     $halamanaktif = 1;
// }

$halamanaktif = (isset($_GET["page"])) ? $_GET["page"] : 1;
$awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
$databuku1 = query("SELECT * FROM buku_perpus LIMIT $awaldata, $jumlahdataperhalaman");

if (isset($_POST["cari"])) {

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
        <input type="text" name="keyword" autofocus placeholder="Masukan Pencarian" autocomplete="off" id="keyword">
        <button type="submit" name="cari" size="30" id="tombolcari">Cari</button>
        <br></br>
    </form>
    <br>
    <?php if ($halamanaktif > 1) : ?>
        <a href="?page=<?= $halamanaktif - 1; ?>">&laquo;</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $jumlahhalaman; $i++) : ?>
        <?php if ($i == $halamanaktif) : ?>
            <a href="?page=<?= $i; ?>" style="font-weight: bold; color: red;"><?php echo $i; ?></a>
        <?php else : ?>
            <a href="?page=<?= $i; ?>"><?php echo $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>


    <?php if ($halamanaktif < $jumlahhalaman) : ?>
        <a href="?page=<?= $halamanaktif + 1; ?>">&raquo; </a>
    <?php endif; ?>
    <div id="containter"></div>
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
    </div>

    <script src="js/script.js"></script>
    <a href="Logout.php">Logout</a>
</body>

</html>