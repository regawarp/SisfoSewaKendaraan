<?php
session_start();
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    echo "<script type='text/javascript'>alert('$status');</script>";
}
if (!isset($_SESSION['username'])) {
    header('Location:login.php');
}
$page = "transaksi";
include('koneksi.php');
$sql = "SELECT * FROM transaksi WHERE no_surat_jalan='$_GET[no_surat_jalan]'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
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
                                    <h4 class="title" id="input-transaksi">Update Transaksi</h4>
                                </div>
                                <div class="content">
                                    <form method="post" action="process.php?process=update-transaksi">
                                        <div class="row col-md-12">
                                            <div class="form-group">
                                                <label>No Surat Jalan</label>
                                                <input type="text" name="no_surat_jalan" class="form-control" placeholder="No Surat Jalan" required <?php echo "value='$row[no_surat_jalan]'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor Polisi</label>
                                                <input type="text" name="nomor_polisi" class="form-control" placeholder="Nomor Polisi" readonly <?php echo "value='$row[nomor_polisi]'"; ?>>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Driver</label>
                                                <input type="text" name="driver" class="form-control" placeholder="Driver" <?php echo "value='$row[driver]'"; ?>>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>No/Golongan SIM</label>
                                                <input type="text" name="no_golongan_sim" class="form-control" placeholder="No/Golongan SIM" <?php echo "value='$row[no_golongan_sim]'"; ?>>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Penjemputan</label>
                                                <input type="text" name="penjemputan" class="form-control" placeholder="Penjemputan" <?php echo "value='$row[penjemputan]'"; ?>>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Tanggal dibuat Surat Jalan</label>
                                                <input type="date" name="tgl_dibuat_surat_jln" class="form-control" placeholder="Tanggal dibuat Surat Jalan" <?php echo "value='$row[tgl_dibuat_surat_jln]'"; ?>>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Tempat dibuat Surat Jalan</label>
                                                <input type="text" name="tmpt_dibuat_surat_jln" class="form-control" placeholder="Tempat dibuat Surat Jalan" <?php echo "value='$row[tmpt_dibuat_surat_jln]'"; ?>>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Penyewa</label>
                                                <input type="text" name="penyewa" class="form-control" placeholder="Penyewa" <?php echo "value='$row[penyewa]'"; ?>>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Telepon</label>
                                                <input type="text" name="telepon" class="form-control" placeholder="Telepon" <?php echo "value='$row[telepon]'"; ?>>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Tujuan</label>
                                                <input type="text" name="tujuan" class="form-control" placeholder="Tujuan" <?php echo "value='$row[tujuan]'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Keberangkatan</label>
                                                <input type="date" name="tgl_keberangkatan" class="form-control" placeholder="Tanggal Keberangkatan" readonly <?php echo "value='".date('Y-m-d',strtotime($row['tgl_keberangkatan']))."'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Kedatangan</label>
                                                <input type="date" name="tgl_kedatangan" class="form-control" placeholder="Tanggal Kedatangan" readonly <?php echo "value='".date('Y-m-d',strtotime($row['tgl_kedatangan']))."'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" value="Belum Lunas" readonly>
                                            </div>
                                        </div>
                                        <input class="btn btn-primary" type="submit" value="Update Data">
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