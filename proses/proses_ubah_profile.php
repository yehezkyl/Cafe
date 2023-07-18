<?php
session_start();
include "konek.php";
$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$kontak = (isset($_POST['kontak'])) ? htmlentities($_POST['kontak']) : "";

if (!empty($_POST['cek_ubah_profile'])) {
    $query = mysqli_query($conn, "UPDATE tb_user SET nama='$nama', kontak='$kontak' WHERE username = '$_SESSION[username_cafe]'");
    if ($query) {
        $message = '<script>alert("Profile berhasil diupdate"); 
                window.history.back()</script>
                </script>';
    } else {
        $message = '<script>alert("Profile gagal diupdate"); 
                window.history.back()</script>
                </script>';
    }
}
echo $message;
