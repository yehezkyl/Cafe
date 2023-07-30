<?php
include "proses/konek.php";
$query = mysqli_query($conn, "SELECT * FROM tb_daftar_menu");
while ($row = mysqli_fetch_array($query)) {
    $result[] = $row;
}
$query2 = mysqli_query($conn, "SELECT * FROM tb_order");
while ($row2 = mysqli_fetch_array($query2)) {
    $result2[] = $row2;
}
$query3 = mysqli_query($conn, "SELECT * FROM tb_user");
while ($row3 = mysqli_fetch_array($query3)) {
    $result3[] = $row3;
}
$nama_menu = "";
$total = null;
$query4 = mysqli_query($conn, "SELECT nama_menu,COUNT(*) as 'total' from tb_list_order LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id_menu = tb_list_order.menu GROUP BY menu");
while ($row4 = mysqli_fetch_array($query4)) {
    $result4[] = $row4;
    $menu = $row4['nama_menu'];
    $nama_menu .= "'$menu'" . ", ";
    $jumlah = $row4['total'];
    $total .= "$jumlah" . ", ";
}

$sum = 0;
foreach ($result4 as $item) {
    $sum += $item['total'];
}
$count = count($result);
$count2 = count($result2);
$count3 = count($result3);
$count4 = $sum;
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="col-lg-10 mt-3">
    <!-- Carouser Menu Terbaru -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php
            $slide = 0;
            $Slide1Tombol = true;
            foreach ($result as $dataTombol) {
                ($Slide1Tombol) ? $aktif = "active" : $aktif = "";
                $Slide1Tombol = false;
            ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $slide ?>" class="<?php echo $aktif ?>" aria-current="true" aria-label="Slide <?php echo $slide + 1 ?>"></button>
            <?php
                $slide++;
            }
            ?>
        </div>
        <div class="carousel-inner rounded">
            <?php
            $Slide1 = true;
            foreach ($result as $data) {
                ($Slide1) ? $aktif = "active" : $aktif = "";
                $Slide1 = false;

            ?>
                <div class="carousel-item <?php echo $aktif ?>">
                    <img src="assets/img/<?php echo $data['foto'] ?>" class="img-fluid" style="height: 300px; width: 100%; object-fit: cover" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $data['nama_menu'] ?></h5>
                        <p><?php echo $data['keterangan'] ?></p>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Akhir Carousel Menu Terbaru -->
    <div class="card mt-4 border-0 bg-light">
        <div class="card-body text-center">
            <h5 class="card-title">Aplikasi Pemesanan Makanan & Minuman</h5>
            <p class="card-text">Sebuah aplikasi yang dapat dingunakan untuk pemesanan minuman dan makanan pada cafe, restoran, rumah makan atau yang sejenisnya.</p>
            <a href="order" class="btn btn-primary">Buat Order</a>
        </div>
    </div>

    <!-- Chart Row -->
    <div class="card mt-4 border-0 bg-light">
        <div class="card-body text-center">
            <div>
                <canvas id="myChart"></canvas>
            </div>
            <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php echo $nama_menu ?>],
                        datasets: [{
                            label: 'Jumlah Porsi Terjual',
                            data: [<?php echo $total ?>],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
    <!-- Chart Row -->

    <div class="card text-center mt-3">
        <div class="card-header">
            Dashboard
        </div>
        <div class="card-body">
            <!-- Content Row -->
            <div class="row justify-content-center">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah Menu</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Jumlah Order</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count2 ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Porsi Terjual</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count4 ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        User</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count3 ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Content Row -->
        </div>
        <div class="card-footer text-body-secondary">
            <a class="btn btn-primary btn-sm me-1 text-nowrap" href="report">Lihat Report</a>
        </div>
    </div>

</div>