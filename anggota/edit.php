<?php
   include '../config/koneksi.php';
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $ID = $_GET['id'];
       $nama = $_POST['nama'];
       $alamat = $_POST['alamat'];
       $email = $_POST['email'];
       $telepon = $_POST['telepon'];
       $sql = "UPDATE anggota SET nama='$nama', alamat='$alamat', email='$email', telepon='$telepon' WHERE anggota_id='$ID'";
   
       if ($mysqli->query($sql) === TRUE) {
           header("Location: ../anggota");
           exit;
       } else {
           echo "Error: " . $sql . "<br>" . $mysqli->error;
       }
       $mysqli->close();
   }
   
   $id = $_GET['id'];
   $sql = "SELECT * FROM anggota WHERE anggota_id=$id";
   $result = $mysqli->query($sql);
   if ($result->num_rows > 0) {
       $row = $result->fetch_array();
   include '../header.php'
?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Anggota</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-columns me-1"></i>
                                Form Input
                            </div>
                            <div class="card-body">
                                <form method="POST">
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="text" class="form-control" value="<?php echo $row['anggota_id']; ?>" placeholder="ID Anggota" name="id" disabled>
                                        <label for="id">ID Anggota</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="text" class="form-control" value="<?php echo $row['nama']; ?>" placeholder="Nama" name="nama">
                                        <label for="nama">Nama</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <textarea type="text" class="form-control" placeholder="Alamat" name="alamat"><?php echo $row['alamat']; ?></textarea>
                                        <label for="no_hp">Alamat</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="email" class="form-control" value="<?php echo $row['email']; ?>" placeholder="Email" name="email">
                                        <label for="no_hp">Email</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="number" class="form-control" value="<?php echo $row['telepon']; ?>" placeholder="No HP" name="telepon">
                                        <label for="no_hp">Telepon</label>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
<?php
   }
   include '../footer.php';
?>
