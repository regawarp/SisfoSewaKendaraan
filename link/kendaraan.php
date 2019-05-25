<?php
session_start();
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
                                                        <td>$row[harga_sewa]</td>
                                                        <td>$row[tahun_keluaran]</td>
                                                        <td><a href='process.php?process=update-kendaraan&&nomor_polisi=$row[nomor_polisi]' class='btn btn-warning'>Update</a>&nbsp;<a href='process.php?process=delete-kendaraan&&nomor_polisi=$row[nomor_polisi]' class='btn btn-danger'>Delete</a></td>
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

<!--   Core JS Files   -->
<script src="../assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="../assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="../assets/js/bootstrap-notify.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="../assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>


<!-- https://code.jquery.com/jquery-3.3.1.js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

</html>