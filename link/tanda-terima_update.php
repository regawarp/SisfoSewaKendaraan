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
$sql = "SELECT * FROM tanda_terima WHERE no_tanda_terima='$_GET[no_tanda_terima]'";
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
                                    <h4 class="title" id="input-transaksi">Update Tanda Terima</h4>
                                </div>
                                <div class="content">
                                    <form method="post" action="process.php?process=update-tanda-terima">
                                        <div class="row col-md-12">
                                            <div class="form-group">
                                                <label>No Surat Jalan</label>
                                                <input type="text" name="no_surat_jalan" class="form-control" placeholder="No Surat Jalan" required readonly <?php echo "value='$row[no_surat_jalan]'"; ?>>
                                            </div>
                                            <input type="hidden" name="no_tanda_terima_old" class="form-control" placeholder="No Faktur" required <?php echo "value='$row[no_tanda_terima]'"; ?>>
                                            <div class="form-group">
                                                <label>No Tanda Terima</label>
                                                <input type="text" name="no_tanda_terima" class="form-control" placeholder="No Tanda Terima" required <?php echo "value='$row[no_tanda_terima]'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" required <?php echo "value='" . date('Y-m-d', strtotime($row['tanggal'])) . "'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Uang sejumlah</label>
                                                <input type="text" id="uang_sejumlah" name="uang_sejumlah" class="form-control" placeholder="Uang sejumlah" required <?php echo "value='$row[uang_sejumlah]'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Untuk pembayaran</label>
                                                <input type="text" name="untuk_pembayaran" class="form-control" placeholder="Untuk pembayaran" required <?php echo "value='$row[untuk_pembayaran]'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Rincian biaya</label>
                                                <input type="text" name="rincian_biaya" class="form-control" placeholder="Rincian biaya" required <?php echo "value='$row[rincian_biaya]'"; ?>>
                                            </div>
                                        </div>
                                        <input class="btn btn-primary" type="submit" value="Update Tanda Terima">
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