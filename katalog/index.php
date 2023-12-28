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
                     <th>ID Buku</th>
                     <th>Judul</th>
                     <th>Pengarang</th>
                     <th>Penerbit</th>
                     <th>Tahun Terbit</th>
                     <th>kategori</th>
                     <th>Status</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  include '../config/koneksi.php';
                  $sql = "SELECT katalog.*, buku.*, kategori.*, peminjaman.status FROM katalog 
                     LEFT JOIN buku ON katalog.buku_id=buku.buku_id 
                     LEFT JOIN kategori ON katalog.kategori_id=kategori.kategori_id 
                     LEFT JOIN peminjaman ON buku.buku_id=peminjaman.buku_id";
                  $result = $mysqli->query($sql);
                  if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) { ?>
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
                              <?php echo $row["penerbit"]; ?>
                           </td>
                           <td>
                              <?php echo $row["tahun_terbit"]; ?>
                           </td>
                           <td>
                              <?php echo $row["nama_kategori"]; ?>
                           </td>
                           <td>
                              <?php
                              if ($row["status"] == "") {
                                 echo "Ready";
                              } else {
                                 echo $row["status"];
                              } ?>
                           </td>
                           <td>
                              <a href="detail.php?id=<?php echo $row["buku_id"]; ?>">
                                 <button type="button" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-eye"></i>
                                 </button>
                              </a>
                           <?php
                           if ($row["status"] == "dipinjam") { ?>
                                 <button type="button" class="btn btn-secondary btn-sm" disabled>Dipinjam</button>
                              </td>
                           <?php
                           } else { ?>
                                    <a href="../katalog/pinjam.php?id=<?php echo $row["buku_id"]; ?>">
                                    <button type="button" class="btn btn-primary btn-sm">Pinjam</button>
                                 </a>
                              </td>
                           <?php } ?>
                        </tr>
                     <?php }
                  } ?>
            </table>
            </div>
        </div>
    </div>
</main>
            <!-- The Modal -->
            <div class="modal" id="myModal">
               <div class="modal-dialog">
                  <div class="modal-content">

                     <!-- Modal Header -->
                     <div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                     </div>

                     <!-- Modal body -->
                     <div class="modal-body">
                        Modal body..
                     </div>

                     <!-- Modal footer -->
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                     </div>

                  </div>
               </div>
            </div>
            <?php
            require '../footer.php';
            ?>