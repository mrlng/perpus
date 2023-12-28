<?php
require '../header.php';
?>
<main>
	<div class="container-fluid px-4">
		<h1 class="mt-4">Data Peminjaman</h1>
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
							<th>Judul</th>
							<th>Nama Peminjam</th>
							<th>Tanggal Peminjaman</th>
							<th>Tanggal Kembali</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include '../config/koneksi.php';
						$sql = "SELECT peminjaman.peminjaman_id, buku.judul, anggota.nama, peminjaman.tanggal_peminjaman, peminjaman.tanggal_kembali, peminjaman.status 
							FROM `peminjaman` 
							INNER JOIN `buku` ON peminjaman.buku_id=buku.buku_id 
							INNER JOIN `anggota` ON peminjaman.anggota_id=anggota.anggota_id";
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
										<?php echo $row["tanggal_peminjaman"]; ?>
									</td>
									<td>
										<?php echo $row["tanggal_kembali"]; ?>
									</td>
									<td>
										<?php echo $row["status"]; ?>
									</td>
									<td>
										<?php
										$status = $row["status"];
										if ($status == "dipinjam") {
											?>
											<div class="btn-group">
												<a href="../peminjaman/pengembalian.php?id=<?php echo $row["peminjaman_id"]; ?>">
													<button type="button" class="btn btn-primary btn-sm">kembalikan</button>
												</a>
											<?php } ?>
											<a href="delete.php?id=<?php echo $row['peminjaman_id']; ?>">
												<button type="button" class="btn btn-danger btn-sm">
													<i class="fas fa-trash me-1"></i>
												</button>
											</a>
										</div>
									</td>
								</tr>
							<?php }
						} ?>
				</table>
				</div>
        </div>
    </div>
</main>
				<?php
				require '../footer.php';
				?>