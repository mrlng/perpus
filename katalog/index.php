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
                     <th>Penerbit</th>
                     <th>Tahun Terbit</th>
                     <th>kategori</th>
                     <th>Jumlah</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  include '../config/koneksi.php';
                  
                  $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                  $uri_segments = explode('/', $uri_path);
                  
                  if (!isset($_GET['kategori'])) {
                     $sql = "SELECT count('katalog.buku_id') as 'qty', katalog.*, buku.*, kategori.* FROM katalog 
                        LEFT JOIN buku ON katalog.buku_id=buku.buku_id 
                        LEFT JOIN kategori ON buku.kategori_id=kategori.kategori_id
                        GROUP BY katalog.buku_id"
                        ;
                  } else {

                     $kategori_id = $_GET['kategori'];
                     $sql = "SELECT count('katalog.buku_id') as 'qty', katalog.*, buku.*, kategori.* FROM katalog 
                        LEFT JOIN buku ON katalog.buku_id=buku.buku_id 
                        LEFT JOIN kategori ON buku.kategori_id=kategori.kategori_id
                        WHERE buku.kategori_id='$kategori_id'
                        GROUP BY katalog.buku_id";

                     
                  }
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
                              <?php echo $row["qty"]; ?>
                           </td>
                           <td>
                              <a href="../katalog/detail.php?id=<?php echo $row["buku_id"]; ?>">
                                 <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>
                              </a>
                           </td>
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