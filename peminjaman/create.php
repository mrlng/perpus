<?php
include '../config/koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $status = 'dipinjam';
 $buku_id = $_POST['buku_id'];
 $anggota_id = $_POST['anggota_id'];
 $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
 $tanggal_kembali = $_POST['tanggal_kembali'];
 $sql = "INSERT INTO peminjaman (buku_id, anggota_id, tanggal_peminjaman, tanggal_kembali, status) VALUES ('$buku_id',
'$anggota_id', '$tanggal_peminjaman', '$tanggal_kembali', '$status')";

 if ($mysqli->query($sql) === TRUE) {
 header("Location: ../peminjaman");
 exit;
 } else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
 }
 $mysqli->close();
}

 $id = $_GET['id'];
$sql = "SELECT * FROM buku WHERE buku_id=$id";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
 $row = $result->fetch_array();
 ?>
 <form action="create.php" method="POST">
 ID Buku: <input type="text" name="buku_id" value="<?php echo $row['buku_id']; ?>"><br>
 ID Peminjam: <input type="text" name="anggota_id"><br>
 Tanggal Peminjaman: <input type="date" name="tanggal_peminjaman"><br>
 Tanggal Kembali: <input type="date" name="tanggal_kembali"><br>
 <input type="submit" value="Update">
 </form>
 <?php
} else {
 echo "Data tidak ditemukan.";
}
$mysqli->close();
?>