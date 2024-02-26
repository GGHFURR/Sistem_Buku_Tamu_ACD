<!-- panggil file header -->
<?php include "header.php"; ?>

<?php

// Uji Jika tombol simpan di klik
if (isset($_POST['bsimpan'])) {
    $tgl = date('Y-m-d');
    $waktu = date('H:i:s');

    // htmlspecialchars agar inputan lebih aman dari injection
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $perusahaan = htmlspecialchars($_POST['perusahaan'], ENT_QUOTES);
    $tujuan = htmlspecialchars($_POST['tujuan'], ENT_QUOTES);
    $nope = htmlspecialchars($_POST['nope'], ENT_QUOTES);
    $bertemu = htmlspecialchars($_POST['bertemu'], ENT_QUOTES);
    if (isset($_POST['jenis_kelamin'])) {
        $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin'], ENT_QUOTES);
    }
    //persiapan query simpan data 
    $simpan = mysqli_query($koneksi, "INSERT INTO ttamu VALUES ('','$tgl','$waktu', '$nama','$jenis_kelamin', '$perusahaan', '$tujuan','$bertemu', '$nope')");

    // Uji jika simpan data sukses
    if ($simpan) {
        echo "<script>alert('Simpan Data Sukses, Terima Kasih!');
        document.location='?'</script>";
    } else {
        echo "<script>alert('Simpan Data Gagal!');
        document.location='?'</script>";
    }
}


// Fetch monthly data
$monthlyData = mysqli_query($koneksi, "SELECT COUNT(*) as total, DATE_FORMAT(tanggal, '%Y-%m') as month_year FROM ttamu GROUP BY month_year");
$labels = $datach = [];

// Add the following lines to check the data
while ($row = mysqli_fetch_assoc($monthlyData)) {
    // Rest of your code
    $monthYear = explode('-', $row['month_year']);
    $monthName = getMonthNameIndonesian($monthYear[1]);
    $labels[] = $monthName . ' ' . $monthYear[0];
    $datach[] = $row['total'];
}


// Function to get month names in Indonesian
function getMonthNameIndonesian($monthNumber)
{
    $monthNames = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];

    return $monthNames[$monthNumber];
}


?>



<!-- Head -->
<div style="text-align: center;">
    <img src="assets/img/logo.png" alt="image" style="height: 150px; width: 150px;">
</div>

<div class="head text-center">
    <h2 class="text-black">Sistem Informasi Buku Tamu <br> Airport Construction Division - PT Angkasa Pura II</h2>
</div>
<!-- end Head -->

<!-- Awal Row -->
<div class="row mt-5 mb-5">
    <!-- col-lg-7 -->
    <div class="col-lg-7 mb-3">
        <div class="card shadow bg-gradient-light">
            <!-- card body -->
            <div class="card-body">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
                </div>
                <form class="user" method="POST" action="">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama Pengunjung" required>
                    </div>
                    <div class="form-group mx-1">
                        <label>Pilih Jenis Kelamin:</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="laki-laki" name="jenis_kelamin" class="custom-control-input" value="Laki-laki" checked>
                            <label class="custom-control-label" for="laki-laki">Laki-laki</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="perempuan" name="jenis_kelamin" class="custom-control-input" value="Perempuan">
                            <label class="custom-control-label" for="perempuan">Perempuan</label>
                        </div>
                    </div>


                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="perusahaan" placeholder="Nama Perusahaan" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="bertemu" placeholder="Bertemu dengan" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="tujuan" placeholder="Tujuan Pengunjung" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="nope" placeholder="Nomor HP Pengunjung" required>
                    </div>

                    <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">Simpan Data</button>

                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="#">Airport Construction Division PT Angkasa Pura II | 2024</a>
                </div>
            </div>
        </div>
        <!-- end card-body -->
    </div>
    <div class="col-lg-5 mb-3">
        <!-- card -->
        <div class="card shadow">
            <!-- card body -->
            <div class="card-body">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Statistik Pengunjung</h1>
                    <canvas id="monthlyChart"></canvas>

                </div>
                <?php
                // deklarasi tanggal

                // menampilkan tanggal sekarang
                $tgl_sekarang = date('Y-m-d');

                // menampilkan tgl kemarin
                $kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));

                // mendapatkan 6 hari sebelum tgl skrg
                $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tgl_sekarang)));

                $sekarang = date('Y-m-d h:i:s');

                // persiapan query tampilkan jumlah data pengunjung

                $tgl_sekarang = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu where tanggal like '%$tgl_sekarang%'"
                ));

                $kemarin = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu where tanggal like '%$kemarin%'"
                ));

                $seminggu = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu where tanggal BETWEEN '$seminggu' and '$sekarang'"
                ));

                $bulan_ini = date('m');

                $sebulan = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu where month(tanggal) = '$bulan_ini'"
                ));

                $keseluruhan = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu"
                ));

                ?>
                <table class="table table-bordered">
                    <tr>
                        <td>Hari Ini</td>
                        <td>: <?= $tgl_sekarang[0] ?></td>
                    </tr>
                    <tr>
                        <td>Kemarin</td>
                        <td>: <?= $kemarin[0] ?></td>
                    </tr>
                    <tr>
                        <td>Minggu ini</td>
                        <td>: <?= $seminggu[0] ?></td>
                    </tr>
                    <tr>
                        <td>Bulan Ini</td>
                        <td>: <?= $sebulan[0] ?></td>
                    </tr>
                    <tr>
                        <td>Keseluruhan</td>
                        <td>: <?= $keseluruhan[0] ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- card body -->
    </div>
</div>
<!-- end col-lg-7 -->

<!-- col-lg-5 -->

<!-- end card -->
</div>
<!-- end col-lg-5 -->

</div>
<!-- end row -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung Hari Ini [<?= date('d-m-Y') ?>]</h6>
    </div>
    <div class="card-body">
        <div class="row justify-content-evenly">
            <div class="col-6">
                <div class="row">
                    <a href="rekapitulasi.php" class="btn btn-success mb-3 mx-2"><i class="fa fa-table"></i> Rekapitulasi Pengunjung</a>
                    <a href="logout.php" class="btn btn-danger mb-3 mx-2"><i class="fa fa-sign-out-alt"></i> logout</a>
                </div>
            </div>
            <form action="post" class="col-6">
                <div class="form-group">
                    <input type="text" name="search" class="form-control form-control-user" id="search" placeholder="search">
                </div>
            </form>
        </div>


        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Nama Pengunjung</th>
                        <th>Jenis Kelamin</th>
                        <th>Nama Perusahaan</th>
                        <th>Bertemu Dengan</th>
                        <th>Tujuan</th>
                        <th>No. Hp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu order by id desc");
                    $no = 1;
                    while ($data = mysqli_fetch_array($tampil)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['tanggal'] ?></td>
                            <td><?= $data['Jam'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['jenis_kelamin'] ?></td>
                            <td><?= $data['perusahaan'] ?></td>
                            <td><?= $data['bertemu'] ?></td>
                            <td><?= $data['tujuan'] ?></td>
                            <td><?= $data['nope'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- panggil file footer -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Get the data from PHP
    var labels = <?php echo json_encode($labels); ?>;
    var datach = <?php echo json_encode($datach); ?>;


    // Set up the bar chart
    var ctx = document.getElementById('monthlyChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Monthly Visitors',
                data: datach,
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1 // Set the step size to 1 for increments of 1
                }
            }
        }
    });
</script>



<?php include "footer.php"; ?>