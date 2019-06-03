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
if (isset($_GET['no_surat_jalan'])) {
    $sql = "SELECT * FROM faktur WHERE no_surat_jalan='$_GET[no_surat_jalan]'";
} else {
    $sql = "SELECT * FROM faktur";
}
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
                                    <h4 class="title">Data Faktur</h4>
                                    <?php
                                    if (isset($_GET['no_surat_jalan'])) {
                                        echo " <p class='category'>No Surat Jalan : $_GET[no_surat_jalan]</p>";
                                    } else {
                                        echo " <p class='category'>Semua Faktur</p>";
                                    }
                                    ?>
                                </div>
                                <div class="content">
                                    <div class="content table-responsive table-full-width">
                                        <table id="myTable" class="table table-striped table-bordered table-hover" style="width:100%;">
                                            <thead>
                                                <th>No Surat Jalan</th>
                                                <th>No Faktur</th>
                                                <th>Tanggal Faktur</th>
                                                <th>Deskripsi Sewa</th>
                                                <th>Rincian Service</th>
                                                <th>Total Biaya</th>
                                                <th>Option</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "
                                                    <tr>
                                                        <td>$row[no_surat_jalan]</td>
                                                        <td>$row[no_faktur]</td>
                                                        <td>$row[tanggal_faktur]</td>
                                                        <td>$row[deskripsi_sewa]</td>
                                                        <td>$row[rincian_service]</td>
                                                        <td>$row[total_biaya]</td>
                                                        <td><a href='faktur_update.php?no_faktur=$row[no_faktur]' class='btn btn-warning'>Update</a>&nbsp;<a href='process.php?process=delete-faktur&&no_faktur=$row[no_faktur]&&no_surat_jalan=$row[no_surat_jalan]' class='btn btn-danger'>Delete</a></td>
                                                    </tr>
                                                    ";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='6'>0 results</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title" id="input-transaksi">Input Faktur</h4>
                                </div>
                                <div class="content">
                                    <form method="post" action="process.php?process=insert-faktur">
                                        <div class="row col-md-12">
                                            <?php if (!isset($_GET['no_surat_jalan'])) { ?>
                                                <div class="form-group">
                                                    <label>Tes</label>
                                                    <select class="form-control" name="no_surat_jalan" required>
                                                        <?php
                                                        include('koneksi.php');
                                                        $sql = "SELECT * FROM transaksi";
                                                        $result = mysqli_query($conn, $sql);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<option value='$row[no_surat_jalan]'>$row[no_surat_jalan]</option>";
                                                            }
                                                        } else {
                                                            echo "Tidak ada transaksi tersedia";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            <?php } else { ?>
                                                <div class="form-group">
                                                    <label>No Surat Jalan</label>
                                                    <input type="text" name="no_surat_jalan" class="form-control" placeholder="No Surat Jalan" required readonly <?php echo "value='$_GET[no_surat_jalan]'"; ?>>
                                                </div>
                                            <?php } ?>
                                            <div class="form-group">
                                                <label>No Faktur</label>
                                                <input type="text" name="no_faktur" class="form-control" placeholder="No Faktur" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Faktur</label>
                                                <input type="date" name="tanggal_faktur" class="form-control" placeholder="Tanggal Faktur" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi Sewa</label>
                                                <input type="text" name="deskripsi_sewa" class="form-control" placeholder="Deskripsi Sewa" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Rincian Service</label>
                                                <input type="text" name="rincian_service" class="form-control" placeholder="Rincian Service" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Total Biaya</label>
                                                <input type="text" name="total_biaya" class="form-control" placeholder="Total Biaya" required>
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