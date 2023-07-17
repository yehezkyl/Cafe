<?php
include "konek.php";
$id = (isset($_POST['id_user'])) ? htmlentities($_POST['id_user']) : "";
$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$kontak = (isset($_POST['kontak'])) ? htmlentities($_POST['kontak']) : "";
$password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password'])) : "";

if (!empty($_POST['cek_edit_user'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Username yang dimasukkan telah ada"); 
        window.location ="../user"
        </script>';
    } else {
        $query = mysqli_query($conn, "UPDATE tb_user SET nama='$nama', username='$username', level='$level',kontak='$kontak' WHERE id_user='$id'");
        if ($query) {
            $message = '<script>alert("Data berhasil diupdate"); 
        window.location ="../user"
        </script>';
        } else {
            $message = '<script>alert("Data gagal diupdate")
            window.location ="../user"</script>';
        }
    }
}
echo $message;
