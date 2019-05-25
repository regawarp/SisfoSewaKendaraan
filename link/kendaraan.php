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
$sql = "SELECT * FROM kendaraan";
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
                                    <h4 class="title">Data Kendaraan</h4>
                                    <p class="category">Semua Data Kendaraan</p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table id="myTable" class="table table-striped table-bordered table-hover" style="width:100%;">
                                        <thead>
                                            <th>Nomor Polisi</th>
                                            <th>Merk/Type</th>
                                            <th>Harga Sewa</th>
                                            <th>Tahun Keluaran</th>
                                            <th>Option</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "
                                                    <tr>
                                                        <td>$row[nomor_polisi]</td>
                                                        <td>$row[merk_type]</td>
                                                        <td>Rp. $row[harga_sewa]</td>
                                                        <td>$row[tahun_keluaran]</td>
                                                        <td><a href='kendaraan_update.php?nomor_polisi=$row[nomor_polisi]' class='btn btn-warning'>Update</a>&nbsp;<a href='process.php?process=delete-kendaraan&&nomor_polisi=$row[nomor_polisi]' class='btn btn-danger'>Delete</a></td>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Input Kendaraan</h4>
                                </div>
                                <div class="content">
                                    <form method="post" action="process.php?process=insert-kendaraan">
                                        <div class="form-group">
                                            <label>Nomor Polisi</label>
                                            <input type="text" name="nomor_polisi" class="form-control" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <label>Merk / Type</label>
                                            <input type="text" name="merk_type" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Sewa</label>
                                            <input type="text" name="harga_sewa" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Keluaran</label>
                                            <input type="text" name="tahun_keluaran" class="form-control" placeholder="Password">
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
        $('#myTable').DataTable();
    });
</script>

</html>