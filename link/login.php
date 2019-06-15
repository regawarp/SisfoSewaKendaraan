<?php
session_start();
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    echo "<script type='text/javascript'>alert('$status');</script>";
}
if (isset($_SESSION['username'])) {
    //Already loged in
    header("Location: dashboard.php");
} else { }
?>
<!DOCTYPE html>
<html>

<head>
    <?php include('head.php'); ?>
</head>

<body style="background-color:#30318B;">
    <div class="container" width="100%">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center " style="margin-top:80px;">
                <img src="../assets/img/logo-dutar.png" height="100px" width="auto">
                <br>
                <div style="color:white; margin:10px; font-size:16pt;">
                    <span>PT. DUTAR Barokah Grup</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="card">
                    <div class="header">
                        Login
                    </div>
                    <div class="content">
                        <form method="post" action="process.php?process=login">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" placeholder="Password">
                            </div>
                            <input class="btn btn-primary btn-block" type="submit" value="Login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>