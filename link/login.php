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

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <form method="post" action="process.php?process=login">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control" placeholder="Password">
                    </div>
                    <input class="btn btn-primary" type="submit" value="Login">
                </form>
            </div>
        </div>
    </div>
</body>

</html>