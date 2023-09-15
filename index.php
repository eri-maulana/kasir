<?php
   require 'ceklogin.php';
   
   $ambildatapesanan = mysqli_query($c, "SELECT * FROM pesanan");
   $jumlahpesanan = mysqli_num_rows($ambildatapesanan);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1.0" name="viewport">

   <title>Pesanan</title>
   <meta content="" name="description">
   <meta content="" name="keywords">

   <!-- Favicons -->
   <link href="assets/img/favicon.png" rel="icon">
   <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

   <!-- Google Fonts -->
   <link href="https://fonts.gstatic.com" rel="preconnect">
   <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet">

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
         <nav>
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="index.php">Home</a></li>
               <li class="breadcrumb-item active">Pesanan</li>
            </ol>
         </nav>
      </div><!-- End Page Title -->


      <section class="section">
         <div class="row">
            <div class="col-lg-12">

               <div class="card">
                  <div class="card-body">
                     <h5 class="card-title">Pesanan</h5>
                     <button type="button" class="btn btn-info mb-3" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Tambah Pesanan
                     </button>
                     <button disabled="disabled" class="btn btn-secondary mb-3">Jumlah Pesanan : <?=$jumlahpesanan;?>
                     </button>

                     <!-- Table with stripped rows -->
                     <table class="table datatable">
                        <thead>
                           <tr>
                              <th scope="col">No</th>
                              <th scope="col">ID Pesanan</th>
                              <th scope="col">Tanggal</th>
                              <th scope="col">Pelanggan</th>
                              <th scope="col">Jumlah</th>
                              <th scope="col">Aksi</th>
                           </tr>
                        </thead>
                        <tbody>

                           <?php
                              $i = 1;
                              $ambildata = mysqli_query($c, "SELECT * FROM pesanan p, pelanggan pl WHERE p.idpelanggan=pl.idpelanggan");
                              while($baris = mysqli_fetch_array($ambildata)){
                                 $idpesanan = $baris['idpesanan'];
                                 $tanggal = $baris['tanggal'];
                                 $namapelanggan = $baris['namapelanggan'];
                                 $alamat = $baris['alamat'];

                                 // hitung jumlah
                                 $hitungjumlah = mysqli_query($c,"SELECT * FROM detailpesanan WHERE idpesanan = '$idpesanan'");
                                 $jumlah = mysqli_num_rows($hitungjumlah)
                              
                           ?>
                           <tr>
                              <td><?=$i;?></td>
                              <td><?=$idpesanan;?></td>
                              <td><?=$tanggal;?></td>
                              <td><?=$namapelanggan;?> - <?=$alamat;?></td>
                              <td><?=$jumlah;?></td>
                              <td>
                                 <!-- Button trigger modal -->
                                 <a href="view.php?idp=<?=$idpesanan;?>" class="btn btn-primary"
                                    target="_blank">Tampilkan</a>
                                 <!-- Button trigger modal -->
                                 <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal2<?=$idpesanan;?>">
                                    Hapus
                                 </button>
                              </td>
                           </tr>


                           <!-- Modal Hapus-->
                           <div class="modal fade" id="exampleModal2<?=$idpesanan;?>" tabindex="-1"
                              aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus</h1>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal"
                                          aria-label="Close"></button>
                                    </div>
                                    <form method="post">
                                       <div class="modal-body">
                                          <input type="hidden" name="idpesanan" value="<?=$idpesanan;?>">
                                          <h2 class="text-center">Apakah kamu yakin ingin menghapus <br>
                                             <strong><?=$namapelanggan;?> - <?=$alamat;?></strong> ??
                                          </h2>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary"
                                             data-bs-dismiss="modal">Close</button>
                                          <button type="submit" name="hapuspesanan"
                                             class="btn btn-danger">Hapus</button>
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

   <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
         class="bi bi-arrow-up-short"></i></a>

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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pesanan Baru</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form method="post">
            <div class="modal-body">
               <select class="form-select" aria-label="Default select example" name="idpelanggan">
                  <option selected>Pilih Pelanggan...</option>
                  <?php
                     $ambilpelanggan = mysqli_query($c,"SELECT * FROM pelanggan");
                  
                     while($baris = mysqli_fetch_array($ambilpelanggan)){
                        $idpelanggan = $baris['idpelanggan'];
                        $namapelanggan = $baris['namapelanggan'];
                        $alamat = $baris['alamat'];
                  ?>

                  <option value="<?=$idpelanggan;?>"> <?=$namapelanggan;?> - <?=$alamat;?> </option>

                  <?php
                     }
                  ?>
               </select>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
               <button type="submit" name="tambahpesanan" class="btn btn-info">Tambah</button>
            </div>
         </form>
      </div>
   </div>
</div>

</html>