<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:login.php');
}
$page = "klien";
include('koneksi.php');
$sql = "SELECT * FROM transaksi";
$result = mysqli_query($conn, $sql);
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
                                    <h4 class="title">Data Klien</h4>
                                    <p class="category">Semua Data Klien</p>
                                </div>
                                <div class="content">
                                    <div class="content table-responsive table-full-width">
                                        <table id="myTable" class="table table-striped table-bordered table-hover" style="width:100%;">
                                            <thead>
                                                <th>Penyewa</th>
                                                <th>Keterangan</th>
                                                <th>Telepon</th>
                                                <th>No Surat Jalan</th>
                                                <th>Nomor Polisi</th>
                                                <th>Driver</th>
                                                <th>No. Golongan SIM</th>
                                                <th>Penjemputan</th>
                                                <th>Tanggal dibuat Surat Jalan</th>
                                                <th>Tempat dibuat Surat Jalan</th>
                                                <th>Tujuan</th>
                                                <th>Tanggal Keberangkatan</th>
                                                <th>Tanggal Kedatangan</th>
                                                <th>Faktur</th>
                                                <th>Tanda Terima</th>
                                                <th>Option</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "
                                                            <tr>
                                                                <td>$row[penyewa]</td>
                                                                <td>$row[keterangan]</td>
                                                                <td>$row[telepon]</td>
                                                                <td>$row[no_surat_jalan]</td>
                                                                <td>$row[nomor_polisi]</td>
                                                                <td>$row[driver]</td>
                                                                <td>$row[no_golongan_sim]</td>
                                                                <td>$row[penjemputan]</td>
                                                                <td>$row[tgl_dibuat_surat_jln]</td>
                                                                <td>$row[tmpt_dibuat_surat_jln]</td>
                                                                <td>$row[tujuan]</td>
                                                                <td>$row[tgl_keberangkatan]</td>
                                                                <td>$row[tgl_kedatangan]</td>
                                                                <td><a href='faktur.php?no_surat_jalan=$row[no_surat_jalan]'>Lihat Faktur</a></td>
                                                                <td><a href='tanda-terima.php?no_surat_jalan=$row[no_surat_jalan]'>Lihat Tanda Terima</a></td>
                                                                <td><a href='transaksi_update.php?no_surat_jalan=$row[no_surat_jalan]' class='btn btn-warning'>Update</a>&nbsp;<a href='process.php?process=delete-transaksi&&no_surat_jalan=$row[no_surat_jalan]' class='btn btn-danger'>Delete</a></td>
                                                            </tr>
                                                            ";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='15'>0 results</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "scrollX": true
        });
    });
</script>

</html>