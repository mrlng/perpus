<?php
   include '../config/koneksi.php';
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = 'B-'.$_POST['kategori_id'].$_POST['buku_id'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $sinopsis = $_POST['sinopsis'];
    $kategori_id = $_POST['kategori_id'];
    $sql = "INSERT INTO buku (buku_id, judul, pengarang, penerbit, tahun_terbit, sinopsis, kategori_id) 
           VALUES ('$id', '$judul', '$pengarang', '$penerbit', '$tahun_terbit', '$sinopsis', '$kategori_id')";
    $qty = (int)$_POST["jumlah"];
    if ($mysqli->query($sql) === TRUE) {
        for ($i = 0; $i < $qty; $i++) {
            $sql2 = "INSERT INTO katalog (katalog_id, buku_id) VALUES ('$id$i', '$id')";
            $mysqli->query($sql2); }
        session_start();
        $_SESSION['success'] = 'Buku berhasil ditambah';
        header("Location: ../buku");
        exit;
    } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $mysqli->close();
   }
   
 require '../header.php';
?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tambah Anggota</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-columns me-1"></i>
                                Form Input
                            </div>
                            <div class="card-body">
                                <form method="POST">
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="text" class="form-control" placeholder="ID Buku" name="buku_id">
                                        <label for="buku_id">ID Buku</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="text" class="form-control" placeholder="Judul" name="judul">
                                        <label for="judul">Judul</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <textarea type="text" class="form-control" placeholder="Pengarang" name="pengarang"></textarea>
                                        <label for="pengarang">Pengarang</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="text" class="form-control" placeholder="Penerbit" name="penerbit">
                                        <label for="penerbit">Penerbit</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="number" class="form-control" placeholder="Tahun Terbit" name="tahun_terbit">
                                        <label for="tahun_terbit">Tahun Terbit</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <textarea type="text" class="form-control" placeholder="Sinopsis" name="sinopsis"></textarea>
                                        <label for="sinopsis">Sinopsis</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="number" class="form-control" placeholder="Jumlah" name="jumlah">
                                        <label for="nama_customer">Jumlah</label>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <select type="text" class="form-control" name="kategori_id">
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
                            </div>
                        </div>
                    </div>
                </main>
<?php
    require '../footer.php';
?>
