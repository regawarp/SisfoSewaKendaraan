<?php
session_start();
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    echo "<script type='text/javascript'>alert('$status');</script>";
}
if (!isset($_SESSION['username'])) {
    header('Location:login.php');
}
$page = "tanda-terima";
include('koneksi.php');
if (isset($_GET['no_surat_jalan'])) {
    $sql = "SELECT * FROM tanda_terima WHERE no_surat_jalan='$_GET[no_surat_jalan]'";
} else {
    $sql = "SELECT * FROM tanda_terima";
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
                                    <h4 class="title">Data Tanda Terima</h4>
                                    <?php
                                    if (isset($_GET['no_surat_jalan'])) {
                                        echo " <p class='category'>No Surat Jalan : $_GET[no_surat_jalan]</p>";
                                    } else {
                                        echo " <p class='category'>Semua Tanda Terima</p>";
                                    }
                                    ?>
                                </div>
                                <div class="content">
                                    <div class="content table-responsive table-full-width">
                                        <table id="myTable" class="table table-striped table-bordered table-hover" style="width:100%;">
                                            <thead>
                                                <th>No Surat Jalan</th>
                                                <th>No Tanda Terima</th>
                                                <th>Export & Print</th>
                                                <th>Tanggal</th>
                                                <th>Terbilang</th>
                                                <th>Uang Sejumlah</th>
                                                <th>Untuk Pembayaran</th>
                                                <th>Sisa Pembayaran</th>
                                                <th>Rincian Biaya</th>
                                                <th>Option</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "
                                                    <tr>
                                                        <td>$row[no_surat_jalan]</td>
                                                        <td>$row[no_tanda_terima]</td>
                                                        <td><a href='tanda-terima_export.php?no_tanda_terima=$row[no_tanda_terima]' class='btn btn-warning'>Export & Print</a></td>
                                                        <td>$row[tanggal]</td>
                                                        <td>$row[terbilang]</td>
                                                        <td>$row[uang_sejumlah]</td>
                                                        <td>$row[untuk_pembayaran]</td>
                                                        <td>$row[sisa_pembayaran]</td>
                                                        <td>$row[rincian_biaya]</td>
                                                        <td><a href='tanda-terima_update.php?no_tanda_terima=$row[no_tanda_terima]' class='btn btn-warning'>Update</a>&nbsp;<a href='process.php?process=delete-tanda-terima&&no_tanda_terima=$row[no_tanda_terima]&&no_surat_jalan=$row[no_surat_jalan]' class='btn btn-danger'>Delete</a></td>
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
                                    <h4 class="title" id="input-transaksi">Buat Tanda Terima</h4>
                                </div>
                                <div class="content">
                                    <form method="post" action="process.php?process=insert-tanda-terima">
                                        <div class="row col-md-12">
                                            <?php if (!isset($_GET['no_surat_jalan'])) { ?>
                                                <div class="form-group">
                                                    <label>No Surat Jalan</label>
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
                                                <label>No Tanda Terima</label>
                                                <input type="text" name="no_tanda_terima" class="form-control" placeholder="No Tanda Terima" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" required>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label>Nomor Polisi</label>
                                                <input type="text" name="Nomor Polisi" class="form-control" placeholder="Nomor Polisi" >
                                            </div>
                                            <div class="form-group">
                                                <label>Merek/type</label>
                                                <input type="text" name="Merek/type" class="form-control" placeholder="Merek/type" >
                                            </div>
                                            <div class="form-group">
                                                <label>Telah diterima dari (penyewa)</label>
                                                <input type="text" name="penyewa" class="form-control" placeholder="Telah diterima dari (penyewa)" >
                                            </div> -->
                                            <div class="form-group">
                                                <label>Uang sejumlah</label>
                                                <input type="text" id="uang_sejumlah" name="uang_sejumlah" class="form-control" placeholder="Uang sejumlah" required>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label>Terbilang</label>
                                                <input type="text" name="terbilang" class="form-control" placeholder="Terbilang" required>
                                            </div> -->
                                            <div class="form-group">
                                                <label>Untuk pembayaran</label>
                                                <input type="text" name="untuk_pembayaran" class="form-control" placeholder="Untuk pembayaran" required>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label>Sisa Pembayaran</label>
                                                <input type="text" name="sisa_pembayaran" class="form-control" placeholder="Sisa Pembayaran" required>
                                            </div> -->
                                            <div class="form-group">
                                                <label>Rincian biaya</label>
                                                <input type="text" name="rincian_biaya" class="form-control" placeholder="Rincian biaya" required>
                                            </div>
                                        </div>
                                        <input class="btn btn-primary" type="submit" value="Buat Tanda Terima">
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