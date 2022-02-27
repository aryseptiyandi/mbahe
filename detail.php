<?php session_start(); ?>
<?php include 'koneksi.php';?>
<?php
$id_produk = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

echo "<pre>";
print_r($detail);
echo "</pre>";


?>


<!DOCTYPE html>
<html>
<head>
   <title>Detail Produk</title>
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
	   <div class="row">
	      <div class="col-md-6">
		      <img src ="foto_produk/<?php echo $detail["foto_produk"]; ?>" alt="" class="img-responsive">
		  </div>
		  <div class="col-md-6">
		    <h2><?php echo $detail["nama_produk"]?></h2>
			<h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>
			<form method="post">
			   <div class="form-group">
			     <div class="input-group">
				    <input type="number" min="1" class="form-control" name="jumlah">
					<div class="input-group-btn">
					  <button class="btn btn-primary" name="beli">Beli</button>
					</div>
				 </div>
			   </div>
			</form>
			
			<?php
			if(isset($_POST["beli"]))
			{
                $jumlah = $_POST["jumlah"];
				$_SESSION["keranjang"][$id_produk] = $jumlah;
				
				echo "<script>alert('produk telah masuk ke keranjang'); </script>";
				echo "<script>location='keranjang.php'; </script>";
			}
			
			?>
			
			
			<p><?php echo $detail["ukuran"]; ?></p>
		  </div>
		  <div class="col-md-6"></div>
	   </div>
	</div>
</section>



</body>
</html>