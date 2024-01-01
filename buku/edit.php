<?php
include '../config/koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $ID = $_GET['id'];
      $judul = $_POST['judul'];
      $pengarang = $_POST['pengarang'];
      $penerbit = $_POST['penerbit'];
      $tahun_terbit = $_POST['tahun_terbit'];
      $sinopsis = $_POST['sinopsis'];
      $kategori_id = $_POST['kategori_id'];
      $sql = "UPDATE buku SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit', tahun_terbit='$tahun_terbit', sinopsis='$sinopsis', kategori_id='$kategori_id' WHERE buku_id='$ID'";

      if ($mysqli->query($sql) === TRUE) {
        session_start();
        $_SESSION['success'] = 'Buku berhasil diedit';
        header("Location: ../buku"); // Redirect ke tampilan Read setelah berhasil edit data
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
                            $sql2 = "SELECT * FROM kategori";
                            $id = $_GET['id']; // ID dari buku yang akan diupdate
                            $sql = "SELECT * FROM buku WHERE buku_id='$id'";
                            $result = $mysqli->query($sql);
                            if ($result->num_rows > 0) {
                                  $row = $result->fetch_array();
                            ?>

                                <form method="POST">
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="text" class="form-control" name="id" value="<?php echo $row['buku_id']; ?>" placeholder="ID Anggota" disabled>
                                        <label for="id">ID Buku</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="text" class="form-control" value="<?php echo $row['judul']; ?>" placeholder="Judul" name="judul" required>
                                        <label for="judul">Judul</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="text" class="form-control" value="<?php echo $row['pengarang']; ?>" placeholder="Pengarang" name="pengarang" required>
                                        <label for="pengarang">Pengarang</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="text" class="form-control" value="<?php echo $row['penerbit']; ?>" placeholder="Penerbit" name="penerbit" required>
                                        <label for="penerbit">Penerbit</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="number" class="form-control" value="<?php echo $row['tahun_terbit']; ?>" placeholder="Tahun Terbit" name="tahun_terbit" required>
                                        <label for="no_hp">Tahun Terbit</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <textarea class="form-control" placeholder="Sinopsi" name="sinopsis" required><?php echo $row['sinopsis']; ?></textarea>
                                        <label for="no_hp">Sinopsi</label>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <select type="text" class="form-control" name="kategori_id" required>
                                        <option disabled selected value="">Kategori</option>
                                            <?php 
                                            $sql = "SELECT * FROM kategori";
                                            $result = $mysqli->query($sql);
                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_array()) {;
                                            ?>
                                            <option value="<?php echo $row['kategori_id']; ?>"><?php echo $row['nama_kategori']; ?></option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Simpan</button>
                                </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </main>
<?php include '../footer.php'; ?>
                              