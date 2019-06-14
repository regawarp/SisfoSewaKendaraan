<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:login.php');
}
$page = "laporan";
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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Export Laporan</h4>
                                    <p class="category"></p>
                                </div>
                                <div class="content">
                                    <form method="post" action="process.php?process=export-laporan">
                                        <div class="row col-md-12">
                                            <div class="form-group">
                                                <label>Tanggal Awal</label>
                                                <input type="date" name="tanggal_awal" class="form-control" placeholder="Tanggal Awal" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Akhir</label>
                                                <input type="date" name="tanggal_akhir" class="form-control" placeholder="Tanggal Akhir" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Jenis Laporan</label>
                                                <select name="jenis_laporan" class="form-control">
                                                    <option value="pendapatan">LAPORAN PENDAPATAN</option>
                                                    <option value="klien">LAPORAN KLIEN</option>
                                                    <option value="klien_lunas">LAPORAN KLIEN LUNAS</option>
                                                    <option value="klien_belum_lunas">LAPORAN KLIEN BELUM LUNAS</option>
                                                    <option value="kendaraan">LAPORAN KENDARAAN</option>
                                                    <option value="kat_penjemputan">LAPORAN KATEGORI PENJEMPUTAN</option>
                                                    <option value="kat_tujuan">LAPORAN KATEGORI TUJUAN</option>
                                                    <option value="kat_merek">LAPORAN KATEGORI MEREK</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input class="btn btn-primary" type="submit" value="Export">
                                    </form>
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

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "scrollX": true
        });
    });
</script>

</html>