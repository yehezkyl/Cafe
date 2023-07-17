<?php
include "konek.php";
$id = (isset($_POST['id_menu'])) ? htmlentities($_POST['id_menu']) : "";
$nama_menu = (isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";
$keterangan = (isset($_POST['keterangan'])) ? htmlentities($_POST['keterangan']) : "";
$kat_menu = (isset($_POST['kat_menu'])) ? htmlentities($_POST['kat_menu']) : "";
$harga = (isset($_POST['harga'])) ? htmlentities($_POST['harga']) : "";
$stok = (isset($_POST['stok'])) ? htmlentities($_POST['stok']) : "";

$kode_rand = rand(10000, 99999) . "-";
$target_dir = "../assets/img/" . $kode_rand;
$target_file = $target_dir . basename($_FILES['foto']['name']);
$imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


if (!empty($_POST['cek_input_menu'])) {
    //cek gambar
    $cek = getimagesize($_FILES['foto']['tmp_name']);
    if ($cek === false) {
        $message = "Ini bukan File Gambar";
        $statusUpload = 0;
    } else {
        $statusUpload = 1;
        if (file_exists($target_file)) {
            $message = "Maaf, File telah ada";
            $statusUpload = 0;
        } else {
            if ($_FILES['foto']['size'] > 500000) {
                $message = "File foto terlalu besar";
                $statusUpload = 0;
            } else {
                if ($imageType != "jpg" && $imageType != "jpeg" && $imageType != "png") {
                    $message = "Maaf, hanya didiperbolehkan gambar berformat JPG, JPEG, PNG";
                    $statusUpload = 0;
                }
            }
        }
    }

    if ($statusUpload == 0) {
        $message = '<script>alert("' . $message . ', Gambar tidak dapat diupload"); 
    window.location ="../menu"</script>';
    } else {
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $query = mysqli_query($conn, "UPDATE tb_daftar_menu SET foto='" . $kode_rand . $_FILES['foto']['name'] . "' , nama_menu= '$nama_menu', keterangan='$keterangan', kategori='$kat_menu', harga='$harga', stok='$stok' WHERE id_menu= '$id'");
            if ($query) {
                $message = '<script>alert("Data berhasil dimasukkan"); 
        window.location ="../menu"</script>';
            } else {
                $message = '<script>alert("Data gagal dimasukkan"); 
        window.location ="../menu"</script>';
            }
        } else {
            $message = '<script>alert("Maaf, Terjadi kesalahan File tidak dapat diupload"); 
        window.location ="../menu"</script>';
        }
    }
}

echo $message;
