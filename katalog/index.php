<?php
include '../config/koneksi.php';
$sql = "SELECT katalog.*, buku.*, kategori.*, peminjaman.status FROM katalog 
LEFT JOIN buku ON katalog.buku_id=buku.buku_id 
LEFT JOIN kategori ON katalog.kategori_id=kategori.kategori_id 
LEFT JOIN peminjaman ON buku.buku_id=peminjaman.buku_id";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
 echo "<table border='1'>";
 echo "<tr><th>ID Katalog</th><th>ID Buku</th><th>Judul</th><th>Pengarang</th><th>Penerbit</th><th>Tahun Terbit</th><th>Nama Kategori</th><th>Status</th</tr>";
 while ($row = $result->fetch_assoc()) {
 echo "<tr>";
 echo "<td>".$row["katalog_id"]."</td>";
 echo "<td>".$row["buku_id"]."</td>";
 echo "<td>".$row["judul"]."</td>";
 echo "<td>".$row["pengarang"]."</td>";
 echo "<td>".$row["penerbit"]."</td>";
 echo "<td>".$row["tahun_terbit"]."</td>";
 echo "<td>".$row["nama_kategori"]."</td>";
 if ($row["status"] == "") {
    echo "<td>Ready</td>";}else{echo "<td>".$row["status"]."</td>";}
 echo "<td><td><a href='detail.php?id=".$row["buku_id"]."'>Detail</a></td>";
 if ($row["status"] == "dipinjam") {

 }else{echo "<td><a href='../peminjaman/create.php?id=".$row["buku_id"]."'>Pinjam</a></td>";}
 echo "</tr>";
 }
 echo "</table>";
} else {
 echo "Tidak ada data katalog.";
}
$mysqli->close();
?>