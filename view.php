<?php
require 'ceklogin.php';

if (isset($_GET['idp'])) {
   $idp = $_GET['idp'];
   $ambilnamapelanggan = mysqli_query($c, "SELECT * FROM pesanan p, pelanggan pl WHERE p.idpelanggan=pl.idpelanggan AND p.idpesanan='$idp'");
   $np = mysqli_fetch_array($ambilnamapelanggan);
   $namapel = $np['namapelanggan'];
} else {
   header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1.0" name="viewport">

   <title>Detail Pesanan</title>
   <meta content="" name="description">
   <meta content="" name="keywords">

   <!-- Favicons -->
   <link href="assets/img/favicon.png" rel="icon">
   <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

   <!-- Google Fonts -->
   <link href="https://fonts.gstatic.com" rel="preconnect">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

   <!-- Vendor CSS Files -->
   <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
   <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
   <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
   <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
   <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
   <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

   <!-- Template Main CSS File -->
   <link href="assets/css/style.css" rel="stylesheet">

   <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Aug 30 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

   <!-- ======= Header ======= -->
   <header id="header" class="header fixed-top d-flex align-items-center">

      <div class="d-flex align-items-center justify-content-between">
         <a href="index.html" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">System Kasir</span>
         </a>
         <i class="bi bi-list toggle-sidebar-btn"></i>
      </div><!-- End Logo -->



   </header><!-- End Header -->

   <!-- ======= Sidebar ======= -->
   <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
            <a class="nav-link " href="index.php">
               <i class="bi bi-grid"></i>
               <span>Pesanan</span>
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link " href="stock.php">
               <i class="bi bi-grid"></i>
               <span>Stok Barang</span>
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link " href="masuk.php">
               <i class="bi bi-grid"></i>
               <span>Barang Masuk</span>
            </a>
         </li>
         <li class="nav-item mb-5">
            <a class="nav-link " href="pelanggan.php">
               <i class="bi bi-grid"></i>
               <span>Kelola Pelanggan</span>
            </a>
         </li>
         <li class="nav-item mt-5">
            <a class="nav-link " href="logout.php">
               <i class="bi bi-grid"></i>
               <span>Log Out</span>
            </a>
         </li>



      </ul>

   </aside><!-- End Sidebar-->

   <main id="main" class="main">

      <div class="pagetitle">
         <h1>System Kasir</h1>
      </div><!-- End Page Title -->


      <section class="section">
         <div class="row">
            <div class="col-lg-12">

               <div class="card">
                  <div class="card-body">
                     <h5 class="card-title">Detail Pesanan</h5>
                     <button type="button" class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Produk Pesanan
                     </button>
                     <button disabled="disabled" class="btn btn-secondary mb-3">Pesanan : <?= $idp; ?> -
                        <?= $namapel; ?>
                     </button>

                     <!-- Table with stripped rows -->
                     <table class="table datatable">
                        <thead>
                           <tr>
                              <th scope="col">No</th>
                              <th scope="col">Nama Produk</th>
                              <th scope="col">Harga Satuan</th>
                              <th scope="col">Jumlah</th>
                              <th scope="col">Sub-Total</th>
                              <th scope="col">Aksi</th>
                           </tr>
                        </thead>
                        <tbody>

                           <?php
                           $i = 1;
                           $ambildata = mysqli_query($c, "SELECT * FROM detailpesanan p, produk pr WHERE p.idproduk = pr.idproduk AND idpesanan='$idp'");
                           while ($baris = mysqli_fetch_array($ambildata)) {
                              $idpr = $baris['idproduk'];
                              $iddp = $baris['iddetailpesanan'];
                              $namabarang = $baris['namabarang'];
                              $harga = $baris['harga'];
                              $qty = $baris['qty'];
                              $subtotal = $qty * $harga

                           ?>
                              <tr>
                                 <td><?= $i; ?></td>
                                 <td><?= $namabarang; ?></td>
                                 <td>Rp. <?= number_format($harga); ?></td>
                                 <td><?= number_format($qty); ?></td>
                                 <td>Rp. <?= number_format($subtotal); ?></td>
                                 <td>
                                    <!-- Button trigger modal Ubah -->
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal1<?= $idpr; ?>">
                                       Ubah
                                    </button>
                                    <!-- Button trigger modal Hapus -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal2<?= $idpr; ?>">
                                       Hapus
                                    </button>
                                 </td>
                              </tr>

                              <!-- Modal Ubah-->
                              <div class="modal fade" id="exampleModal1<?= $idpr; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Produk Pesanan</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <form method="post">
                                          <div class="modal-body">
                                             <input type="hidden" name="iddp" value="<?= $iddp; ?>">
                                             <input type="hidden" name="idpr" value="<?= $idpr; ?>">
                                             <input type="hidden" name="idp" value="<?= $idp; ?>">
                                             <div class="form-floating mt-2">
                                                <input type="text" class="form-control" name="namabarang" id="floatingInput" value="<?= $namabarang; ?>" disabled>
                                                <label for="floatingInput">Nama Barang Pesanan</label>
                                             </div>
                                             <div class="form-floating mt-2">
                                                <input type="number" class="form-control" name="qty" id="floatingInput" placeholder="Jumlah" value="<?= $qty; ?>">
                                                <label for="floatingInput">Jumlah</label>
                                             </div>

                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                             <button type="submit" name="ubahdetailpesanan" class="btn btn-warning">Ubah</button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>

                              <!-- Modal Hapus-->
                              <div class="modal fade" id="exampleModal2<?= $idpr; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <form method="post">
                                          <div class="modal-body">
                                             <input type="hidden" name="idp" value="<?= $iddp; ?>">
                                             <input type="hidden" name="idpr" value="<?= $idpr; ?>">
                                             <input type="hidden" name="idorder" value="<?= $idp; ?>">
                                             <h2 class="text-center">Apakah kamu yakin ingin menghapus <br>
                                                <strong><?= $namabarang; ?></strong> ??
                                             </h2>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                             <button type="submit" name="hapusprodukpesanan" class="btn btn-danger">Hapus</button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>


                           <?php
                              $i++;
                           }
                           ?>

                        </tbody>
                     </table>
                     <!-- End Table with stripped rows -->

                  </div>
               </div>

            </div>
         </div>
      </section>



   </main><!-- End #main -->

   <!-- ======= Footer ======= -->
   <footer id="footer" class="footer ">
      <div class="copyright">
         &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved

      </div>
      <div class="credits">
         <!-- All the links in the footer should remain intact. -->
         <!-- You can delete the links only if you purchased the pro version. -->
         <!-- Licensing information: https://bootstrapmade.com/license/ -->
         <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
         Designed by <a href="https://bootstrapmade.com/" target="_blank">BootstrapMade</a>
      </div>
      <div class="credits">
         Modify by <a href="https://www.instagram.com/erimaulana.69/" target="_blank"><strong>Eri Maulana</strong></a>
      </div>
   </footer><!-- End Footer -->

   <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

   <!-- Vendor JS Files -->
   <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
   <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="assets/vendor/chart.js/chart.umd.js"></script>
   <script src="assets/vendor/echarts/echarts.min.js"></script>
   <script src="assets/vendor/quill/quill.min.js"></script>
   <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
   <script src="assets/vendor/tinymce/tinymce.min.js"></script>
   <script src="assets/vendor/php-email-form/validate.js"></script>

   <!-- Template Main JS File -->
   <script src="assets/js/main.js"></script>

</body>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk Pesanan Baru</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form method="post">
            <div class="modal-body">
               <select class="form-select" aria-label="Default select example" name="idproduk">
                  <option selected>Pilih Produk...</option>
                  <?php
                  $ambilproduk = mysqli_query($c, "SELECT * FROM produk WHERE idproduk NOT IN (SELECT idproduk FROM detailpesanan WHERE idpesanan ='$idp') ");

                  while ($baris = mysqli_fetch_array($ambilproduk)) {
                     $idproduk = $baris['idproduk'];
                     $namabarang = $baris['namabarang'];
                     $stock = $baris['stock'];
                     $deskripsi = $baris['deskripsi'];
                  ?>

                     <option value="<?= $idproduk; ?>"> <?= $namabarang; ?> - <?= $deskripsi; ?> | (Stock : <?= $stock; ?>)
                     </option>

                  <?php
                  }
                  ?>
               </select>
               <div class="form-floating mt-2">
                  <input type="number" class="form-control" name="qty" id="floatingInput" placeholder="Jumlah" required min="1">
                  <label for="floatingInput">Jumlah</label>
               </div>
               <input type="hidden" name="idp" value="<?= $idp; ?>">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
               <button type="submit" name="addproduk" class="btn btn-info">Tambah</button>
            </div>
         </form>
      </div>
   </div>
</div>

</html>