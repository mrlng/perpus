<?php
include '../config/koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $nama = $_POST['nama'];
 $jabatan = $_POST['jabatan'];
 $email = $_POST['email'];
 $telepon = $_POST['telepon'];
 $sql = "INSERT INTO staff (nama, jabatan, email, telepon) VALUES ('$nama',
'$jabatan', '$email', '$telepon')";

 if ($mysqli->query($sql) === TRUE) {
 header("Location: ../staff"); // Redirect ke tampilan Read setelah berhasil tambah data
 exit;
 } else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
 }
 $mysqli->close();
}
?>
<form action="create.php" method="POST">
 Nama: <input type="text" name="nama"><br>
 Jabtan: <input type="text" name="jabatan"><br>
 Email: <input type="text" name="email"><br>
 Telepon: <input type="text" name="telepon"><br>
 <input type="submit" value="Tambah">
</form>