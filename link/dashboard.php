<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:login.php');
}
$page = "dashboard";
?>
<!doctype html>
<html lang="en">

<?php include("head.php"); ?>

<body>

    <div class="wrapper">
        <?php include('sidebar.php'); ?>

        <div class="main-panel">
            <?php include('navbar.php') ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php include("koneksi.php"); ?>
                        <div class="col-md-2">
                            <div class="card">
                                <?php
                                $query = "SELECT COUNT(nomor_polisi) as jmlKendaraan FROM kendaraan";
                                $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
                                ?>
                                <div class="content d-flex align-items-center">
                                    <span class="dash-count"><?php echo $row['jmlKendaraan']; ?></span>
                                    <div class="footer">
                                        <span>Kendaraan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <?php
                                $query = "SELECT COUNT(DISTINCT penyewa,telepon) as jmlPenyewa FROM transaksi";
                                $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
                                ?>
                                <div class="content">
                                    <span class="dash-count"><?php echo $row['jmlPenyewa']; ?></span>
                                    <div class="footer">
                                        <span>Klien</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <div class="content">
                                    <?php
                                    $query = "SELECT COUNT(no_surat_jalan) as jmlPeminjaman FROM transaksi";
                                    $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
                                    ?>
                                    <span class="dash-count"><?php echo $row['jmlPeminjaman']; ?></span>
                                    <div class="footer">
                                        <span>Peminjaman</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <?php
                                $query = "SELECT COUNT(no_surat_jalan) as jmlLunas FROM transaksi WHERE keterangan='Lunas'";
                                $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
                                ?>
                                <div class="content">
                                    <span class="dash-count"><?php echo $row['jmlLunas']; ?></span>
                                    <div class="footer">
                                        <span>Lunas</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <?php
                                $query = "SELECT COUNT(no_surat_jalan) as jmlBlmLunas FROM transaksi WHERE keterangan='Belum Lunas'";
                                $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
                                ?>
                                <div class="content">
                                    <span class="dash-count"><?php echo $row['jmlBlmLunas']; ?></span>
                                    <div class="footer">
                                        <span>Belum Lunas</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">

                                <?php
                                $query = "SELECT SUM(uang_sejumlah) as totalPendapatan FROM tanda_terima";
                                $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
                                ?>
                                <div class="content">
                                    <span class="dash-count">Rp <?php echo $row['totalPendapatan']; ?></span>
                                    <div class="footer">
                                        <span>Total Pendapatan</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Grafik Pencapaian Total Pendapatan</h4>
                                    <p class="category">Tahun <?php echo date('Y'); ?></p>
                                </div>
                                <div class="content">
                                    <div id="chartHours" class="ct-chart"></div>
                                    <div class="footer">
                                        <div class="legend">
                                            <i class="fa fa-circle text-info"></i> Total Pendapatan (Juta)
                                        </div>
                                        <hr>
                                        <div class="stats">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('footer.php'); ?>


        </div>
    </div>


</body>

<?php include('js.php'); ?>

<?php
$thisYear = date('Y');
$jan = 0;
$feb = 0;
$mar = 0;
$apr = 0;
$mei = 0;
$jun = 0;
$jul = 0;
$agu = 0;
$sep = 0;
$okt = 0;
$nov = 0;
$des = 0;
$highest = (float) 1;
$query = "SELECT extract(month FROM tanda_terima.tanggal) AS bulan,SUM(uang_sejumlah) AS total FROM tanda_terima
WHERE extract(year FROM tanda_terima.tanggal)='$thisYear'
GROUP BY extract(year FROM tanda_terima.tanggal), extract(month FROM tanda_terima.tanggal)
ORDER BY bulan ASC";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $total = (float) ($row['total'] / 1000000);
    if ($total > $highest) {
        $highest = $total;
    }
    switch ($row['bulan']) {
        case '1':
            $jan = $total;
            break;
        case '2':
            $feb = $total;
            break;
        case '3':
            $mar = $total;
            break;
        case '4':
            $apr = $total;
            break;
        case '5':
            $mei = $total;
            break;
        case '6':
            $jun = $total;
            break;
        case '7':
            $jul = $total;
            break;
        case '8':
            $agu = $total;
            break;
        case '9':
            $sep = $total;
            break;
        case '10':
            $okt = $total;
            break;
        case '11':
            $nov = $total;
            break;
        case '12':
            $des = $total;
            break;
    }
}
?>
<script type="text/javascript">
    var dataSales = {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        series: [
            [<?php echo $jan . ',' . $feb . ',' . $mar . ',' . $apr . ',' . $mei . ',' . $jun . ',' . $jul . ',' . $agu . ',' . $sep . ',' . $okt . ',' . $nov . ',' . $des; ?>]
        ]
    };

    var optionsSales = {
        lineSmooth: false,
        low: 0,
        high: <?php echo ($highest + 1); ?>,
        showArea: true,
        height: "245px",
        axisX: {
            showGrid: true,
        },
        lineSmooth: Chartist.Interpolation.simple({
            divisor: 3
        }),
        showLine: false,
        showPoint: true,
    };

    var responsiveSales = [
        ['screen and (max-width: 640px)', {
            axisX: {
                labelInterpolationFnc: function(value) {
                    return value[0];
                }
            }
        }]
    ];

    Chartist.Line('#chartHours', dataSales, optionsSales, responsiveSales);
</script>

</html>