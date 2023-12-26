<?php
include '../config/koneksi.php';
;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT pengembalian.pengembalian_id, peminjaman.peminjaman_id, buku.judul, anggota.nama, pengembalian.tanggal_pengembalian, pengembalian.denda, pengembalian.status_pengembalian FROM `pengembalian` INNER JOIN `peminjaman` ON pengembalian.peminjaman_id=peminjaman.peminjaman_id INNER JOIN `anggota` ON peminjaman.anggota_id=anggota.anggota_id INNER JOIN `buku` ON peminjaman.buku_id=buku.buku_id GROUP BY pengembalian_id HAVING peminjaman_id='$id';";
}else{
    $sql = "SELECT pengembalian.pengembalian_id, peminjaman.peminjaman_id, buku.judul, anggota.nama, pengembalian.tanggal_pengembalian, pengembalian.denda, pengembalian.status_pengembalian FROM `pengembalian` INNER JOIN `peminjaman` ON pengembalian.peminjaman_id=peminjaman.peminjaman_id INNER JOIN `anggota` ON peminjaman.anggota_id=anggota.anggota_id INNER JOIN `buku` ON peminjaman.buku_id=buku.buku_id";
}

$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
 echo "<table border='1'>";
 echo "<tr><th>ID</th><th>Judul Buku</th><th>Nama Peminjam</th><th>Tanggal Kembali</th><th>Denda</th><th>Status</th></tr>";
 while ($row = $result->fetch_array()) {
 echo "<tr>";
 echo "<td>".$row["peminjaman_id"]."</td>";
 echo "<td>".$row["judul"]."</td>";
 echo "<td>".$row["nama"]."</td>";
 echo "<td>".$row["tanggal_pengembalian"]."</td>";
 echo "<td>".$row["denda"]."</td>";
 echo "<td>".$row["status_pengembalian"]."</td>";

 echo "<td><a href='update.php?id=".$row["pengembalian_id"]."'>Edit</a> | <a href='delete.php?id=".$row["pengembalian_id"]."'>Hapus</a></td>";
 echo "</tr>";
 } if (isset($_GET['id'])){
    echo " | <a href='../pengembalian/'><button>tampilkan semua data</button></a>";
 }
 echo "</table>";
} else {
 echo "Tidak ada data buku.";
}
$mysqli->close();
?>