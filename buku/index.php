<?php
require '../header.php';
?>

<main>
    <div class="container-fluid px-4">
    <?php 
    if (isset($_SESSION['success'])) { ?>
    <div class='alert alert-success alert-dismissible mt-4'>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        <strong>Success!</strong> <?php echo $_SESSION['success']?>.
     </div>
    <?php
    unset($_SESSION['success']);
    }?>
        <h1 class="mt-4">Data Buku</h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Tabel
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID Buku</th>
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Tahun Terbit</th>
                            <th>kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../config/koneksi.php';
                        $sql = "SELECT buku.*, kategori.* FROM buku LEFT JOIN kategori ON buku.kategori_id=kategori.kategori_id";
                        $result = $mysqli->query($sql);
                        if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row["buku_id"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["judul"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["pengarang"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["tahun_terbit"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["nama_kategori"]; ?>
                                </td>
                                <td class="align-items-center">
                                    <div class="btn-group">
                                        <a href="edit.php?id=<?php echo $row['buku_id']; ?>"><button type="button"
                                                class="btn btn-success btn-sm"><i class="fas fa-edit me-1"></i></button></a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="delete.php?id=<?php echo $row['buku_id']; ?>"><button type="button"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash me-1"></i></button></a>
                                    </div>
                                </td>
                            </tr>
                        <?php }}
                        $mysqli->close(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php
require '../footer.php';
?>