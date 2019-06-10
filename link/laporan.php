<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:login.php');
}
$page = "laporan";
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
                                    <h4 class="title">Laporan Pemasukan</h4>
                                    <p class="category"></p>
                                </div>
                                <div class="content">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Laporan Klien</h4>
                                    <p class="category"></p>
                                </div>
                                <div class="content">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Laporan Kendaraan</h4>
                                    <p class="category"></p>
                                </div>
                                <div class="content">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            - laporan pemasukan
            - laporan data klien keseluruhan
            - laporan data klien (lunas / belum)
            - laporan data kendaraan
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