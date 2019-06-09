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

    case 'insert-faktur':
        $no_faktur = $_POST['no_faktur'];
        $no_surat_jalan = $_POST['no_surat_jalan'];
        $tanggal_faktur = $_POST['tanggal_faktur'];
        $deskripsi_sewa = $_POST['deskripsi_sewa'];
        $rincian_service = $_POST['rincian_service'];
        $total_biaya = $_POST['total_biaya'];

        include('koneksi.php');
        $query = "INSERT INTO faktur VALUES('$no_faktur','$no_surat_jalan','$tanggal_faktur','$deskripsi_sewa','$rincian_service','$total_biaya')";
        if (mysqli_query($conn, $query)) {
            header("Location:faktur.php?no_surat_jalan=$no_surat_jalan&&status=input-berhasil");
        } else {
            header("Location:faktur.php?no_surat_jalan=$no_surat_jalan&&status=input-gagal");
        }
        break;
    case 'update-faktur':
        $no_faktur = $_POST['no_faktur'];
        $no_faktur_old = $_POST['no_faktur_old'];
        $no_surat_jalan = $_POST['no_surat_jalan'];
        $tanggal_faktur = $_POST['tanggal_faktur'];
        $deskripsi_sewa = $_POST['deskripsi_sewa'];
        $rincian_service = $_POST['rincian_service'];
        $total_biaya = $_POST['total_biaya'];

        include('koneksi.php');
        $query = "UPDATE faktur SET no_faktur='$no_faktur',tanggal_faktur='$tanggal_faktur',deskripsi_sewa='$deskripsi_sewa',rincian_service='$rincian_service',total_biaya='$total_biaya' WHERE no_surat_jalan='$no_surat_jalan' AND no_faktur='$no_faktur_old'";
        if (mysqli_query($conn, $query)) {
            header("Location:faktur.php?no_surat_jalan=$no_surat_jalan&&status=update-berhasil");
        } else {
            header("Location:faktur.php?no_surat_jalan=$no_surat_jalan&&status=update-gagal");
        }
        break;
    case 'delete-faktur':
        $no_surat_jalan = $_GET['no_surat_jalan'];
        $no_faktur = $_GET['no_faktur'];
        include('koneksi.php');
        $query = "DELETE FROM faktur WHERE no_faktur='$no_faktur' ";
        if (mysqli_query($conn, $query)) {
            header("Location:faktur.php?no_surat_jalan=$no_surat_jalan&&status=delete-berhasil");
        } else {
            header("Location:faktur.php?no_surat_jalan=$no_surat_jalan&&status=delete-gagal");
        }
        mysqli_close($conn);
        break;

    case 'insert-tanda-terima':
        $no_tanda_terima = $_POST['no_tanda_terima'];
        $no_surat_jalan = $_POST['no_surat_jalan'];
        $tanggal = $_POST['tanggal'];
        $uang_sejumlah = $_POST['uang_sejumlah'];
        $terbilang = terbilang($uang_sejumlah);
        $untuk_pembayaran = $_POST['untuk_pembayaran'];
        $sisa_pembayaran;
        $rincian_biaya = $_POST['rincian_biaya'];
        $total_biaya;


        include('koneksi.php');
        $queryTotal = "SELECT sisa_pembayaran as 'total_biaya' FROM tanda_terima WHERE no_surat_jalan='$no_surat_jalan' ORDER BY sisa_pembayaran ASC LIMIT 1";
        $result = mysqli_query($conn, $queryTotal);
        if (mysqli_num_rows($result) < 0) {
            $queryTotal = "SELECT SUM(total_biaya) as 'total_biaya' FROM faktur WHERE no_surat_jalan='$no_surat_jalan'";
            $result = mysqli_query($conn, $queryTotal);
        }
        $row = mysqli_fetch_assoc($result);
        $total_biaya = $row['total_biaya'];
        $sisa_pembayaran = $total_biaya - $uang_sejumlah;

        $query = "INSERT INTO tanda_terima VALUES('$no_tanda_terima','$no_surat_jalan','$tanggal','$terbilang','$uang_sejumlah','$untuk_pembayaran','$sisa_pembayaran','$rincian_biaya')";
        if (mysqli_query($conn, $query)) {
            header("Location:tanda-terima.php?no_surat_jalan=$no_surat_jalan&&status=input-berhasil");
        } else {
            header("Location:tanda-terima.php?no_surat_jalan=$no_surat_jalan&&status=input-gagal");
        }
        break;
    case 'update-tanda-terima':
        $no_tanda_terima = $_POST['no_tanda_terima'];
        $no_tanda_terima_old = $_POST['no_tanda_terima_old'];
        $no_surat_jalan = $_POST['no_surat_jalan'];
        $tanggal = $_POST['tanggal'];
        $uang_sejumlah = $_POST['uang_sejumlah'];
        $terbilang = terbilang($uang_sejumlah);
        $untuk_pembayaran = $_POST['untuk_pembayaran'];
        $sisa_pembayaran;
        $rincian_biaya = $_POST['rincian_biaya'];
        $total_biaya;

        include('koneksi.php');
        $queryTotal = "SELECT sisa_pembayaran as 'total_biaya' FROM tanda_terima WHERE no_surat_jalan='$no_surat_jalan' ORDER BY sisa_pembayaran ASC LIMIT 1";
        $result = mysqli_query($conn, $queryTotal);
        if (mysqli_num_rows($result) < 0) {
            $queryTotal = "SELECT SUM(total_biaya) as 'total_biaya' FROM faktur WHERE no_surat_jalan='$no_surat_jalan'";
            $result = mysqli_query($conn, $queryTotal);
        }
        $row = mysqli_fetch_assoc($result);
        $total_biaya = $row['total_biaya'];
        $sisa_pembayaran = $total_biaya - $uang_sejumlah;

        $query = "UPDATE tanda_terima SET no_tanda_terima='$no_tanda_terima',no_surat_jalan='$no_surat_jalan',tanggal='$tanggal',terbilang='$terbilang',uang_sejumlah='$uang_sejumlah',untuk_pembayaran='$untuk_pembayaran',sisa_pembayaran='$sisa_pembayaran',rincian_biaya='$rincian_biaya' WHERE no_surat_jalan='$no_surat_jalan' AND no_tanda_terima='$no_tanda_terima_old'";
        if (mysqli_query($conn, $query)) {
            header("Location:tanda-terima.php?no_surat_jalan=$no_surat_jalan&&status=update-berhasil");
        } else {
            header("Location:tanda-terima.php?no_surat_jalan=$no_surat_jalan&&status=update-gagal");
        }
        break;
    case 'delete-tanda-terima':
        $no_surat_jalan = $_GET['no_surat_jalan'];
        $no_tanda_terima = $_GET['no_tanda_terima'];
        include('koneksi.php');
        $query = "DELETE FROM tanda_terima WHERE no_tanda_terima='$no_tanda_terima' ";
        if (mysqli_query($conn, $query)) {
            header("Location:tanda-terima.php?no_surat_jalan=$no_surat_jalan&&status=delete-berhasil");
        } else {
            header("Location:tanda-terima.php?no_surat_jalan=$no_surat_jalan&&status=delete-gagal");
        }
        mysqli_close($conn);
        break;

    default:
        # code...
        break;
}
function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}
