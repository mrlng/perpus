<?php
include '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kategori = $_POST['nama_kategori'];
    $sql = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";
   
    if ($mysqli->query($sql) === TRUE) {
    header("Location: ../kategori"); // Redirect ke tampilan Read setelah berhasil tambah data
    exit;
    } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $mysqli->close();
   }

$sql = "SELECT * FROM kategori";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
 echo "<table border='1'>";
 echo "<tr><th>ID</th><th>Nama Kategori</th></tr>";
 while ($row = $result->fetch_assoc()) {
 echo "<tr>";
 echo "<td>".$row["kategori_id"]."</td>";
 echo "<td>".$row["nama_kategori"]."</td>";
 echo "<td><a href='update.php?id=".$row["kategori_id"]."'>Edit</a> | <a
href='delete.php?id=".$row["kategori_id"]."'>Hapus</a></td>";
 echo "</tr>";
 }
 echo "<tr>";
 echo "<td colspan=3><form action='../kategori/' method='POST'><input type='text' name='nama_kategori' placeholder='tambah kategori'><input type='submit' value='Tambah'></form></td>";
 echo "</tr>";
 echo "</table>";
} else {
 echo "Tidak ada data anggota.";
}
$mysqli->close();
?>