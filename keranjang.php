<?php
session_start();
include 'koneksi.php';

if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('keranjang kosong, silakan berbelanja');</script>";
	echo "<script>location='index.php';</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja</title>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="assets/OwlCarousel/css/owl.carousel.min.css">
   <link rel="stylesheet" href="assets/OwlCarousel/css/owl.theme.default.min.css">
   <link rel="stylesheet" href="assets/dist/css/main.css">
</head>
<body>
<!-- navbar -->
<nav class="navbar navbar-default">
   <div class ="container">
      <div class="navbar-header">
	     <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav">
		    MENU
		 </button>
	  </div>
        <div class="collapse navbar-collapse" id="nav">
        <ul class="nav navbar-nav">
         <li><a href="index.php">Home</a></li>
         <li><a href="keranjang.php">Keranjang Belanja</a></li>
	     <!--jk sudah login (adasession pelanggan)-->
	     <?php if(isset($_SESSION["pelanggan"])): ?>
	     <li><a href="logout.php">Logout</a></li>
	     <!---selain itu (blm login(blm ada session pelanggan))--->
	     <?php else: ?>
	     <li><a href="login.php">Login</a></li>
	     <?php endif ?>
      <li><a href="checkout.php">Chectout</a></li>
       </ul>
     </div>
	</div>
   
</nav>

<section class="kontent">
    <div class="container">
	<h1>Keranjang Belanja</h1>
	<hr>
	<table class="table table-bordered">
	    <thead>
		   <tr>
		       <th>No</th>
			   <th>Produk</th>
			   <th>Harga</th>
			   <th>Jumlah</th>
			   <th>Subharga</th>
			   <th>Aksi</th>
		   </tr>
		</thead>
		<tbody>
		    <?php $nomor=1; ?>
		    <?php foreach($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
			<!---menampilkan produk yang sedang diperulangkan berdasarkan id_produk--->
			<?php
			$ambil = $koneksi->query("SELECT * FROM produk
			WHERE id_produk='$id_produk'");
			$pecah = $ambil->fetch_assoc();
			$subharga = $pecah["harga_produk"]*$jumlah;
			

			?>
			
		     <tr>
			      <td><?php echo $nomor; ?></td>
				  <td><?php echo $pecah["nama_produk"]; ?></td>
				  <td>Rp. <?php echo number_format ($pecah["harga_produk"]); ?></td>
				  <td><?php echo $jumlah; ?></td>
				  <td>Rp. <?php echo number_format($subharga); ?></td>
				  <td>
				     <a href="hapuskeranjang.php?id=<?php echo $id_produk?>" class="btn btn-danger btn-xs">hapus</a>
				  </td>
			 </tr>
			 <?php $nomor++; ?>
			<?php endforeach ?>
		</tbody>
	</table>
	
	<a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
	<a href="checkout.php" class="btn btn-primary">Checkout</a>
	</div>
</section>

<script src="assets/dist/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/OwlCarousel/owl.carousel.min.js"></script>

</body>
</html>