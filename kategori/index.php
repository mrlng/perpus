<?php
session_start();
include '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kategori = $_POST['nama_kategori'];
    $sql = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";
   
    if ($mysqli->query($sql) === TRUE) {
        $_SESSION['success'] = "Kategori berhasil ditambahkan";
        header('Location: ../katalog/');
        exit;
    } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $mysqli->close();
   }
?>