<?php
require '../header.php';
?>
<main>
    <div class="container-fluid px-4">
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
                            <th>ID Peminjaman</th>
                            <th>Judul</th>
                            <th>Nama Peminjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Denda</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../config/koneksi.php';
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $sql = "SELECT pengembalian.pengembalian_id, peminjaman.peminjaman_id, buku.judul, anggota.nama, pengembalian.tanggal_pengembalian, pengembalian.denda, pengembalian.status_pengembalian FROM `pengembalian` INNER JOIN `peminjaman` ON pengembalian.peminjaman_id=peminjaman.peminjaman_id INNER JOIN `anggota` ON peminjaman.anggota_id=anggota.anggota_id INNER JOIN `buku` ON peminjaman.buku_id=buku.buku_id GROUP BY pengembalian_id HAVING peminjaman_id='$id';";
                        } else {
                            $sql = "SELECT pengembalian.pengembalian_id, peminjaman.peminjaman_id, buku.judul, anggota.nama, pengembalian.tanggal_pengembalian, pengembalian.denda, pengembalian.status_pengembalian FROM `pengembalian` INNER JOIN `peminjaman` ON pengembalian.peminjaman_id=peminjaman.peminjaman_id INNER JOIN `anggota` ON peminjaman.anggota_id=anggota.anggota_id INNER JOIN `buku` ON peminjaman.buku_id=buku.buku_id";
                        }
                        $result = $mysqli->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_array()) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $row["peminjaman_id"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["judul"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["nama"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["tanggal_pengembalian"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["denda"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["status_pengembalian"]; ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                </table>
                </div>
        </div>
    </div>
</main>
                <?php
                require '../footer.php';
                ?>