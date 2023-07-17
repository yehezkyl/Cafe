<?php
session_start();
include "konek.php";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$total = (isset($_POST['total'])) ? htmlentities($_POST['total']) : "";
$nominal_bayar = (isset($_POST['nominal_bayar'])) ? htmlentities($_POST['nominal_bayar']) : "";
$kembalian = $nominal_bayar - $total;

if (!empty($_POST['cek_bayar'])) {
    if ($kembalian < 0) {
        $message = '<script>alert("Nominal Uang Kurang !"); 
        window.location ="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"
        </script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_bayar (id_bayar,nominal_uang,total_bayar) Values ('$kode_order','$nominal_bayar','$total')");
        if ($query) {
            $message = '<script>alert("Pembayaran berhasil \nJumlah Uang Kembalian Rp. ' . $kembalian . '"); 
        window.location ="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"
        </script>';
        } else {
            $message = '<script>alert("Pembayaran gagal")
            window.location ="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"
        </script>';
        }
    }
}
echo $message;
