<?php
session_start();
include "konek.php";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password'])) : "";

if (!empty($_POST['cek_login'])) {
    $query = mysqli_query($conn, "SELECT*FROM tb_user WHERE username = '$username' && password = '$password'");
    $hasil = mysqli_fetch_array($query);
    if ($hasil) {
        $_SESSION['username_cafe'] = $username;
        $_SESSION['level_user'] = $hasil['level'];
        header('location:../dashboard');
    } else { ?>

        <script>
            alert('Username atau password salah');
            window.location = '../login';
        </script>

<?php
    }
}
?>