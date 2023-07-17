<?php
include "konek.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty($_POST['cek_hapus_user'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_user WHERE id_user='$id'");
    if ($query) {
        $message = '<script>alert("Data berhasil dihapus"); 
        window.location ="../user"
        </script>';
    } else {
        $message = '<script>alert("Data gagal dihapus")
        window.location ="../user"</script>';
    }
}
echo $message;
