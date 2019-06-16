<?php
session_start();
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    echo "<script type='text/javascript'>alert('$status');</script>";
}
if (!isset($_SESSION['username'])) {
    header('Location:login.php');
}
$page = "account";
include('koneksi.php');
$sql = "SELECT * FROM account WHERE username='$_GET[username]'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
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
                                    <h4 class="title" id="input-akun">Update Akun</h4>
                                </div>
                                <div class="content">
                                    <form method="post" action="process.php?process=update-akun">
                                        <div class="row col-md-12">

                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="username" class="form-control" placeholder="Username" required <?php echo "value='$row[username]'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="text" name="password" class="form-control" placeholder="Password" required <?php echo "value='$row[password]'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label>Jabatan</label>
                                                <input type="text" name="status" class="form-control" placeholder="Jabatan" required <?php echo "value='$row[status]'"; ?>>
                                            </div>
                                        </div>
                                        <input class="btn btn-primary" type="submit" value="Update Akun">
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