<?php
include "konek.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty($_POST['cek_reset_password'])) {
    $query = mysqli_query($conn, "UPDATE tb_user SET password=md5('123') WHERE id='$id'");
    if ($query) {
        $message = '<script>alert("Password berhasil direset"); 
        window.location ="../user"</script>
        </script>';
    } else {
        $message = '<script>alert("Password gagal direset")</script>';
    }
}
echo $message;
