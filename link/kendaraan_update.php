<?php
session_start();
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    echo "<script type='text/javascript'>alert('$status');</script>";
}
if (!isset($_SESSION['username'])) {
    header('Location:login.php');
}
$page = "kendaraan";
include('koneksi.php');
$sql = "SELECT * FROM kendaraan WHERE nomor_polisi='$_GET[nomor_polisi]'";
$result = mysqli_query($conn, $sql);
if ($row = mysqli_fetch_assoc($result)) { } else {
    header('Location:kendaraan.php');
}
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
                                    <h4 class="title">Update Kendaraan</h4>
                                </div>
                                <div class="content">
                                    <form method="post" action="process.php?process=update-kendaraan">
                                        <input type="hidden" name="old_nomor_polisi" <?php echo "value='$row[nomor_polisi]'"; ?>>
                                        <div class="form-group">
                                            <label>Nomor Polisi</label>
                                            <input type="text" name="nomor_polisi" class="form-control" placeholder="Username" <?php echo "value='$row[nomor_polisi]'"; ?>>
                                        </div>
                                        <div class="form-group">
                                            <label>Merk / Type</label>
                                            <input type="text" name="merk_type" class="form-control" placeholder="Merk / Type" <?php echo "value='$row[merk_type]'"; ?>>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Sewa</label>
                                            <input type="text" name="harga_sewa" class="form-control" placeholder="Harga Sewa" <?php echo "value='$row[harga_sewa]'"; ?>>
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Keluaran</label>
                                            <input type="text" name="tahun_keluaran" class="form-control" placeholder="Tahun Keluaran" <?php echo "value='$row[tahun_keluaran]'"; ?>>
                                        </div>
                                        <input class="btn btn-primary" type="submit" value="Update Data">&nbsp;
                                        <a class="btn btn-default" href="kendaraan.php">Back</a>
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
        $('#myTable').DataTable();
    });
</script>

</html>