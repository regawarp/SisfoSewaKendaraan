<?php
session_start();
if (!isset($_SESSION['username'])) {
    //Already loged in
    header("Location: ../index.php");
} else { }

switch ($_GET['process']) {
    case 'login':
        include('koneksi.php');
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $query = "SELECT * FROM account WHERE username='$username'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                if ($row = mysqli_fetch_assoc($result)) {
                    if ((string)$row['password'] == (string) $_POST['password']) {
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['status'] = $row['status'];
                        header('Location: dashboard.php');
                    } else {
                        header('Location: login.php?status=wrong-password');
                    }
                }
            } else {
                header('Location: login.php?status=wrong-username');
            }
        }
        mysqli_close($conn);
        break;
    case 'logout':
        session_destroy();
        header('Location: ../index.php');
        break;
    default:
        # code...
        break;
}
