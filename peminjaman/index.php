<?php
include '../config/koneksi.php';
$sql = "SELECT peminjaman.peminjaman_id, buku.judul, anggota.nama, peminjaman.tanggal_peminjaman, peminjaman.tanggal_kembali, peminjaman.status FROM `peminjaman` INNER JOIN `buku` ON peminjaman.buku_id=buku.buku_id INNER JOIN `anggota` ON peminjaman.anggota_id=anggota.anggota_id";
$result = $mysqli->query($sql);
echo "<a href='create.php'><button>TAMBAH</button></a>";
if ($result->num_rows > 0) {
 echo "<table border='1'>";
 echo "<tr><th>ID</th><th>Judul</th><th>Nama Peminjam</th><th>Tanggal Peminjaman</th><th>Tanggal Kembali</th><th>Status</th></tr>";
 while ($row = $result->fetch_array()) {
 echo "<tr>";
 echo "<td>".$row["peminjaman_id"]."</td>";
 echo "<td>".$row["judul"]."</td>";
 echo "<td>".$row["nama"]."</td>";
 echo "<td>".$row["tanggal_peminjaman"]."</td>";
 echo "<td>".$row["tanggal_kembali"]."</td>";
 $status = $row["status"];
 echo  "<td>".$status."</td>";
 if ($status=="dipinjam") {
	echo "<td><a href='../pengembalian/create.php?id=".$row["peminjaman_id"]."'>kembalikan</a></td>";
 }
 echo "<td><a href='update.php?id=".$row["peminjaman_id"]."'>Edit</a> | <a
href='delete.php?id=".$row["peminjaman_id"]."'>Hapus</a></td>";
 echo "</tr>";
 }
 echo "</table>";
} else {
 echo "Tidak ada data buku.";
}
$mysqli->close();
?>