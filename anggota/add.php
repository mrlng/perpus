<?php
   include '../config/koneksi.php';
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $nama = $_POST['nama'];
       $alamat = $_POST['alamat'];
       $email = $_POST['email'];
       $telepon = $_POST['telepon'];
       $sql = "INSERT INTO anggota (nama, alamat, email, telepon) VALUES ('$anggota_id, $nama', '$alamat', '$email', '$telepon')";
   
       if ($mysqli->query($sql) === TRUE) {
           header("Location: ../anggota");
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
                        <h1 class="mt-4">Tambah Anggot</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-columns me-1"></i>
                                Form Input
                            </div>
                            <div class="card-body">
                                <form method="POST">
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama">
                                        <label for="nama_customer">Nama</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <textarea type="text" class="form-control" placeholder="Alamat" name="alamat"></textarea>
                                        <label for="no_hp">Alamat</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="text" class="form-control" placeholder="No HP" name="email">
                                        <label for="no_hp">Email</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="number" class="form-control" placeholder="No HP" name="telepon">
                                        <label for="no_hp">Telepon</label>
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
