<?php
require '../header.php';
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detail Buku</h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-info me-1"></i>
                Detail Data
            </div>
            <div class="card-body">

                <?php
                include '../config/koneksi.php';
                $id = $_GET['id']; // ID dari buku yang akan diupdate
                $sql = "SELECT katalog.*, buku.*, kategori.* FROM katalog INNER JOIN kategori ON katalog.kategori_id=kategori.kategori_id INNER JOIN buku ON buku.buku_id=buku.buku_id HAVING katalog.buku_id='$id'";
                $result = $mysqli->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_array();
                    ?>

                    <ul class="list-group">
                        <li class="list-group-item">Judul : <?php echo $row['judul']; ?></li>
                        <li class="list-group-item">Pengarang : <?php echo $row['pengarang']; ?></li>
                        <li class="list-group-item">Penerbit : <?php echo $row['penerbit']; ?></li>
                        <li class="list-group-item">Tahun Terbit : <?php echo $row['tahun_terbit']; ?></li>
                        <li class="list-group-item">ID Buku : <?php echo $row['buku_id']; ?></li>
                        <li class="list-group-item">Sinopsis : <?php echo $row['sinopsis']; ?></li>
                        <li class="list-group-item">Kategori : <?php echo $row['nama_kategori']; ?></li>
                    </ul>
                    </div>
        </div>
    </div>
</main>
                    <?php
                } 
                $mysqli->close();
                ?>

                <?php
                require '../footer.php';
                ?>