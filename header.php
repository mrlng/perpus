<?php 
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../");
    exit(); // Terminate script execution after the redirect
 }   ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>
            <?php 
            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri_segments = explode('/', $uri_path);
            echo $uri_segments[2];
            ?>
             - LibraryLTE
        </title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../bootstrap/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
	    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">LibraryLTE</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <span class="d-none d-md-inline-block ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </span>
            <!-- Navbar-->
            
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php  ?>
                    <?php
                    require ('../config/koneksi.php');
                    $id = $_SESSION['id'];
                    $sql = "SELECT * FROM staff WHERE staff_id='$id'";
                    $result = $mysqli->query($sql);
 
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo $row["nama"];
                    };
                    ?>
                        <i class="fas fa-user fa-fw"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalLogout"><i class="fa fa-power-off"></i> Logout</button></li>
                    </ul>
                </li>
            </ul>

                      
          </div>
        </div>
    </div>
</nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            
                            <a class="nav-link" href="../dashboard/">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <hr>
                            <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseKatalog" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Katalog Buku
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div <?php
                                    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                                    $uri_segments = explode('/', $uri_path);

                                    if ($uri_segments[2] == 'katalog') {
                                        echo 'class="collapsed"';
                                    }else{
                                        echo 'class="collapse"';
                                    } ?> id="collapseKatalog" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../katalog/">Semua</a>
                                    <?php
                                    include '../config/koneksi.php';
                                    $sql = "SELECT * FROM kategori";
                                    $result = $mysqli->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ( $row = $result->fetch_assoc() ) { ;?>
                                    <div class="row" >
                                        <div class="col-sm-9" >
                                            <a class="nav-link" href="../katalog?kategori=<?php echo $row["kategori_id"]; ?>"><?php echo $row["nama_kategori"]; ?></a>
                                        </div>
                                        <div class="col-sm-3 d-flex justify-content-end" >
                                            <a class="nav-link" href="../kategori/edit.php?id=<?php echo $row["kategori_id"] ?>" ><i class="fa fa-pencil fa-xs"></i></a>
                                        </div>
                                    </div>
                                    <?php }} ?>
                                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modalAddKategori"><i class="fas fa-plus me-1"></i>Tambah Kategori</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseAktivitas" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Aktivitas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div <?php
                                    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                                    $uri_segments = explode('/', $uri_path);
                                        
                                    if ($uri_segments[2] == 'peminjaman') {
                                        echo 'class="collapsed"';
                                    }else{
                                        echo 'class="collapse"';
                                    } ?> id="collapseAktivitas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php
                                    include '../config/koneksi.php';
                                    $sql = "SELECT count(status) as 'dipinjam'
                                        FROM `peminjaman`
                                        WHERE peminjaman.status='dipinjam'";
                                    $result = $mysqli->query($sql);
                                    $row = $result->fetch_assoc();
                                    ?>
                                    <div class="row" >
                                        <div class="col-md-9" ><a class="nav-link" href="../peminjaman/">Peminjaman</a></div>
                                        <div class="col" ><span class="badge bg-primary"><?php if($row['dipinjam'] > 0){echo $row['dipinjam'];}?></span></div>
                                    </div>
                                    <a class="nav-link" href="../peminjaman/riwayat-peminjaman.php">Riawayat Peminjaman</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseBuku" aria-expanded="false" aria-controls="collapseCash">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Buku
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div <?php
                                    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                                    $uri_segments = explode('/', $uri_path);

                                    if ($uri_segments[2] === 'buku') {
                                        echo 'class="collapsed"';
                                    }else{
                                        echo 'class="collapse"';
                                    } ?> id="collapseBuku" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../buku/">Data Buku</a>
                                    <a class="nav-link" href="../buku/add.php"><i class="fas fa-plus me-1"></i>Tambah</a>
                                </nav>
                            </div>
                            <hr>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLainnya" aria-expanded="false" aria-controls="collapseLainnya">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                User
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div <?php
                                    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                                    $uri_segments = explode('/', $uri_path);

                                    if ($uri_segments[2] === 'jabatan') {
                                        echo 'class="collapsed"';
                                    }else{
                                        echo 'class="collapse"';
                                    } ?> id="collapseLainnya" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStaff" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Staff
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapseStaff" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="../staff/">Lihat data</a>
                                            <a class="nav-link" href="../staff/add.php"><i class="fas fa-plus me-1"></i>Tambah</a>
                                        </nav>
                                    </div>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAnggota" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Anggota
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapseAnggota" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="../anggota/">Lihat data</a>
                                            <a class="nav-link" href="../anggota/add.php"><i class="fas fa-plus me-1"></i>Tambah</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- The Modal -->
            <div class="modal" id="modalLogout">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Logout</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Apakah anda yakin?
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                            <a href="../logout.php" type="button" class="btn btn-danger">Logout</a>
                        </div>

                    </div>
                </div>
            </div>
            <!-- The Modal -->
            <div class="modal" id="modalAddKategori">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Kategori</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="../kategori/" method="POST">
                          <!-- Modal body -->
                          <div class="modal-body">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Masukan nama kategori" name="nama_kategori" required>
                                </div>
                          </div>

                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-success">Tambah</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                          </div>
                          </form>

                    </div>
                </div>
            </div>
            
            <div id="layoutSidenav_content">