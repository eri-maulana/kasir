<?php

session_start();

// koneksi database
$c = mysqli_connect('localhost','root','','kasir');


// kodingan login
if (isset($_POST['login'])){
   // inisialisasi variabel penampung data inputan user
   $username = $_POST['username'];
   $password = $_POST['password'];
   
   $query = mysqli_query($c, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
   $baris = mysqli_num_rows($query);

   if ($baris > 0) {
      // buat variabel sesi untuk memeriksa riwayat login atau belum
      $_SESSION['login'] = 'True';
      header('location: index.php');
   } else {
      echo '
      <script>alert("Username dan Password Tidak Tersedia");
      window.location.href = "login.php";
      </script>
      ';
   }
}

// INDEX.PHP
// codingan index.php tambah pesanan baru
if (isset($_POST['tambahpesanan'])){
   $idpelanggan = $_POST['idpelanggan'];

   $tambahpesanan = mysqli_query($c, "INSERT INTO pesanan (idpelanggan) VALUES ('$idpelanggan')");

   if ($tambahpesanan) {
      header("location: index.php");
   } else {
      echo '
      <script>alert("Gagal Menambah Pesanan Baru");
      window.location.href = "index.php";
      </script>
      ';
   }
}

// codingan index.php Hapus barang
if (isset($_POST['hapuspesanan'])){
   $idpesanan = $_POST['idpesanan'];

   $hapus = mysqli_query($c, "DELETE FROM pesanan WHERE idpesanan = '$idpesanan'");

   if ($hapus) {
      header("location: index.php");
   } else {
      echo '
      <script>alert("Gagal Menghapus Barang");
      window.location.href = "index.php";
      </script>
      ';
   }
}



// STOCK.PHP
// codingan Stock.php tambah barang baru
if (isset($_POST['tambahbarang'])){
   $namabarang = $_POST['namabarang'];
   $deskripsi = $_POST['deskripsi'];
   $harga = $_POST['harga'];
   $stock = $_POST['stock'];

   $tambah = mysqli_query($c, "INSERT INTO produk (namabarang,deskripsi,harga,stock) VALUES ('$namabarang','$deskripsi','$harga','$stock')");

   if ($tambah) {
      header("location: stock.php");
   } else {
      echo '
      <script>alert("Gagal Menambah Barang Baru");
      window.location.href = "stock.php";
      </script>
      ';
   }
}

// codingan Stock.php  ubah barang
if (isset($_POST['ubah'])){
   $idproduk = $_POST['idproduk'];
   $namabarang = $_POST['namabarang'];
   $deskripsi = $_POST['deskripsi'];
   $harga = $_POST['harga'];
   $stock = $_POST['stock'];

   $ubah = mysqli_query($c, "UPDATE produk SET namabarang = '$namabarang' , deskripsi = '$deskripsi' , harga = '$harga', stock = '$stock' WHERE idproduk = '$idproduk' ");

   if ($ubah) {
      header("location: stock.php");
   } else {
      echo '
      <script>alert("Gagal Mengubah Barang");
      window.location.href = "stock.php";
      </script>
      ';
   }
}

// codingan Stock.php Hapus barang
if (isset($_POST['hapus'])){
   $idproduk = $_POST['idproduk'];

   $hapus = mysqli_query($c, "DELETE FROM produk WHERE idproduk = '$idproduk'");

   if ($hapus) {
      header("location: stock.php");
   } else {
      echo '
      <script>alert("Gagal Menghapus Barang");
      window.location.href = "stock.php";
      </script>
      ';
   }
}

// PELANGGAN.PHP
// codingan pelanggan.php tambah barang baru
if (isset($_POST['tambahpelanggan'])){
   $namapelanggan = $_POST['namapelanggan'];
   $notelp = $_POST['notelp'];
   $alamat = $_POST['alamat'];

   $tambahpelanggan = mysqli_query($c, "INSERT INTO pelanggan (namapelanggan,notelp,alamat) VALUES ('$namapelanggan','$notelp','$alamat')");

   if ($tambahpelanggan) {
      header("location: pelanggan.php");
   } else {
      echo '
      <script>alert("Gagal Menambah Pelanggan Baru");
      window.location.href = "pelanggan.php";
      </script>
      ';
   }
}

// codingan pelanggan.php  ubah pelanggan
if (isset($_POST['ubahpelanggan'])){
   $idpelanggan = $_POST['idpelanggan'];
   $namapelanggan = $_POST['namapelanggan'];
   $notelp = $_POST['notelp'];
   $alamat = $_POST['alamat'];

   $ubahpelanggan = mysqli_query($c, "UPDATE pelanggan SET namapelanggan = '$namapelanggan' ,  notelp = '$notelp', alamat = '$alamat' WHERE idpelanggan = '$idpelanggan' ");

   if ($ubahpelanggan) {
      header("location: pelanggan.php");
   } else {
      echo '
      <script>alert("Gagal Mengubah Pelanggan");
      window.location.href = "pelanggan.php";
      </script>
      ';
   }
}

// codingan pelanggan.php Hapus Pelanggan
if (isset($_POST['hapuspelanggan'])){
   $idpelanggan = $_POST['idpelanggan'];

   $hapuspelanggan = mysqli_query($c, "DELETE FROM pelanggan WHERE idpelanggan = '$idpelanggan'");

   if ($hapuspelanggan) {
      header("location: pelanggan.php");
   } else {
      echo '
      <script>alert("Gagal Menghapus Pelanggan");
      window.location.href = "pelanggan.php";
      </script>
      ';
   }
}

// VIEW.PHP
// codingan view.php tambah barang baru
if (isset($_POST['addproduk'])){
   $idp = $_POST['idp'];
   $idproduk = $_POST['idproduk'];
   $qty = $_POST['qty'];

   // hitung stock sekarang
   $hitung1 = mysqli_query($c, "SELECT * FROM produk WHERE idproduk = '$idproduk'");
   $hitung2 = mysqli_fetch_array($hitung1);
   $stocksekarang = $hitung2['stock'];

   if($stocksekarang >= $qty){

      // kurangi stok dengan jumlah yang akan dikeluarkan
      $selisih = $stocksekarang - $qty;

      // stock cukup
      $addproduk = mysqli_query($c, "INSERT INTO detailpesanan (idpesanan,idproduk,qty) VALUES ('$idp','$idproduk','$qty')");
      $update = mysqli_query($c, "UPDATE produk SET stock='$selisih' WHERE idproduk='$idproduk'");

      if ($addproduk&&$update) {
         header("location: view.php?idp=".$idp);
      } else {
         echo '
         <script>alert("Gagal Menambah Pesanan Baru");
         window.location.href = "view.php?idp='.$idp.'";
         </script>
         ';
      }
   } else {
      // stock ga cukup
      echo '
         <script>alert("Stok Barang Tidak Cukup");
         window.location.href = "view.php?idp='.$idp.'";
         </script>
         ';
   }
}

// codingan view.php Hapus Produk Pesanan
if (isset($_POST['hapusprodukpesanan'])){
   $idp = $_POST['idp']; //iddetailpesanan
   $idpr = $_POST['idpr']; //idproduk
   $idorder = $_POST['idorder']; //idpesanan

   // cek qty sekarang
   $hapusprodukpesanan = mysqli_query($c, "SELECT * FROM detailpesanan WHERE iddetailpesanan = '$idp'");
   $ambilbaris = mysqli_fetch_array($hapusprodukpesanan); 
   $qtysekarang = $ambilbaris['qty'];

   // cek stock sekarang
   $cekstock = mysqli_query($c, "SELECT * FROM produk WHERE idproduk = '$idpr'");
   $barisstock = mysqli_fetch_array($cekstock);
   $stocksekarang = $barisstock['stock'];

   $hitung = $stocksekarang + $qtysekarang;

   $updatestock = mysqli_query($c, "UPDATE produk SET stock='$hitung' WHERE idproduk='$idpr'"); //update stock
   $hapus = mysqli_query($c, "DELETE FROM detailpesanan WHERE idproduk= '$idpr' AND iddetailpesanan = '$idp'"); //hapus

   if ($updatestock&&$hapus) {
      header("location: view.php?idp='.$idorder'");
   } else {
      echo '
      <script>alert("Gagal Menghapus Produk Pesanan");
      window.location.href = "view.php?idp='.$idorder.'";
      </script>   
      ';
   }
}

// MASUK.PHP
// codingan masuk.php tambah pesanan baru
if (isset($_POST['barangmasuk'])){
   $idproduk = $_POST['idproduk'];
   $qty = $_POST['qty'];

   $barangmasuk = mysqli_query($c, "INSERT INTO masuk (idproduk,qty) VALUES ('$idproduk','$qty')");

   if ($barangmasuk) {
      header("location: masuk.php");
   } else {
      echo '
      <script>alert("Gagal Menambah Barang Masuk Baru");
      window.location.href = "masuk.php";
      </script>
      ';
   }
}

?>