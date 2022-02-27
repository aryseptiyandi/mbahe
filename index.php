<?php
session_start();
//koneksi ke database
include 'koneksi.php';

?>
<!DOCTYPE html>
<html>
<head>
   <title>Toko Mbahe</title>
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


<!-- konten -->
<section class="konten">
     <div class ="container">
           <h1>Produk Terbaru</h1>
           <div class="row">


              <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?> 
              <?php while($perproduk = $ambil->fetch_assoc()){ ?>

              <div class="col-md-4">
                 <div class="thumbnail">
                    <img src="foto_produk/<?php echo $perproduk['foto_produk'];?>" alt="">
                    <div class="caption">
                       <h3><?php echo $perproduk['nama_produk'];?></h3>
                       <h5>Rp.<?php echo number_format($perproduk['harga_produk']);?></h5>
                       <a href="beli.php?id=<?php echo $perproduk ['id_produk'];?>" class="btn btn-primary">Beli</a>
					   <a href="detail.php?id=<?php echo $perproduk["id_produk"];?>"class="btn btn-default">detail</a>
                    </div>
                 </div>
              </div>
              <?php } ?>

           </div>
     </div>
</section>

<script src="assets/dist/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/OwlCarousel/owl.carousel.min.js"></script>

</body>
</html>
