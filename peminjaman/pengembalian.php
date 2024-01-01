<?php
include '../config/koneksi.php';
$peminjaman_id = $_GET['id'];
$sql = "UPDATE peminjaman SET status='kembali' WHERE peminjaman_id='$peminjaman_id'";
$result = $mysqli->query("SELECT peminjaman.*, buku.kategori_id FROM peminjaman 
INNER JOIN buku ON peminjaman.buku_id=buku.buku_id
WHERE peminjaman_id='$peminjaman_id'");
$row = $result->fetch_assoc();
$tgl_kemb = $row['tanggal_kembali'];
$peminjaman_id = $row['peminjaman_id'];
$katalog_id = $row['katalog_id'];
$buku_id = $row['buku_id'];
$kategori_id = $row['kategori_id'];
date_default_timezone_set("Asia/Jakarta");
$date_now = date("Y-m-d");

$tgl1 = strtotime("$tgl_kemb"); 
$tgl2 = strtotime("$date_now"); 

$jarak = $tgl2 - $tgl1;
$hari = $jarak / 60 / 60 / 24;

if ($hari >= 1) {
    $status = "terlambat";
    $denda = $hari * 5000;
}else{
    $status = "dikembalikan";
    $denda = 0;
}

if ($mysqli->query($sql) === TRUE) {
    $sql = "INSERT INTO pengembalian (peminjaman_id, tanggal_pengembalian, denda, status_pengembalian) VALUES ('$peminjaman_id', '$date_now', '$denda', '$status')";
    if ($mysqli->query($sql) === TRUE) {
        
        $sql = "INSERT INTO katalog (katalog_id, buku_id) VALUES ('$katalog_id', '$buku_id')";
        if  ($mysqli->query($sql) === TRUE) {
            session_start();
            $_SESSION['success'] = 'Buku berhasil dikembalikan';
            header("Location: ../peminjaman/");
            exit;
        }



        
} else {
echo "Error: " . $sql . "<br>" . $mysqli->error;
}}
$mysqli->close();