<?php
session_start();
if (!isset($_SESSION['username'])) {
    //Already loged in
    header("Location: ../index.php");
} else { }
include('koneksi.php');
switch (mysqli_real_escape_string($conn, $_GET['process'])) {
    case 'login':

        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $query = "SELECT * FROM account WHERE username='$username'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                if ($row = mysqli_fetch_assoc($result)) {
                    if ((string)$row['password'] == (string)mysqli_real_escape_string($conn, $_POST['password'])) {
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
        $nomor_polisi = mysqli_real_escape_string($conn, $_POST['nomor_polisi']);
        $merk_type = mysqli_real_escape_string($conn, $_POST['merk_type']);
        $harga_sewa = mysqli_real_escape_string($conn, $_POST['harga_sewa']);
        $tahun_keluaran = mysqli_real_escape_string($conn, $_POST['tahun_keluaran']);


        $query = "INSERT INTO kendaraan VALUES('$nomor_polisi','$merk_type','$harga_sewa','$tahun_keluaran')";
        if (mysqli_query($conn, $query)) {
            header("Location:kendaraan.php?status=input-berhasil");
        } else {
            header("Location:kendaraan.php?status=input-gagal");
        }
        mysqli_close($conn);
        break;
    case 'update-kendaraan':
        $old_nomor_polisi = mysqli_real_escape_string($conn, $_POST['old_nomor_polisi']);
        $nomor_polisi = mysqli_real_escape_string($conn, $_POST['nomor_polisi']);
        $merk_type = mysqli_real_escape_string($conn, $_POST['merk_type']);
        $harga_sewa = mysqli_real_escape_string($conn, $_POST['harga_sewa']);
        $tahun_keluaran = mysqli_real_escape_string($conn, $_POST['tahun_keluaran']);


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
        $nomor_polisi = mysqli_real_escape_string($conn, $_GET['nomor_polisi']);

        $query = "DELETE FROM kendaraan WHERE nomor_polisi='$nomor_polisi' ";
        if (mysqli_query($conn, $query)) {
            header("Location:kendaraan.php?status=delete-berhasil");
        } else {
            header("Location:kendaraan.php?status=delete-gagal");
        }
        mysqli_close($conn);
        break;

    case 'insert-transaksi':
        $no_surat_jalan = mysqli_real_escape_string($conn, $_POST['no_surat_jalan']);
        $nomor_polisi = mysqli_real_escape_string($conn, $_POST['nomor_polisi']);
        $driver = mysqli_real_escape_string($conn, $_POST['driver']);
        $no_golongan_sim = mysqli_real_escape_string($conn, $_POST['no_golongan_sim']);
        $penjemputan = mysqli_real_escape_string($conn, $_POST['penjemputan']);
        $tgl_dibuat_surat_jln = mysqli_real_escape_string($conn, $_POST['tgl_dibuat_surat_jln']);
        $tmpt_dibuat_surat_jln = mysqli_real_escape_string($conn, $_POST['tmpt_dibuat_surat_jln']);
        $penyewa = mysqli_real_escape_string($conn, $_POST['penyewa']);
        $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
        $tujuan = mysqli_real_escape_string($conn, $_POST['tujuan']);
        $tgl_keberangkatan = mysqli_real_escape_string($conn, $_POST['tgl_keberangkatan']);
        $tgl_kedatangan = mysqli_real_escape_string($conn, $_POST['tgl_kedatangan']);
        $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);


        $query = "INSERT INTO transaksi VALUES('$no_surat_jalan','$nomor_polisi','$driver','$no_golongan_sim','$penjemputan','$tgl_dibuat_surat_jln','$tmpt_dibuat_surat_jln','$penyewa','$telepon','$tujuan','$tgl_keberangkatan','$tgl_kedatangan','$keterangan')";
        if (mysqli_query($conn, $query)) {
            $query = "INSERT INTO faktur VALUES('$no_surat_jalan/F1','$no_surat_jalan','$tgl_dibuat_surat_jln','-','-',0)";
            mysqli_query($conn, $query);
            header("Location:transaksi.php?status=input-berhasil");
        } else {
            echo mysqli_error($conn);
            // header("Location:transaksi.php?status=input-gagal");
        }
        break;
    case 'update-transaksi':
        $no_surat_jalan = mysqli_real_escape_string($conn, $_POST['no_surat_jalan']);
        $nomor_polisi = mysqli_real_escape_string($conn, $_POST['nomor_polisi']);
        $driver = mysqli_real_escape_string($conn, $_POST['driver']);
        $no_golongan_sim = mysqli_real_escape_string($conn, $_POST['no_golongan_sim']);
        $penjemputan = mysqli_real_escape_string($conn, $_POST['penjemputan']);
        $tgl_dibuat_surat_jln = mysqli_real_escape_string($conn, $_POST['tgl_dibuat_surat_jln']);
        $tmpt_dibuat_surat_jln = mysqli_real_escape_string($conn, $_POST['tmpt_dibuat_surat_jln']);
        $penyewa = mysqli_real_escape_string($conn, $_POST['penyewa']);
        $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
        $tujuan = mysqli_real_escape_string($conn, $_POST['tujuan']);
        $tgl_keberangkatan = mysqli_real_escape_string($conn, $_POST['tgl_keberangkatan']);
        $tgl_kedatangan = mysqli_real_escape_string($conn, $_POST['tgl_kedatangan']);
        $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);


        $query = "UPDATE transaksi SET nomor_polisi='$nomor_polisi',driver='$driver',no_golongan_sim='$no_golongan_sim',penjemputan='$penjemputan',tgl_dibuat_surat_jln='$tgl_dibuat_surat_jln',tmpt_dibuat_surat_jln='$tmpt_dibuat_surat_jln',penyewa='$penyewa',telepon='$telepon',tujuan='$tujuan',tgl_keberangkatan='$tgl_keberangkatan',tgl_kedatangan='$tgl_kedatangan',keterangan='$keterangan' WHERE no_surat_jalan='$no_surat_jalan'";
        if (mysqli_query($conn, $query)) {
            header("Location:transaksi.php?status=update-berhasil");
        } else {
            header("Location:transaksi.php?status=update-gagal");
        }
        break;
    case 'delete-transaksi':
        $no_surat_jalan = mysqli_real_escape_string($conn, $_GET['no_surat_jalan']);

        $query = "DELETE FROM transaksi WHERE no_surat_jalan='$no_surat_jalan' ";
        if (mysqli_query($conn, $query)) {
            header("Location:transaksi.php?status=delete-berhasil");
        } else {
            header("Location:transaksi.php?status=delete-gagal");
        }
        mysqli_close($conn);
        break;

    case 'insert-faktur':
        $no_faktur = mysqli_real_escape_string($conn, $_POST['no_faktur']);
        $no_surat_jalan = mysqli_real_escape_string($conn, $_POST['no_surat_jalan']);
        $tanggal_faktur = mysqli_real_escape_string($conn, $_POST['tanggal_faktur']);
        $deskripsi_sewa = mysqli_real_escape_string($conn, $_POST['deskripsi_sewa']);
        $rincian_service = mysqli_real_escape_string($conn, $_POST['rincian_service']);
        $total_biaya = mysqli_real_escape_string($conn, $_POST['total_biaya']);


        $query = "INSERT INTO faktur VALUES('$no_faktur','$no_surat_jalan','$tanggal_faktur','$deskripsi_sewa','$rincian_service','$total_biaya')";
        if (mysqli_query($conn, $query)) {
            header("Location:faktur.php?no_surat_jalan=$no_surat_jalan&&status=input-berhasil");
        } else {
            header("Location:faktur.php?no_surat_jalan=$no_surat_jalan&&status=input-gagal");
        }
        break;
    case 'update-faktur':
        $no_faktur = mysqli_real_escape_string($conn, $_POST['no_faktur']);
        $no_faktur_old = mysqli_real_escape_string($conn, $_POST['no_faktur_old']);
        $no_surat_jalan = mysqli_real_escape_string($conn, $_POST['no_surat_jalan']);
        $tanggal_faktur = mysqli_real_escape_string($conn, $_POST['tanggal_faktur']);
        $deskripsi_sewa = mysqli_real_escape_string($conn, $_POST['deskripsi_sewa']);
        $rincian_service = mysqli_real_escape_string($conn, $_POST['rincian_service']);
        $total_biaya = mysqli_real_escape_string($conn, $_POST['total_biaya']);


        $query = "UPDATE faktur SET no_faktur='$no_faktur',tanggal_faktur='$tanggal_faktur',deskripsi_sewa='$deskripsi_sewa',rincian_service='$rincian_service',total_biaya='$total_biaya' WHERE no_surat_jalan='$no_surat_jalan' AND no_faktur='$no_faktur_old'";
        if (mysqli_query($conn, $query)) {
            header("Location:faktur.php?no_surat_jalan=$no_surat_jalan&&status=update-berhasil");
        } else {
            header("Location:faktur.php?no_surat_jalan=$no_surat_jalan&&status=update-gagal");
        }
        break;
    case 'delete-faktur':
        $no_surat_jalan = mysqli_real_escape_string($conn, $_GET['no_surat_jalan']);
        $no_faktur = mysqli_real_escape_string($conn, $_GET['no_faktur']);

        $query = "DELETE FROM faktur WHERE no_faktur='$no_faktur' ";
        if (mysqli_query($conn, $query)) {
            header("Location:faktur.php?no_surat_jalan=$no_surat_jalan&&status=delete-berhasil");
        } else {
            header("Location:faktur.php?no_surat_jalan=$no_surat_jalan&&status=delete-gagal");
        }
        mysqli_close($conn);
        break;

    case 'insert-tanda-terima':
        $no_tanda_terima = mysqli_real_escape_string($conn, $_POST['no_tanda_terima']);
        $no_surat_jalan = mysqli_real_escape_string($conn, $_POST['no_surat_jalan']);
        $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
        $uang_sejumlah = mysqli_real_escape_string($conn, $_POST['uang_sejumlah']);
        $terbilang = terbilang($uang_sejumlah);
        $untuk_pembayaran = mysqli_real_escape_string($conn, $_POST['untuk_pembayaran']);
        $sisa_pembayaran;
        $rincian_biaya = mysqli_real_escape_string($conn, $_POST['rincian_biaya']);
        $total_biaya;

        // HITUNG BIAYA SEWA
        $query = "SELECT * FROM transaksi,kendaraan WHERE transaksi.nomor_polisi=kendaraan.nomor_polisi AND no_surat_jalan='$no_surat_jalan'";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $jmlHari;
        if ($row['tgl_keberangkatan'] == $row['tgl_kedatangan']) {
            $jmlHari = 1;
        } else {
            $keberangkatan = strtotime($row['tgl_keberangkatan']);
            $kedatangan = strtotime($row['tgl_kedatangan']);
            $datediff = $kedatangan - $keberangkatan;
            $jmlHari = round($datediff / (60 * 60 * 24));
        }
        $totalBiayaSewa = $row['harga_sewa'] * $jmlHari;
        // END HITUNG BIAYA SEWA

        $queryTotal = "SELECT sisa_pembayaran as 'total_biaya' FROM tanda_terima WHERE no_surat_jalan='$no_surat_jalan' ORDER BY sisa_pembayaran ASC LIMIT 1";
        $result = mysqli_query($conn, $queryTotal);
        if (mysqli_num_rows($result) <= 0) {
            $queryTotal = "SELECT SUM(total_biaya) as 'total_biaya' FROM faktur WHERE no_surat_jalan='$no_surat_jalan'";
            $result = mysqli_query($conn, $queryTotal);
        } else {
            $totalBiayaSewa = 0;
        }
        $row = mysqli_fetch_assoc($result);
        $total_biaya = $row['total_biaya'] + $totalBiayaSewa;
        $sisa_pembayaran = $total_biaya - $uang_sejumlah;
        if ($sisa_pembayaran < 0) {
            $sisa_pembayaran = 0;
        }
        $query = "INSERT INTO tanda_terima VALUES('$no_tanda_terima','$no_surat_jalan','$tanggal','$terbilang','$uang_sejumlah','$untuk_pembayaran','$sisa_pembayaran','$rincian_biaya')";
        if (mysqli_query($conn, $query)) {
            if ($sisa_pembayaran <= 0) {
                $query = "UPDATE transaksi SET keterangan='Lunas' WHERE no_surat_jalan='$no_surat_jalan'";
                mysqli_query($conn, $query);
            }
            header("Location:tanda-terima.php?no_surat_jalan=$no_surat_jalan&&status=input-berhasil");
        } else {
            // header("Location:tanda-terima.php?no_surat_jalan=$no_surat_jalan&&status=input-gagal");
            echo mysqli_error($conn);
        }
        break;
    case 'update-tanda-terima':
        $no_tanda_terima = mysqli_real_escape_string($conn, $_POST['no_tanda_terima']);
        $no_tanda_terima_old = mysqli_real_escape_string($conn, $_POST['no_tanda_terima_old']);
        $no_surat_jalan = mysqli_real_escape_string($conn, $_POST['no_surat_jalan']);
        $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
        $uang_sejumlah = mysqli_real_escape_string($conn, $_POST['uang_sejumlah']);
        $terbilang = terbilang($uang_sejumlah);
        $untuk_pembayaran = mysqli_real_escape_string($conn, $_POST['untuk_pembayaran']);
        $sisa_pembayaran;
        $rincian_biaya = mysqli_real_escape_string($conn, $_POST['rincian_biaya']);
        $total_biaya;


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
        $no_surat_jalan = mysqli_real_escape_string($conn, $_GET['no_surat_jalan']);
        $no_tanda_terima = mysqli_real_escape_string($conn, $_GET['no_tanda_terima']);

        $query = "DELETE FROM tanda_terima WHERE no_tanda_terima='$no_tanda_terima' ";
        if (mysqli_query($conn, $query)) {
            header("Location:tanda-terima.php?no_surat_jalan=$no_surat_jalan&&status=delete-berhasil");
        } else {
            header("Location:tanda-terima.php?no_surat_jalan=$no_surat_jalan&&status=delete-gagal");
        }
        mysqli_close($conn);
        break;

    case 'insert-akun':
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);


        $query = "INSERT INTO account VALUES('$username','$password','$status')";
        if (mysqli_query($conn, $query)) {
            header("Location:akun.php?status=input-berhasil");
        } else {
            header("Location:akun.php?status=input-gagal");
        }
        mysqli_close($conn);
        break;
    case 'update-akun':
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        $query = "UPDATE account SET username='$username',password='$password',status='$status' WHERE username='$username'";
        if (mysqli_query($conn, $query)) {
            header("Location:akun.php?status=update-berhasil");
            // echo "BErhasil : $query";
        } else {
            header("Location:akun.php?status=update-gagal");
            // echo "$query";
        }
        mysqli_close($conn);
        break;
    case 'delete-akun':
        $username = mysqli_real_escape_string($conn, $_GET['username']);

        $query = "DELETE FROM account WHERE username='$username' ";
        if (mysqli_query($conn, $query)) {
            header("Location:akun.php?status=delete-berhasil");
        } else {
            header("Location:akun.php?status=delete-gagal");
        }
        mysqli_close($conn);
        break;

    case 'insert-booked':
        $nomor_polisi = mysqli_real_escape_string($conn, $_POST['nomor_polisi']);
        $tgl_keberangkatan = mysqli_real_escape_string($conn, $_POST['tgl_keberangkatan']);
        $tgl_kedatangan = mysqli_real_escape_string($conn, $_POST['tgl_kedatangan']);

        $query = "INSERT INTO booked VALUES('','$nomor_polisi','$tgl_keberangkatan','$tgl_kedatangan')";
        if (mysqli_query($conn, $query)) {
            header("Location:booked.php?status=input-berhasil");
        } else {
            header("Location:booked.php?status=input-gagal");
        }
        mysqli_close($conn);
        break;
    case 'update-booked':
        $id_book = mysqli_real_escape_string($conn, $_POST['id_book']);
        $nomor_polisi = mysqli_real_escape_string($conn, $_POST['nomor_polisi']);
        $tgl_keberangkatan = mysqli_real_escape_string($conn, $_POST['tgl_keberangkatan']);
        $tgl_kedatangan = mysqli_real_escape_string($conn, $_POST['tgl_kedatangan']);

        $query = "UPDATE booked SET nomor_polisi='$nomor_polisi',tgl_keberangkatan='$tgl_keberangkatan',tgl_kedatangan='$tgl_kedatangan' WHERE id_book='$id_book'";
        if (mysqli_query($conn, $query)) {
            header("Location:booked.php?status=update-berhasil");
            // echo "BErhasil : $query";
        } else {
            header("Location:booked.php?status=update-gagal");
            // echo "$query";
        }
        mysqli_close($conn);
        break;
    case 'delete-booked':
        $id_book = mysqli_real_escape_string($conn, $_GET['id_book']);

        $query = "DELETE FROM booked WHERE id_book='$id_book' ";
        if (mysqli_query($conn, $query)) {
            header("Location:booked.php?status=delete-berhasil");
        } else {
            header("Location:booked.php?status=delete-gagal");
        }
        mysqli_close($conn);
        break;

    case 'export-laporan':
        switch ($_POST['jenis_laporan']) {
            case 'pendapatan':
                header("location:laporan-pendapatan_export.php?tanggal_awal=$_POST[tanggal_awal]&&tanggal_akhir=$_POST[tanggal_akhir]");
                break;
            case 'klien':
                header("location:laporan-klien_export.php?tanggal_awal=$_POST[tanggal_awal]&&tanggal_akhir=$_POST[tanggal_akhir]");
                break;
            case 'klien_lunas':
                header("location:laporan-klien_lunas_export.php?tanggal_awal=$_POST[tanggal_awal]&&tanggal_akhir=$_POST[tanggal_akhir]");
                break;
            case 'klien_belum_lunas':
                header("location:laporan-klien_belum_lunas_export.php?tanggal_awal=$_POST[tanggal_awal]&&tanggal_akhir=$_POST[tanggal_akhir]");
                break;
            case 'kendaraan':
                header("location:laporan-kendaraan_export.php?tanggal_awal=$_POST[tanggal_awal]&&tanggal_akhir=$_POST[tanggal_akhir]");
                break;
            case 'kat_penjemputan':
                header("location:laporan-kat_penjemputan_export.php?tanggal_awal=$_POST[tanggal_awal]&&tanggal_akhir=$_POST[tanggal_akhir]");
                break;
            case 'kat_tujuan':
                header("location:laporan-kat_tujuan_export.php?tanggal_awal=$_POST[tanggal_awal]&&tanggal_akhir=$_POST[tanggal_akhir]");
                break;
            case 'kat_merek':
                header("location:laporan-kat_merek_export.php?tanggal_awal=$_POST[tanggal_awal]&&tanggal_akhir=$_POST[tanggal_akhir]");
                break;
        }
        break;

    default:
        # code...
        break;
}
function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf  = array("", "satu", "dua",  "tiga",  "empat",  "lima",  "enam", "tujuh", "delapan",  "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai  - 10) . " belas";
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
        $temp = penyebut($nilai /  1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai <  0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}
