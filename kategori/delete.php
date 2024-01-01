<?php
session_start();
include '../config/koneksi.php';
$id = $_GET['id']; // ID dari anggota yang akan dihapus
$sql = "DELETE FROM kategori WHERE kategori_id=$id";
if ($mysqli->query($sql) === TRUE) {
    $_SESSION['success'] = "Kategori berhasil dihapus";
 header("Location: ../katalog");
 exit;
} else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
}
$mysqli->close();
?>