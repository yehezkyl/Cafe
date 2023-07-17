<?php
include "konek.php";
$id = (isset($_POST['id_menu'])) ? htmlentities($_POST['id_menu']) : "";
$foto = (isset($_POST['foto'])) ? htmlentities($_POST['foto']) : "";

if (!empty($_POST['cek_hapus_menu'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_daftar_menu WHERE id_menu='$id'");
    if ($query) {
        unlink("../assets/img/$foto");
        $message = '<script>alert("Data berhasil dihapus")
        window.location ="../menu"
        </script>';
    } else {
        $message = '<script>alert("Data gagal dihapus")
        window.location ="../menu"
        </script>';
    }
}
echo $message;
