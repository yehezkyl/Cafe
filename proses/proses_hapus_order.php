<?php
include "konek.php";
$id = (isset($_POST['id_order'])) ? htmlentities($_POST['id_order']) : "";

if (!empty($_POST['cek_hapus_order'])) {
    $select = mysqli_query($conn, "SELECT kode_order FROM tb_list_order WHERE kode_order = '$id'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Order telah memiliki item order. Order tidak dapat dihapus !!!") 
        window.location ="../order"
        </script>';
    } else {
        $query = mysqli_query($conn, "DELETE FROM tb_order WHERE id_order='$id'");
        if ($query) {
            $message = '<script>alert("Data berhasil dihapus"); 
        window.location ="../order"
        </script>';
        } else {
            $message = '<script>alert("Data gagal dihapus")
        window.location ="../order"</script>';
        }
    }
}
echo $message;
