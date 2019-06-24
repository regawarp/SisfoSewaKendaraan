<?php
session_start();
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    echo "<script type='text/javascript'>alert('$status');</script>";
}
if (!isset($_SESSION['username'])) {
    header('Location:login.php');
}
$page = "booked";
include('koneksi.php');
$sql = "SELECT * FROM booked";
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
                                    <h4 class="title">Data Booking</h4>
                                    <p class="category">Semua Data Booking</p>
                                </div>
                                <div class="content">
                                    <div class="content table-responsive table-full-width">
                                        <table id="myTable" class="table table-striped table-bordered table-hover" style="width:100%;">
                                        <thead>
                                                <th>Nomor Polisi</th>
                                                <th>Tanggal Keberangkatan</th>
                                                <th>Tanggal Kedatangan</th>
                                                <th>Option</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "
                                                    <tr>
                                                        <td>$row[nomor_polisi]</td>
                                                        <td>$row[tgl_keberangkatan]</td>
                                                        <td>$row[tgl_kedatangan]</td>
                                                        <td><a href='transaksi.php?nomor_polisi=$row[nomor_polisi]&&tgl_keberangkatan=".DateTime::createFromFormat("Y-m-d H:i:s", $row['tgl_keberangkatan'])->format("Y-m-d")."&&tgl_kedatangan=".DateTime::createFromFormat("Y-m-d H:i:s", $row['tgl_kedatangan'])->format("Y-m-d")."#input-transaksi' class='btn btn-success'>Buat Surat Jalan</a>&nbsp;<a href='process.php?process=delete-booked&&id_book=$row[id_book]' class='btn btn-danger'>Delete</a></td>
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
                                <div class="header" id="cari-kendaraan">
                                    <h4 class="title">Cari Kendaraan Tersedia</h4>
                                </div>
                                <div class="content">
                                    <form method="post" action="booked.php#cari-kendaraan">
                                        <input type="hidden" name="cari" value="yes">
                                        <div class="form-group col-lg-12">
                                            <label>Merk/Type</label>
                                            <input type="text" name="merk_type" class="form-control" placeholder="Merk/Type">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Tanggal Keberangkat</label>
                                            <input type="date" name="tgl_keberangkatan" class="form-control" required placeholder="Tanggal Keberangkatan">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Tanggal Kedatangan</label>
                                            <input type="date" name="tgl_kedatangan" class="form-control" required placeholder="Tanggal Kedatangan">
                                        </div>
                                        <input class="btn btn-primary col-md-12" type="submit" value="Cari">
                                    </form>
                                    <div class="content table-responsive table-full-width">
                                        <table id="myTable" class="table table-bordered table-hover" style="width:100%;">
                                            <thead>
                                                <th>Nomor Polisi</th>
                                                <th>Merk/Type</th>
                                                <th>Harga Sewa</th>
                                                <th>Tahun Keluaran</th>
                                                <th>Option</th>
                                            </thead>
                                            <?php
                                            if (isset($_POST['cari'])) {
                                                $tgl_keberangkatan = date('Y-m-d', strtotime($_POST['tgl_keberangkatan']));
                                                $tgl_kedatangan = date('Y-m-d', strtotime($_POST['tgl_kedatangan']));
                                                $merk_type = $_POST['merk_type'];
                                                echo "<span>Tanggal: $tgl_keberangkatan - $tgl_kedatangan</span>";
                                                ?>
                                                <tbody>
                                                    <?php
                                                    $sql;
                                                    if ($merk_type != "") {
                                                        $sql = "SELECT book.nomor_polisi,book.merk_type,book.harga_sewa,book.tahun_keluaran FROM
                                                        (SELECT kendaraan.nomor_polisi,kendaraan.merk_type,kendaraan.harga_sewa,kendaraan.tahun_keluaran FROM transaksi RIGHT JOIN kendaraan ON(transaksi.nomor_polisi=kendaraan.nomor_polisi) WHERE merk_type='$merk_type' AND (('$tgl_keberangkatan' != tgl_keberangkatan AND '$tgl_keberangkatan' != tgl_kedatangan AND ('$tgl_keberangkatan' NOT BETWEEN tgl_keberangkatan AND tgl_kedatangan) AND '$tgl_kedatangan' != tgl_keberangkatan AND '$tgl_kedatangan' != tgl_kedatangan AND ('$tgl_kedatangan' NOT BETWEEN tgl_keberangkatan AND tgl_kedatangan) AND tgl_kedatangan NOT BETWEEN '$tgl_keberangkatan' AND '$tgl_kedatangan') OR tgl_keberangkatan IS NULL) GROUP BY kendaraan.nomor_polisi) as book
                                                        INNER JOIN
                                                        (SELECT kendaraan.nomor_polisi,kendaraan.merk_type,kendaraan.harga_sewa,kendaraan.tahun_keluaran FROM `booked` RIGHT JOIN kendaraan ON (booked.nomor_polisi=kendaraan.nomor_polisi) WHERE merk_type='$merk_type' AND (('$tgl_keberangkatan' != tgl_keberangkatan AND '$tgl_keberangkatan' != tgl_kedatangan AND ('$tgl_keberangkatan' NOT BETWEEN tgl_keberangkatan AND tgl_kedatangan) AND '$tgl_kedatangan' != tgl_keberangkatan AND '$tgl_kedatangan' != tgl_kedatangan AND ('$tgl_kedatangan' NOT BETWEEN tgl_keberangkatan AND tgl_kedatangan) AND tgl_kedatangan NOT BETWEEN '$tgl_keberangkatan' AND '$tgl_kedatangan') OR tgl_keberangkatan IS NULL) GROUP BY kendaraan.nomor_polisi) as trans
                                                        ON (book.nomor_polisi=trans.nomor_polisi)";
                                                    } else {
                                                        $sql = "SELECT book.nomor_polisi,book.merk_type,book.harga_sewa,book.tahun_keluaran FROM
                                                        (SELECT kendaraan.nomor_polisi,kendaraan.merk_type,kendaraan.harga_sewa,kendaraan.tahun_keluaran FROM transaksi RIGHT JOIN kendaraan ON(transaksi.nomor_polisi=kendaraan.nomor_polisi) WHERE ('$tgl_keberangkatan' != tgl_keberangkatan AND '$tgl_keberangkatan' != tgl_kedatangan AND ('$tgl_keberangkatan' NOT BETWEEN tgl_keberangkatan AND tgl_kedatangan) AND '$tgl_kedatangan' != tgl_keberangkatan AND '$tgl_kedatangan' != tgl_kedatangan AND ('$tgl_kedatangan' NOT BETWEEN tgl_keberangkatan AND tgl_kedatangan) AND tgl_kedatangan NOT BETWEEN '$tgl_keberangkatan' AND '$tgl_kedatangan') OR tgl_keberangkatan IS NULL GROUP BY kendaraan.nomor_polisi) as book
                                                        INNER JOIN
                                                        (SELECT kendaraan.nomor_polisi,kendaraan.merk_type,kendaraan.harga_sewa,kendaraan.tahun_keluaran FROM `booked` RIGHT JOIN kendaraan ON (booked.nomor_polisi=kendaraan.nomor_polisi) WHERE ('$tgl_keberangkatan' != tgl_keberangkatan AND '$tgl_keberangkatan' != tgl_kedatangan AND ('$tgl_keberangkatan' NOT BETWEEN tgl_keberangkatan AND tgl_kedatangan) AND '$tgl_kedatangan' != tgl_keberangkatan AND '$tgl_kedatangan' != tgl_kedatangan AND ('$tgl_kedatangan' NOT BETWEEN tgl_keberangkatan AND tgl_kedatangan) AND tgl_kedatangan NOT BETWEEN '$tgl_keberangkatan' AND '$tgl_kedatangan') OR tgl_keberangkatan IS NULL GROUP BY kendaraan.nomor_polisi) as trans
                                                        ON (book.nomor_polisi=trans.nomor_polisi)";
                                                    }
                                                    $result = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($result)) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo "
                                                            <tr>
                                                                <td> $row[nomor_polisi]</td>
                                                                <td> $row[merk_type]</td>
                                                                <td>Rp.  $row[harga_sewa]</td>
                                                                <td> $row[tahun_keluaran]</td>
                                                                <td><a href='booked.php?nomor_polisi=$row[nomor_polisi]&&tgl_keberangkatan=$tgl_keberangkatan&&tgl_kedatangan=$tgl_kedatangan#input-booked' class='btn btn-success'>Booking</a></td>
                                                            </tr>
                                                             ";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='5'>0 results</td></tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='5' text-allign='center'>0 results</td></tr>";
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
                                    <h4 class="title" id="input-booked">Booking Kendaraan</h4>
                                </div>
                                <div class="content">
                                    <?php
                                    $nomor_polisi = '';
                                    $tgl_keberangkatan = '';
                                    $tgl_kedatangan = '';
                                    if (isset($_GET['nomor_polisi'])) {
                                        $nomor_polisi = $_GET['nomor_polisi'];
                                        $tgl_keberangkatan = $_GET['tgl_keberangkatan'];
                                        $tgl_kedatangan = $_GET['tgl_kedatangan'];
                                    }
                                    ?>
                                    <form method="post" action="process.php?process=insert-booked">
                                    <div class="row col-md-12">
                                            <div class="form-group">
                                                <label>Nomor Polisi</label>
                                                <input type="text" name="nomor_polisi" class="form-control" placeholder="Nomor Polisi" readonly <?php echo "value='$nomor_polisi'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Keberangkatan</label>
                                                <input type="date" name="tgl_keberangkatan" class="form-control" placeholder="Tanggal Keberangkatan" readonly <?php echo "value='$tgl_keberangkatan'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Kedatangan</label>
                                                <input type="date" name="tgl_kedatangan" class="form-control" placeholder="Tanggal Kedatangan" readonly <?php echo "value='$tgl_kedatangan'"; ?>>
                                            </div>
                                        </div>
                                        <input class="btn btn-primary" type="submit" value="Booking">
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