<?php
session_start();
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    echo "<script type='text/javascript'>alert('$status');</script>";
}
if (!isset($_SESSION['username'])) {
    header('Location:login.php');
}
$page = "faktur";
include('koneksi.php');
$sql = "SELECT * FROM faktur WHERE no_faktur='$_GET[no_faktur]'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result)
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
                                    <h4 class="title" id="input-transaksi">Update Faktur</h4>
                                </div>
                                <div class="content">
                                    <form method="post" action="process.php?process=update-faktur">
                                        <div class="row col-md-12">
                                            <div class="form-group">
                                                <label>No Surat Jalan</label>
                                                <input type="text" name="no_surat_jalan" class="form-control" placeholder="No Surat Jalan" required readonly <?php echo "value='$row[no_surat_jalan]'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>No Faktur</label>
                                                <input type="text" name="no_faktur" class="form-control" placeholder="No Faktur" required <?php echo "value='$row[no_surat_jalan]'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Faktur</label>
                                                <input type="date" name="tanggal_faktur" class="form-control" placeholder="Tanggal Faktur" required <?php echo "value='" . date('Y-m-d', strtotime($row['tanggal_faktur'])) . "'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi Sewa</label>
                                                <input type="text" name="deskripsi_sewa" class="form-control" placeholder="Deskripsi Sewa" required <?php echo "value='$row[deskripsi_sewa]'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Rincian Service</label>
                                                <input type="text" name="rincian_service" class="form-control" placeholder="Rincian Service" required <?php echo "value='$row[rincian_service]'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Total Biaya</label>
                                                <input type="text" name="total_biaya" class="form-control" placeholder="Total Biaya" required <?php echo "value='$row[total_biaya]'"; ?>>
                                            </div>
                                        </div>
                                        <input class="btn btn-primary" type="submit" value="Input Faktur">
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