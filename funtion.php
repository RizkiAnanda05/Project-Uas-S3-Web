<?php
$connectdb = mysqli_connect("localhost", "root", "", "data_buku");

function query($query)
{
    global $connectdb;
    $result = mysqli_query($connectdb, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambahdata($data)
{

    $nama_buku = htmlspecialchars($data["nama_buku"]);
    $jenis_buku = htmlspecialchars($data["jenis_buku"]);
    $no_buku = htmlspecialchars($data["no_buku"]);
    $stok_buku = htmlspecialchars($data["stok_buku"]);
    // $gambar = htmlspecialchars($data["gambar"]);
    //upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    global $connectdb;
    $query = "INSERT INTO buku_perpus VALUE ('','$nama_buku','$jenis_buku', '$no_buku', '$stok_buku', '$gambar')";
    mysqli_query($connectdb, $query);
    return mysqli_affected_rows($connectdb);
}
function upload()
{


    $nama_file = $_FILES['gambar']['name'];
    $size_file = $_FILES['gambar']['size'];
    $error_file = $_FILES['gambar']['error'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    //cek upload gambar
    if ($error_file === 4) {
        echo "<script>
        alert('Pilih gambar terlebih dahulu!')
        </script>";
        return false;
    }
    // cek apakah gambar yg di upload
    $ekstensigambarvalid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.', $nama_file);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
        echo "<script>
        alert('upload gambar!')
        </script>";
    }
    //cek jika ukuran terlalu besar
    if ($size_file > 1000000) {
        echo "<script>
        alert('Ukuran gambar terlalu besar!')
        </script>";
    }
    $newnamefile = uniqid();
    $newnamefile .= '.';
    $newnamefile .= $ekstensigambar;

    move_uploaded_file($tmpname, 'image/' . $newnamefile);

    return $newnamefile;
}
function hapus($id)
{
    global $connectdb;
    mysqli_query($connectdb, "DELETE FROM buku_perpus WHERE id = $id");
}
function ubah($data)
{
    global $connectdb;
    $id = $data["id"];
    $nama_buku = htmlspecialchars($data["nama_buku"]);
    $jenis_buku = htmlspecialchars($data["jenis_buku"]);
    $no_buku = htmlspecialchars($data["no_buku"]);
    $stok_buku = htmlspecialchars($data["stok_buku"]);
    $oldpict = htmlspecialchars($data["gambarlama"]);

    //cek user memasukan gammbar baru
    if ($_FILES['gambar'] === 4) {
        $gambar = $oldpict;
    } else {

        $gambar = upload();
    }

    $gambar = htmlspecialchars($data["gambar"]);
    $query = "UPDATE buku_perpus SET nama_buku = '$nama_buku', jenis_buku = '$jenis_buku' ,no_buku = '$no_buku', stok_buku ='$stok_buku', gambar = '$gambar' WHERE id = $id";
    mysqli_query($connectdb, $query);
}

function cari($keyword)
{
    global $connectdb;

    $query = "SELECT * FROM buku_perpus WHERE nama_buku LIKE '%$keyword%' OR jenis_buku LIKE '%$keyword%' OR no_buku LIKE '%$keyword%'";

    return query($query);
}

function registrasi($data)
{

    global $connectdb;
    $usernm = strtolower(stripslashes($data["username"]));
    $passwrd = mysqli_real_escape_string($connectdb, $data["password"]);
    $passwrd2 = mysqli_real_escape_string($connectdb, $data["password2"]);


    //cek username

    $result = mysqli_query($connectdb, "SELECT Username FROM users WHERE Username = '$usernm'");
    //cek konfirmasi
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Username yang dipilih sudah terdaftar!')
        </script>";
        
        return false;
    }
    if ($passwrd !== $passwrd2) {
        echo "<script>
            alert('Password tidak sesuai!!')
        </script>";
        return false;
    }
    //enkripsi password

    $passwrdenk = password_hash($passwrd, PASSWORD_DEFAULT);

    // menambahkan user ke database
    mysqli_query($connectdb, "INSERT INTO users VALUES('', '$usernm', '$passwrdenk' )");

    return mysqli_affected_rows($connectdb);
}
