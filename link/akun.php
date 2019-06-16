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
$sql = "SELECT * FROM account";
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
                                    <h4 class="title">Data Akun</h4>
                                    <p class='category'>Semua Akun</p>
                                </div>
                                <div class="content">
                                    <div class="content table-responsive table-full-width">
                                        <table id="myTable" class="table table-striped table-bordered table-hover" style="width:100%;">
                                            <thead>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Jabatan</th>
                                                <th>Option</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "
                                                    <tr>
                                                        <td>$row[username]</td>
                                                        <td>$row[password]</td>
                                                        <td>$row[status]</td>
                                                        <td><a href='akun_update.php?username=$row[username]' class='btn btn-warning'>Update</a>&nbsp;
                                                        <a href='process.php?process=delete-akun&&username=$row[username]' class='btn btn-danger'>Delete</a></td>
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
                                    <h4 class="title" id="input-akun">Buat Akun</h4>
                                </div>
                                <div class="content">
                                    <form method="post" action="process.php?process=insert-akun">
                                        <div class="row col-md-12">
                                           
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="text" name="password" class="form-control" placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Jabatan</label>
                                                <input type="text" name="status" class="form-control" placeholder="Jabatan" required>
                                            </div>
                                        </div>
                                        <input class="btn btn-primary" type="submit" value="Input Akun">
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