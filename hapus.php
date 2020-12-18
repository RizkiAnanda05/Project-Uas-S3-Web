<?php
$id = $_GET["id"];
require 'funtion.php';
if ( hapus($id) > 0 ){
    echo "
        <script>
            alert('Data Gagal diHapus!');
            document.location.href = 'index.php';
        </script>
        ";
} else {
    echo "
        <script>
            alert('Data Berhasil diHapus!');
            document.location.href = 'index.php';
        </script>";
}

?>