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
    <form method="post" action="process.php?process=login">
        <input type="text" name="username">
        <input type="password" name="password">
        <input type="submit" value="Login">
    </form>
</body>

</html>