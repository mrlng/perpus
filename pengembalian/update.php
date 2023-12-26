<?php
include '../config/koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $pengembalian_id = $_POST['id'];
 $peminjaman_id = $_POST['peminjaman_id'];
 $tanggal_pengembalian = $_POST['tanggal_pengembalian'];


 $tgl_kemb = $_POST['tanggal_kembali'];
 date_default_timezone_set("Asia/Jakarta");
 
 $tgl1 = strtotime("$tgl_kemb"); 
 $tgl2 = strtotime("$tanggal_pengembalian"); 
 
 $jarak = $tgl2 - $tgl1;
 $hari = $jarak / 60 / 60 / 24;
 
 if ($hari >= 1) {
     $status = "terlambat";
     $denda = $hari * 5000;
 }else{
     $status = "dikembalikan";
     $denda = 0;
 }

 $sql = "UPDATE pengembalian SET peminjaman_id='$peminjaman_id', tanggal_pengembalian='$tanggal_pengembalian', denda='$denda', status_pengembalian='$status' WHERE pengembalian_id='$pengembalian_id'";

 if ($mysqli->query($sql) === TRUE) {
 header("Location: ../pengembalian"); // Redirect ke tampilan Read setelah berhasil edit data
 exit;
 } else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
 }
 $mysqli->close();
}

$id = $_GET['id']; // ID dari buku yang akan diupdate
$sql = "SELECT * FROM pengembalian INNER JOIN peminjaman ON pengembalian.peminjaman_id=peminjaman.peminjaman_id HAVING pengembalian.pengembalian_id=$id";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
 $row = $result->fetch_array();
 ?>
 <form action="update.php" method="POST">
 ID Peminjaman: <input type="text" name="peminjaman_id" value="<?php echo $row['peminjaman_id']; ?>"><br>
 Tanggal Pengembalian: <input type="date" name="tanggal_pengembalian" value="<?php echo $row['tanggal_pengembalian']; ?>"><br>
 <input type="hidden" name="id" value="<?php echo $row['pengembalian_id']; ?>">
 <input type="hidden" name="tanggal_kembali" value="<?php echo $row['tanggal_kembali']; ?>">
 <input type="submit" value="Update">
 </form>
 <?php
} else {
 echo "Data tidak ditemukan.";
}
$mysqli->close();
?>