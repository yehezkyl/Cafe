<?php
session_start();
include "konek.php";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";

if (!empty($_POST['cek_edit_order'])) {
    $query = mysqli_query($conn, "UPDATE tb_order SET meja = '$meja' , pelanggan = '$pelanggan' , catatan = '$catatan' WHERE id_order = '$kode_order'");

    if ($query) {
        $message = '<script>alert("Data berhasil dirubah") 
        window.location ="../order"</script>';
    } else {
        $message = '<script>alert("Data gagal dirubah")
            window.location ="../order"</script>';
    }
}

echo $message;
