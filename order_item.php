<?php
include "proses/konek.php";
$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya FROM tb_list_order LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id_menu = tb_list_order.menu LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order GROUP BY id_list_order HAVING tb_list_order.kode_order = $_GET[order]");

$kode = $_GET['order'];
$meja = $_GET['meja'];
$pelanggan = $_GET['pelanggan'];

while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
    //$kode = $record['id_order'];
    //$meja = $record['meja'];
    //$pelanggan = $record['pelanggan'];
}

$select_menu = mysqli_query($conn, "SELECT id_menu,nama_menu FROM tb_daftar_menu");
?>
<div class="col-lg-9 mt-3">
    <div class="card">
        <div class="card-header">
            Halaman Order Item
        </div>
        <div class="card-body">
            <a class="btn btn-secondary mb-3" href="order"><i class="bi bi-arrow-left"></i> Kembali</a>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="floatingInput" placeholder="Kode Order" name="kode_order" value="<?php echo $kode ?>" required>
                        <label for="floatingInput">Kode Order</label>

                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="floatingInput" placeholder="Meja" name="meja" value="<?php echo $meja ?>" required>
                        <label for="floatingInput">Meja</label>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="floatingInput" placeholder="Pelanggan" name="pelanggan" value="<?php echo $pelanggan ?>" required>
                        <label for="floatingInput">Pelanggan</label>

                    </div>
                </div>
            </div>

            <!-- Modal Tambah Item-->
            <div class="modal fade" id="ModalTambahItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Item</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_orderitem.php" method="POST">
                                <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="menu" id="">
                                                <option selected hidden value="">Pilih Menu</option>
                                                <?php
                                                foreach ($select_menu as $value) {
                                                    echo "<option value=$value[id_menu]>$value[nama_menu]</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="menu">Menu Makanan/Minuman</label>
                                            <div class="invalid-feedback">
                                                Pilih Menu
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" name="jumlah" required>
                                            <label for="floatingInput">Jumlah Porsi</label>
                                            <div class="invalid-feedback">
                                                Masukkan Jumlah Porsi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Catatan" name="catatan">
                                            <label for="floatingPassword">Catatan</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="cek_input_orderitem" value="12345">Save changes</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Akhir Modal Tambah Item-->
            <?php
            if (empty($result)) {
                echo "Data Order tidak ada";
            } else {
                foreach ($result as $row) {
            ?>

                    <!-- Modal Edit Item-->
                    <div class="modal fade" id="ModalEdit<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Order</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_edit_orderitem.php" method="POST">
                                        <input type="hidden" name="id_list" value="<?php echo $row['id_list_order'] ?>">
                                        <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                        <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" name="menu" id="">
                                                        <option selected hidden value="">Pilih Menu</option>
                                                        <?php
                                                        foreach ($select_menu as $value) {
                                                            if ($row['menu'] == $value['id_menu']) {
                                                                echo "<option selected value=$value[id_menu]>$value[nama_menu]</option>";
                                                            } else {
                                                                echo "<option value=$value[id_menu]>$value[nama_menu]</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="menu">Menu Makanan/Minuman</label>
                                                    <div class="invalid-feedback">
                                                        Pilih Menu
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" name="jumlah" value="<?php echo $row['jumlah'] ?>" required>
                                                    <label for="floatingInput">Jumlah Porsi</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Jumlah Porsi
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" placeholder="Catatan" name="catatan" value="<?php echo $row['catatan_item'] ?>">
                                                    <label for="floatingPassword">Catatan</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="cek_edit_orderitem" value="12345">Save changes</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal Edit Item-->
                    <!-- Modal Hapus Item-->
                    <div class="modal fade" id="ModalHapus<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Order</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_hapus_orderitem.php" method="POST">
                                        <input type="hidden" value="<?php echo $row['id_list_order'] ?>" name="id_list">
                                        <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                        <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                        <div class="col-lg-12">
                                            <?php
                                            echo "Apakah anda yakin ingin menghapus menu <b>$row[nama_menu]</b> ?";
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="cek_hapus_orderitem" value="12345">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal Hapus Item-->
                <?php
                }
                ?>

                <!-- Modal Bayar-->
                <div class="modal fade" id="ModalBayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th scope="col">Menu</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Catatan</th>
                                                <th scope="col">Total</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            foreach ($result as $row) {

                                            ?>
                                                <tr>
                                                    <td><?php echo $row['nama_menu'] ?></td>
                                                    <td><?php echo number_format($row['harga'], 0, ',', '.')  ?></td>
                                                    <td><?php echo $row['jumlah'] ?></td>
                                                    <td><?php echo $row['status'] ?></td>
                                                    <td><?php echo $row['catatan_item'] ?></td>
                                                    <td><?php echo number_format($row['harganya'], 0, ',', '.')  ?></td>

                                                </tr>
                                        </tbody>
                                    <?php
                                                $total += $row['harganya'];
                                            }
                                    ?>
                                    <tr>
                                        <td colspan="5" class="fw-bold">
                                            Total Harga
                                        </td>
                                        <td class="fw-bold">
                                            <?php echo number_format($total, 0, ',', '.')  ?>
                                        </td>
                                    </tr>
                                    </table>

                                </div>
                                <span class="text-danger fs-5 fw-semibold">
                                    Masukkan Jumlah Pembayaran dan Cek Jumlah Uang Sebelum Klik Bayar !
                                </span>
                                <form class="needs-validation" novalidate action="proses/proses_bayar.php" method="POST">
                                    <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                    <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                    <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                    <input type="hidden" name="total" value="<?php echo $total ?>">
                                    <div class="row">
                                        <div class="col-lg-6"></div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="Nominal Uang" name="nominal_bayar" required>
                                                <label for="floatingInput">Nominal Uang</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Nominal Uang
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="cek_bayar" value="12345">Bayar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Bayar-->

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">Menu</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Status</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Total</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($result as $row) {

                            ?>
                                <tr>
                                    <td><?php echo $row['nama_menu'] ?></td>
                                    <td><?php echo number_format($row['harga'], 0, ',', '.')  ?></td>
                                    <td><?php echo $row['jumlah'] ?></td>
                                    <td>
                                        <?php
                                        if ($row['status'] == 1) {
                                            echo "<span class='badge text-bg-warning'>Diterima</span>";
                                        } elseif ($row['status'] == 2) {
                                            echo "<span class='badge text-bg-primary'>Siap Saji</span>";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['catatan_item'] ?></td>
                                    <td><?php echo number_format($row['harganya'], 0, ',', '.')  ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled btn-sm me-1" : "btn btn-warning btn-sm me-1" ?>" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_list_order'] ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled btn-sm me-1" : "btn btn-danger btn-sm me-1" ?>" data-bs-toggle="modal" data-bs-target="#ModalHapus<?php echo $row['id_list_order'] ?>"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                        </tbody>
                    <?php
                                $total += $row['harganya'];
                            }
                    ?>
                    <tr>
                        <td colspan="5" class="fw-bold">
                            Total Harga
                        </td>
                        <td colspan="2" class="fw-bold">
                            <?php echo number_format($total, 0, ',', '.')  ?>
                        </td>
                    </tr>
                    </table>

                </div>
            <?php
            }
            ?>
            <div class="d-flex">
                <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled me-1" : "btn btn-success me-1" ?>" data-bs-toggle="modal" data-bs-target="#ModalTambahItem"><i class="bi bi-plus-circle-fill"></i> Item</button>
                <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-primary" ?>" data-bs-toggle="modal" data-bs-target="#ModalBayar"><i class="bi bi-cash-coin"></i> Bayar</button>
            </div>
        </div>
    </div>
</div>