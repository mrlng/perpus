<?php
require '../header.php';
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Anggota</h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Tabel
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../config/koneksi.php';
                        $sql = "SELECT * FROM anggota";
                        $result = $mysqli->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row["anggota_id"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["nama"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["alamat"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["email"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["telepon"]; ?>
                                </td>
                                <td class="align-items-center">
                                    <div class="btn-group">
                                        <a href="edit.php?id=<?php echo $row['anggota_id']; ?>"><button type="button"
                                                class="btn btn-outline-success btn-sm"><i class="fas fa-edit me-1"></i></button></a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="delete.php?id=<?php echo $row['anggota_id']; ?>"><button type="button"
                                                class="btn btn-outline-danger btn-sm"><i class="fas fa-trash me-1"></i></button></a>
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