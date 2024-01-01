<?php
include '../config/koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $buku_id = $_GET['id'];
 $katalog_id = $_POST['katalog_id'];
 $anggota_id = $_POST['anggota_id'];
 $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
 $tanggal_kembali = $_POST['tanggal_kembali'];
 $sql = "INSERT INTO peminjaman (buku_id, katalog_id, anggota_id, tanggal_peminjaman, tanggal_kembali, status) VALUES ('$buku_id', '$katalog_id',
'$anggota_id', '$tanggal_peminjaman', '$tanggal_kembali', 'dipinjam')";

 if ($mysqli->query($sql) === TRUE) {
    $sql = "DELETE FROM katalog WHERE katalog_id='$katalog_id'";
    if ($mysqli->query($sql) === TRUE) {
        session_start();
        $_SESSION['success'] = 'Buku berhasil dipinjam. Lihat <a href="../peminjaman/" class="alert-link">daftar pinjaman</a>';
        header("Location: ../katalog/");
        exit;
    }
 } else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
 }
 $mysqli->close();
}
require '../header.php';
?>

 
                <main>
                    <div class="container-fluid px-4">
                        <div class="card mb-4 mt-4">
                            <div class="card-body mb-4" >
                                <?php
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM buku WHERE buku_id='$id'";
                                $result = $mysqli->query($sql);
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_array();
                                ?>
                                <div class="row">
                                    <div class="col" >
                                        <h1 class=""><?php echo $row['judul'];?> <small>(<?php echo $row['tahun_terbit'];?>)</small></h1>
                                        Penulis : <b><?php echo $row['pengarang'];?> </b> - Penerbit : <b><?php echo $row['penerbit'];?></b>
                                    </div>
                                    <div class="col d-inline-flex justify-content-end" >
                                        <div class="p-2" >
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPinjam">
                                            Pinjam Buku Ini
                                        </button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <p>
                                    <div class="row" >
                                        <div class="col-sm" >
                                            Sinopsis :
                                        </div>
                                        <div class="col-sm-11" >
                                            <?php echo $row['sinopsis'];?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- The Modal -->
                    <div class="modal" id="modalPinjam">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Pinjam Buku</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <form method="POST">
                          <!-- Modal body -->
                          <div class="modal-body">
                            
                                <div class="mb-3 mt-3">
                                    <label for="kategori_id">ID Katalog</label>
                                    <select class="form-select" name="katalog_id" required>
                                    <option disabled selected value=""></option>
                                        <?php 
                                        $id_buku = $_GET['id'];
                                        $sql = "SELECT * FROM katalog WHERE buku_id='$id_buku'";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_array()) {;
                                        ?>
                                        <option value="<?php echo $row['katalog_id']; ?>"><?php echo $row['katalog_id']; ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="anggota_id">Peminjam</label>
                                    <select class="form-select" name="anggota_id" required>
                                    <option disabled selected value=""></option>
                                        <?php 
                                        $sql = "SELECT * FROM anggota";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_array()) {;
                                        ?>
                                        <option value="<?php echo $row['anggota_id']; ?>"><?php echo $row['nama']; ?> - <?php echo $row['anggota_id']; ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                                    <input type="date" class="form-control" placeholder="Tanggal Peminjaman" name="tanggal_peminjaman" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_kembali">Tanggal Kembali</label>
                                    <input type="date" class="form-control" placeholder="Tanggal Kembali" name="tanggal_kembali" required>
                                </div>
                          </div>

                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-success">Pinjam</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>

                </main>
                
 
 <?php
require '../footer.php';
$mysqli->close();
?>