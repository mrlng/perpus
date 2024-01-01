<?php
include '../config/koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $ID = $_GET['id'];
      $nama_kategori = $_POST['nama_kategori'];
      $sql = "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE kategori_id='$ID'";

      if ($mysqli->query($sql) === TRUE) {
        session_start();
        $_SESSION['success'] = 'Kategori berhasil diedit';
        header('Location: ../katalog');
            exit;
      } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
      }
      $mysqli->close();
}
include '../header.php';?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Anggota</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-columns me-1"></i>
                                Form Input
                            </div>
                            <div class="card-body">

                            <?php
                            $id = $_GET['id'];
                            $sql = "SELECT * FROM kategori WHERE kategori_id='$id'";
                            $result = $mysqli->query($sql);
                            if ($result->num_rows > 0) {
                                  $row = $result->fetch_array();
                            ?>

                                <form method="POST">
                                    <div class="mb-3 mt-3">
                                        <label for="nama_kategori">Nama Kategori</label>
                                        <input type="text" class="form-control mt-2" value="<?php echo $row['nama_kategori']; ?>" placeholder="Masukan Nama Kategori" name="nama_kategori" required>
                                     </div>
                                    <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Simpan</button>
                                    <a href="delete.php?id=<?php echo $row['kategori_id']; ?>" class="btn btn-danger"><i class="fas fa-trash me-1"></i> Hapus</a>
                                </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </main>
<?php include '../footer.php'; ?>
                              