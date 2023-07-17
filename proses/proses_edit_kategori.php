<?php
include "konek.php";
$id = (isset($_POST['id_katmenu'])) ? htmlentities($_POST['id_katmenu']) : "";
$jenis = (isset($_POST['jenis_menu'])) ? htmlentities($_POST['jenis_menu']) : "";
$kategori = (isset($_POST['kat_menu'])) ? htmlentities($_POST['kat_menu']) : "";

if (!empty($_POST['cek_edit_kategori'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_kategori_menu WHERE kategori_menu = '$jenis'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Kategori yang dimasukkan telah ada"); 
        window.location ="../katmenu"
        </script>';
    } else {
        $query = mysqli_query($conn, "UPDATE tb_kategori_menu SET jenis_menu='$jenis', kategori_menu='$kategori' WHERE id_kat_menu='$id'");
        if ($query) {
            $message = '<script>alert("Data berhasil diupdate"); 
        window.location ="../katmenu"
        </script>';
        } else {
            $message = '<script>alert("Data gagal diupdate")
            window.location ="../katmenu"</script>';
        }
    }
}
echo $message;
