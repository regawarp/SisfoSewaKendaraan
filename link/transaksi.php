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
                                    <h4 class="title">Data Transaksi</h4>
                                    <p class="category">Semua Data Transaksi</p>
                                </div>
                                <div class="content">
                                    <div class="content table-responsive table-full-width">
                                        <table id="myTable" class="table table-striped table-bordered table-hover" style="width:100%;">
                                            <thead>
                                                <th>No Surat Jalan</th>
                                                <th>Nomor Polisi</th>
                                                <th>Driver</th>
                                                <th>No. Golongan SIM</th>
                                                <th>Penjemputan</th>
                                                <th>Tanggal dibuat Surat Jalan</th>
                                                <th>Tempat dibuat Surat Jalan</th>
                                                <th>Penyewa</th>
                                                <th>Telepon</th>
                                                <th>Tujuan</th>
                                                <th>Tanggal Keberangkatan</th>
                                                <th>Tanggal Kedatangan</th>
                                                <th>Keterangan</th>
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
                                                        <td>$row[no_surat_jalan]</td>
                                                        <td>$row[nomor_polisi]</td>
                                                        <td>$row[driver]</td>
                                                        <td>$row[no_golongan_sim]</td>
                                                        <td>$row[penjemputan]</td>
                                                        <td>$row[tgl_dibuat_surat_jln]</td>
                                                        <td>$row[tmpt_dibuat_surat_jln]</td>
                                                        <td>$row[penyewa]</td>
                                                        <td>$row[telepon]</td>
                                                        <td>$row[tujuan]</td>
                                                        <td>$row[tgl_keberangkatan]</td>
                                                        <td>$row[tgl_kedatangan]</td>
                                                        <td>$row[keterangan]</td>
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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header" id="cari-kendaraan">
                                    <h4 class="title">Cari Kendaraan Tersedia</h4>
                                </div>
                                <div class="content">
                                    <form method="post" action="transaksi.php#cari-kendaraan">
                                        <input type="hidden" name="cari" value="yes">
                                        <div class="form-group col-lg-12">
                                            <label>Merk/Type</label>
                                            <input type="text" name="merk_tipe" class="form-control" placeholder="Merk/Type">
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
                                                $merk_tipe = $_POST['merk_tipe'];
                                                echo "<span>Tanggal: $tgl_keberangkatan - $tgl_kedatangan</span>";
                                                ?>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT * FROM transaksi RIGHT JOIN kendaraan ON(transaksi.nomor_polisi=kendaraan.nomor_polisi) WHERE ('$tgl_keberangkatan' != tgl_keberangkatan AND '$tgl_keberangkatan' != tgl_kedatangan AND ('$tgl_keberangkatan' NOT BETWEEN tgl_keberangkatan AND tgl_kedatangan) AND '$tgl_kedatangan' != tgl_keberangkatan AND '$tgl_kedatangan' != tgl_kedatangan AND ('$tgl_kedatangan' NOT BETWEEN tgl_keberangkatan AND tgl_kedatangan) AND tgl_kedatangan NOT BETWEEN '$tgl_keberangkatan' AND '$tgl_kedatangan') OR tgl_keberangkatan IS NULL";
                                                    $result = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($result)) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo "
                                                            <tr>
                                                                <td> $row[nomor_polisi]</td>
                                                                <td> $row[merk_type]</td>
                                                                <td>Rp.  $row[harga_sewa]</td>
                                                                <td> $row[tahun_keluaran]</td>
                                                                <td><a href='transaksi.php?nomor_polisi=$row[nomor_polisi]&&tgl_keberangkatan=$tgl_keberangkatan&&tgl_kedatangan=$tgl_kedatangan#input-transaksi' class='btn btn-success'>Buat Transaksi</a></td>
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
                                    <h4 class="title" id="input-transaksi">Buat Surat Jalan</h4>
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
                                    <form method="post" action="process.php?process=insert-transaksi">
                                        <div class="row col-md-12">
                                            <div class="form-group">
                                                <label>No Surat Jalan</label>
                                                <input type="text" name="no_surat_jalan" class="form-control" placeholder="No Surat Jalan" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor Polisi</label>
                                                <input type="text" name="nomor_polisi" class="form-control" placeholder="Nomor Polisi" readonly <?php echo "value='$nomor_polisi'"; ?>>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Driver</label>
                                                <input type="text" name="driver" class="form-control" placeholder="Driver">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>No/Golongan SIM</label>
                                                <input type="text" name="no_golongan_sim" class="form-control" placeholder="No/Golongan SIM">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Penjemputan</label>
                                                <input type="text" name="penjemputan" class="form-control" placeholder="Penjemputan">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Tanggal dibuat Surat Jalan</label>
                                                <input type="date" name="tgl_dibuat_surat_jln" class="form-control" placeholder="Tanggal dibuat Surat Jalan">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Tempat dibuat Surat Jalan</label>
                                                <input type="text" name="tmpt_dibuat_surat_jln" class="form-control" placeholder="Tempat dibuat Surat Jalan">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Penyewa</label>
                                                <input type="text" name="penyewa" class="form-control" placeholder="Penyewa">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Telepon</label>
                                                <input type="text" name="telepon" class="form-control" placeholder="Telepon">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Tujuan</label>
                                                <input type="text" name="tujuan" class="form-control" placeholder="Tujuan">
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Keberangkatan</label>
                                                <input type="date" name="tgl_keberangkatan" class="form-control" placeholder="Tanggal Keberangkatan" readonly <?php echo "value='$tgl_keberangkatan'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Kedatangan</label>
                                                <input type="date" name="tgl_kedatangan" class="form-control" placeholder="Tanggal Kedatangan" readonly <?php echo "value='$tgl_kedatangan'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" value="Belum Lunas" readonly>
                                            </div>
                                        </div>
                                        <input class="btn btn-primary" type="submit" value="Input Data">
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