<?php
session_start();
include "konek.php";
$id_list = (isset($_POST['id_list'])) ? htmlentities($_POST['id_list']) : "";
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";
$status = 2;

if (!empty($_POST['cek_siap'])) {
    $query = mysqli_query($conn, "UPDATE tb_list_order SET catatan_item='$catatan',status='$status' WHERE id_list_order='$id_list'");
    if ($query) {
        $message = '<script>alert("Berhasil Siap Saji"); 
        window.location ="../dapur"</script>';
    } else {
        $message = '<script>alert("Gagal Siap Saji")
            window.location ="../dapur"</script>';
    }
}
echo $message;
