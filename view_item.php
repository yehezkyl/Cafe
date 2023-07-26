<?php
include "proses/konek.php";
$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya FROM tb_list_order LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id_menu = tb_list_order.menu LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order GROUP BY id_list_order HAVING tb_list_order.kode_order = $_GET[order]");

$kode = $_GET['order'];
$meja = $_GET['meja'];
$pelanggan = $_GET['pelanggan'];

while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_menu = mysqli_query($conn, "SELECT id_menu,nama_menu FROM tb_daftar_menu");
?>
<div class="col-lg-10 mt-3">
    <div class="card">
        <div class="card-header" style="background-color: #E9F1F7;">
            Halaman View Item
        </div>
        <div class="card-body">
            <a class="btn btn-secondary mb-3" href="report"><i class="bi bi-arrow-left"></i> Kembali</a>
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


            <?php
            if (empty($result)) {
                echo "Data Order tidak ada";
            } else {
                foreach ($result as $row) {
            ?>


                <?php
                }
                ?>



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

        </div>
    </div>
</div>