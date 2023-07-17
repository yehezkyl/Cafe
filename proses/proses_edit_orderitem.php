<?php
session_start();
include "konek.php";
$id_list = (isset($_POST['id_list'])) ? htmlentities($_POST['id_list']) : "";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$jumlah = (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "";

if (!empty($_POST['cek_edit_orderitem'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_list_order WHERE menu = '$menu' && kode_order='$kode_order' && id_list_order != '$id_list'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Item yang dimasukkan telah ada"); 
        window.location ="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"
        </script>';
    } else {
        $query = mysqli_query($conn, "UPDATE tb_list_order SET menu='$menu',jumlah='$jumlah',catatan_item='$catatan' WHERE id_list_order='$id_list'");
        if ($query) {
            $message = '<script>alert("Data berhasil dimasukkan"); 
        window.location ="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"
        </script>';
        } else {
            $message = '<script>alert("Data gagal dimasukkan")
            window.location ="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"
        </script>';
        }
    }
}
echo $message;
