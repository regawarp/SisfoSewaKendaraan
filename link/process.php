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
                    if ((string)$row['password'] == (string)$_POST['password']) {
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

    case 'insert-kendaraan':
        $nomor_polisi = $_POST['nomor_polisi'];
        $merk_type = $_POST['merk_type'];
        $harga_sewa = $_POST['harga_sewa'];
        $tahun_keluaran = $_POST['tahun_keluaran'];

        include('koneksi.php');
        $query = "INSERT INTO kendaraan VALUES('$nomor_polisi','$merk_type','$harga_sewa','$tahun_keluaran')";
        if (mysqli_query($conn, $query)) {
            header("Location:kendaraan.php?status=input-berhasil");
        } else {
            header("Location:kendaraan.php?status=input-gagal");
        }
        mysqli_close($conn);
        break;
    case 'update-kendaraan':
        $old_nomor_polisi = $_POST['old_nomor_polisi'];
        $nomor_polisi = $_POST['nomor_polisi'];
        $merk_type = $_POST['merk_type'];
        $harga_sewa = $_POST['harga_sewa'];
        $tahun_keluaran = $_POST['tahun_keluaran'];

        include('koneksi.php');
        $query = "UPDATE kendaraan SET nomor_polisi='$nomor_polisi',merk_type='$merk_type',harga_sewa=$harga_sewa,tahun_keluaran=$tahun_keluaran WHERE nomor_polisi='$old_nomor_polisi'";
        if (mysqli_query($conn, $query)) {
            header("Location:kendaraan.php?status=update-berhasil");
            // echo "BErhasil : $query";
        } else {
            header("Location:kendaraan.php?status=update-gagal");
            // echo "$query";
        }
        mysqli_close($conn);
        break;
    case 'delete-kendaraan':
        $nomor_polisi = $_GET['nomor_polisi'];
        include('koneksi.php');
        $query = "DELETE FROM kendaraan WHERE nomor_polisi='$nomor_polisi' ";
        if (mysqli_query($conn, $query)) {
            header("Location:kendaraan.php?status=delete-berhasil");
        } else {
            header("Location:kendaraan.php?status=delete-gagal");
        }
        mysqli_close($conn);
        break;

    case 'insert-transaksi':
        $no_surat_jalan = $_POST['no_surat_jalan'];
        $nomor_polisi = $_POST['nomor_polisi'];
        $driver = $_POST['driver'];
        $no_golongan_sim = $_POST['no_golongan_sim'];
        $penjemputan = $_POST['penjemputan'];
        $tgl_dibuat_surat_jln = $_POST['tgl_dibuat_surat_jln'];
        $tmpt_dibuat_surat_jln = $_POST['tmpt_dibuat_surat_jln'];
        $penyewa = $_POST['penyewa'];
        $telepon = $_POST['telepon'];
        $tujuan = $_POST['tujuan'];
        $tgl_keberangkatan = $_POST['tgl_keberangkatan'];
        $tgl_kedatangan = $_POST['tgl_kedatangan'];
        $keterangan = $_POST['keterangan'];

        include('koneksi.php');
        $query = "INSERT INTO transaksi VALUES('$no_surat_jalan','$nomor_polisi','$driver','$no_golongan_sim','$penjemputan','$tgl_dibuat_surat_jln','$tmpt_dibuat_surat_jln','$penyewa','$telepon','$tujuan','$tgl_keberangkatan','$tgl_kedatangan','$keterangan')";
        if (mysqli_query($conn, $query)) {
            header("Location:transaksi.php?status=input-berhasil");
        } else {
            header("Location:transaksi.php?status=input-gagal");
        }
        break;
    case 'update-transaksi':
        $no_surat_jalan = $_POST['no_surat_jalan'];
        $nomor_polisi = $_POST['nomor_polisi'];
        $driver = $_POST['driver'];
        $no_golongan_sim = $_POST['no_golongan_sim'];
        $penjemputan = $_POST['penjemputan'];
        $tgl_dibuat_surat_jln = $_POST['tgl_dibuat_surat_jln'];
        $tmpt_dibuat_surat_jln = $_POST['tmpt_dibuat_surat_jln'];
        $penyewa = $_POST['penyewa'];
        $telepon = $_POST['telepon'];
        $tujuan = $_POST['tujuan'];
        $tgl_keberangkatan = $_POST['tgl_keberangkatan'];
        $tgl_kedatangan = $_POST['tgl_kedatangan'];
        $keterangan = $_POST['keterangan'];

        include('koneksi.php');
        $query = "UPDATE transaksi SET nomor_polisi='$nomor_polisi',driver='$driver',no_golongan_sim='$no_golongan_sim',penjemputan='$penjemputan',tgl_dibuat_surat_jln='$tgl_dibuat_surat_jln',tmpt_dibuat_surat_jln='$tmpt_dibuat_surat_jln',penyewa='$penyewa',telepon='$telepon',tujuan='$tujuan',tgl_keberangkatan='$tgl_keberangkatan',tgl_kedatangan='$tgl_kedatangan',keterangan='$keterangan' WHERE no_surat_jalan='$no_surat_jalan'";
        if (mysqli_query($conn, $query)) {
            header("Location:transaksi.php?status=update-berhasil");
        } else {
            header("Location:transaksi.php?status=update-gagal");
        }
        break;
    case 'delete-transaksi':
        $no_surat_jalan = $_GET['no_surat_jalan'];
        include('koneksi.php');
        $query = "DELETE FROM transaksi WHERE no_surat_jalan='$no_surat_jalan' ";
        if (mysqli_query($conn, $query)) {
            header("Location:transaksi.php?status=delete-berhasil");
        } else {
            header("Location:transaksi.php?status=delete-gagal");
        }
        mysqli_close($conn);
        break;

    default:
        # code...
        break;
}
