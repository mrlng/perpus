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
        <title>PPKJ</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../bootstrap/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">PPKJ</a>
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
                        <li><a class="dropdown-item" href="../logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
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
                            <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseAnggota" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Anggota
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div <?php
                                    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                                    $uri_segments = explode('/', $uri_path);

                                    if ($uri_segments[2] == 'anggota') {
                                        echo 'class="collapsed"';
                                    }else{
                                        echo 'class="collapse"';
                                    } ?> id="collapseAnggota" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../anggota/">Data Anggota</a>
                                    <a class="nav-link" href="../anggota/add.php"><i class="fas fa-plus me-1"></i>Tambah</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseCash" aria-expanded="false" aria-controls="collapseCash">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Cash
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div <?php
                                    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                                    $uri_segments = explode('/', $uri_path);

                                    if ($uri_segments[2] === 'cash') {
                                        echo 'class="collapsed"';
                                    }else{
                                        echo 'class="collapse"';
                                    } ?> id="collapseCash" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../cash/">Data Cash</a>
                                    <a class="nav-link" href="../cash/add.php"><i class="fas fa-plus me-1"></i>Tambah</a>
                                </nav>
                            </div>
                            <hr>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLainnya" aria-expanded="false" aria-controls="collapseLainnya">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Lainnya
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
                                    <a class="nav-link" href="../jabatan/">Jabatan</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">