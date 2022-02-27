<?php include'koneksi.php';?>

<!DOCTYPE html>
<html>
<head>
    <title>Nota Pembelian</title>
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
   
   
     <!---nota disini copas dari yang di admin --->
	 <h2>Detail Pembelian</h2>

<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
<p>
   <?php echo $detail['telepon_pelanggan']; ?><br>
   <?php echo $detail['email_pelanggan']; ?>
</p>

<p>
   Tanggal Pembelian : <?php echo $detail['tanggal_pembelian']; ?><br>
   Total Pembelian : <?php echo  number_format($detail['total_pembelian']); ?>
</p>

<table class="table table-bordered"> 
   <thead>
      <tr>
         <th>no</th>
         <th>nama produk</th>
         <th>harga</th>
         <th>jumlah</th>
         <th>subtotal</th>
      </tr>
   </thead>
      <tbody>
      <?php $nomor=1; ?>
      <?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk 
      WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
      <?php while($pecah = $ambil->fetch_assoc()){ ?>
      <tr>
      <td><?php echo $nomor; ?></td>
      <td><?php echo $pecah['nama_produk']; ?></td>
      <td><?php echo $pecah['harga_produk']; ?></td>
      <td><?php echo $pecah['jumlah']; ?></td>
      <td>
          <?php echo $pecah['harga_produk']*$pecah['jumlah']; ?></td>
      </td>
      </tr>
      <?php $nomor++;?>
      <?php } ?>
   </tbody>
</table>
    
   <div class="row">
     <div class="col-md-7">
	    <div class="alert alert-info">
		  <p>
		    Silahkan melakukan pembayaran Rp. <?php echo  number_format($detail['total_pembelian']); ?>ke <br>
			<strong>BANK BNI 123-000090-8897 AN Rose</strong>
		  </p>
		</div>
	 </div>
   </div>
   
   </div>
</section>

<script src="assets/dist/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/OwlCarousel/owl.carousel.min.js"></script>

</body>
</html>