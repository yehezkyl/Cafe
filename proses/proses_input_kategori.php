<?php
include "konek.php";
$jenis = (isset($_POST['jenis_menu'])) ? htmlentities($_POST['jenis_menu']) : "";
$kategori = (isset($_POST['kat_menu'])) ? htmlentities($_POST['kat_menu']) : "";

if (!empty($_POST['cek_input_kategori'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_kategori_menu WHERE kategori_menu = '$kategori'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Kategori yang dimasukkan telah ada") 
        window.location ="../katmenu"
        </script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_kategori_menu (jenis_menu,kategori_menu) Values ('$jenis','$kategori')");
        if ($query) {
            $message = '<script>alert("Data berhasil dimasukkan") 
        window.location ="../katmenu"
        </script>';
        } else {
            $message = '<script>alert("Data gagal dimasukkan")
            window.location ="../katmenu"</script>';
        }
    }
}
echo $message;
