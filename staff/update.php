<?php
include '../config/koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $ID = $_POST['id'];
 $nama = $_POST['nama'];
 $jabatan = $_POST['jabatan'];
 $email = $_POST['email'];
 $telepon = $_POST['telepon'];
 $sql = "UPDATE staff SET nama='$nama', jabatan='$jabatan', email='$email', telepon='$telepon' WHERE staff_id='$ID'";

 if ($mysqli->query($sql) === TRUE) {
 header("Location: ../staff"); 
 exit;
 } else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
 }
 $mysqli->close();
}

$id = $_GET['id'];
$sql = "SELECT * FROM staff WHERE staff_id=$id";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
 $row = $result->fetch_array();
 ?>
 <form action="update.php" method="POST">
 Nama: <input type="text" name="nama" value="<?php echo $row['nama']; ?>"><br>
 Jabatan: <input type="text" name="jabatan" value="<?php echo $row['jabatan'];
?>"><br>
 Emai;: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
 Telepon: <input type="text" name="telepon" value="<?php echo
$row['telepon']; ?>"><br>
 <input type="hidden" name="id" value="<?php echo $row['staff_id']; ?>">
 <input type="submit" value="Update">
 </form>
 <?php
} else {
 echo "Data tidak ditemukan.";
}
$mysqli->close();
?>