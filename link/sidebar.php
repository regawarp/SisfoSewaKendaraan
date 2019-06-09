<div class="sidebar" data-color="orange" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text">
                PT. DUTAR Barokah Grup
            </a>
        </div>

        <ul class="nav">
            <li <?php if ($page=="dashboard"){echo "class='active'";} ?>>
                <a href="dashboard.php">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li <?php if ($page=="klien"){echo "class='active'";} ?>>
                <a href="klien.php">
                    <i class="pe-7s-user"></i>
                    <p>Klien</p>
                </a>
            </li>
            <li <?php if ($page=="kendaraan"){echo "class='active'";} ?>>
                <a href="kendaraan.php">
                    <i class="pe-7s-note2"></i>
                    <p>Kendaraan</p>
                </a>
            </li>
            <li <?php if ($page=="transaksi"){echo "class='active'";} ?>>
                <a href="transaksi.php">
                    <i class="pe-7s-news-paper"></i>
                    <p>Surat Jalan</p>
                </a>
            </li>
            <li <?php if ($page=="faktur"){echo "class='active'";} ?>>
                <a href="faktur.php">
                    <i class="pe-7s-news-paper"></i>
                    <p>Faktur</p>
                </a>
            </li>
            <li <?php if ($page=="tanda-terima"){echo "class='active'";} ?>>
                <a href="tanda-terima.php">
                    <i class="pe-7s-news-paper"></i>
                    <p>Tanda Terima</p>
                </a>
            </li>
            <li <?php if ($page=="laporan"){echo "class='active'";} ?>>
                <a href="laporan.php">
                    <i class="pe-7s-science"></i>
                    <p>Laporan</p>
                </a>
            </li>
        </ul>
    </div>
</div>