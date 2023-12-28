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
 header("Location: ../katalog");
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
 require '../header.php';
 ?>
 
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Buat Peminaman</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-columns me-1"></i>
                                Form Input
                            </div>
                            <div class="card-body">
                                <form method="POST">
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="text" class="form-control" placeholder="ID Buku" name="buku_id" value="<?php echo $row['buku_id']; ?>" readonly>
                                        <label for="id">ID Buku</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="text" class="form-control" placeholder="ID Peminajm" name="anggota_id" required>
                                        <label for="nama_customer">ID Peminjam</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="date" class="form-control" placeholder="Tanggal Peminjaman" name="tanggal_peminjaman" required>
                                        <label for="pengarang">Tanggal Peminjaman</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="date" class="form-control" placeholder="Tanggal Kembali" name="tanggal_kembali" required>
                                        <label for="penerbit">Tanggal Kembali</label>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
 
 <?php
} 
require '../footer.php';
$mysqli->close();
?>