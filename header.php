<?php
include "proses/konek.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username= '$_SESSION[username_cafe]'");
$record = mysqli_fetch_array($query);

?>
<nav class="navbar navbar-expand sticky-top navbar-dark" style="background-color: #2274A5;">
    <div class="container-lg">
        <a class="navbar-brand" href="/"><i class="bi bi-egg-fried"></i> Cafe</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $hasil['username']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahProfile"><i class="bi bi-person-fill"></i> Profil</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahPassword"><i class="bi bi-key"></i> Ubah Password</a></li>
                        <li><a class="dropdown-item" href="logout"><i class="bi bi-box-arrow-right"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Edit Password-->
<div class="modal fade" id="ModalUbahPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_ubah_password.php" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" value="<?php echo $_SESSION['username_cafe'] ?>" required>
                                <label for=" floatingInput">Username</label>
                                <div class="invalid-feedback">
                                    Masukkan Username
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="passwordlama" required>
                                <label for=" floatingPassword">Password Lama</label>
                                <div class="invalid-feedback">
                                    Masukkan Password Lama
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="passwordbaru" required>
                                <label for=" floatingPassword">Password Baru</label>
                                <div class="invalid-feedback">
                                    Masukkan Password Baru
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="repasswordbaru" required>
                                <label for=" floatingPassword">Ulangi Password Baru</label>
                                <div class="invalid-feedback">
                                    Masukkan Ulangi Password Baru
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="cek_ubah_password" value="12345">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Akhir Modal Edit Password-->

<!-- Modal Edit Profile-->
<div class="modal fade" id="ModalUbahProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_ubah_profile.php" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" value="<?php echo $_SESSION['username_cafe'] ?>" required>
                                <label for=" floatingInput">Username</label>
                                <div class="invalid-feedback">
                                    Masukkan Username
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingNama" name="nama" value="<?php echo $record['nama'] ?>" required>
                                <label for=" floatingPassword">Nama</label>
                                <div class="invalid-feedback">
                                    Masukkan Nama Anda
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingKontak" name="kontak" value="<?php echo $record['kontak'] ?>" required>
                                <label for=" floatingPassword">Kontak</label>
                                <div class="invalid-feedback">
                                    Masukkan Kontak Anda
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="cek_ubah_profile" value="12345">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Akhir Modal Edit Profile-->