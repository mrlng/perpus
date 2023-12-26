<?php
   session_start();
   require '../config.php';
   if(isset($_POST['submit'])) {
    $insertOneResult = $collection_anggota->insertOne([
       'id_anggota' => 'PPK'.$_POST['id'],
        'nama_lengkap' => $_POST['nama_lengkap'],
        'alamat' => $_POST['alamat'],
        'telepon' => $_POST['telepon'],
        'id_jabatan' => $_POST['id_jabatan']
    ]);

    $_SESSION['success'] = "Data Berhasil Ditambahkan";
    header("Location: ../anggota/");
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
                                        <input type="text" class="form-control" placeholder="ID Anggota" name="id">
                                        <label for="id">ID Anggota</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama_lengkap">
                                        <label for="nama_customer">Nama Lenkap</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <textarea type="text" class="form-control" placeholder="Alamat" name="alamat"></textarea>
                                        <label for="no_hp">Alamat</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="number" class="form-control" placeholder="No HP" name="telepon">
                                        <label for="no_hp">No HP</label>
                                    </div>
                                    <div class=" mb-3 mt-3">
                                        <select class="form-control" placeholder="Jabatan" name="id_jabatan">
                                            <option disabled selected value="">--- Jabatan ----</option>
                                            <?php 
                                                $jabatan = $collection_jabatan->find([]);
                                                foreach($jabatan as $row) {
                                            ?>
                                            <option value="<?php echo $row->id_jabatan; ?>"><?php echo $row->nama_jabatan; ?></option>
                                            <?php } ?>
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
