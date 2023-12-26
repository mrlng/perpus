<?php
include '../config/koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $ID = $_POST['id'];
 $judul = $_POST['judul'];
 $pengarang = $_POST['pengarang'];
 $penerbit = $_POST['penerbit'];
 $tahun_terbit = $_POST['tahun_terbit'];
 $sinopsis = $_POST['sinopsis'];
 $kategori_id = $_POST['kategori_id'];
 $sql = "UPDATE buku SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit', tahun_terbit='$tahun_terbit', sinopsis='$sinopsis', kategori_id='$kategori_id' WHERE buku_id='$ID'";

 if ($mysqli->query($sql) === TRUE) {
 header("Location: ../buku"); // Redirect ke tampilan Read setelah berhasil edit data
 exit;
 } else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
 }
 $mysqli->close();
}
$sql2 = "SELECT * FROM kategori";
$id = $_GET['id']; // ID dari buku yang akan diupdate
$sql = "SELECT * FROM buku WHERE buku_id=$id";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
 $row = $result->fetch_array();
 ?>
 <form action="update.php" method="POST">
 <input type="number" name="id" value="<?php echo $row['buku_id']; ?>"><br>
 Judul: <input type="text" name="judul" value="<?php echo $row['judul']; ?>"><br>
 Pengarang: <input type="text" name="pengarang" value="<?php echo $row['pengarang'];
?>"><br>
 Penerbit: <input type="text" name="penerbit" value="<?php echo $row['penerbit']; ?>"><br>
 Tahun Terbit: <input type="text" name="tahun_terbit" value="<?php echo
$row['tahun_terbit']; ?>"><br>
 Sinopsis: <textarea type="text" name="sinopsis"><?php echo $row['sinopsis'];?></textarea><br>
 
 <?php 
$result = $mysqli->query($sql2);
 
       if ($result->num_rows > 0) { ?>
 Kategori: <select name="kategori_id">
       
              <?php while($row = $result->fetch_array()) {; ?>
              <option value="<?php echo $row['kategori_id']; ?>"><?php echo $row['nama_kategori']; ?></option>
       <?php }?>
 </select>
 <?php }?>
  <input type="submit" value="Update">
 </form>
 <?php
} else {
 echo "Data tidak ditemukan.";
}
$mysqli->close();
?>