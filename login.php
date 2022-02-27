<?php
session_start();
//koneksi ke database
include 'koneksi.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Pelanggan</title>
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


<div class="container">
   <div class="row">
     <div class="col-md-4">
	   <div class="panel panel-default">
	     <div class="panel-heading">
	         <h3 class="panel-title">Login Pelanggan</h3>
	     </div>
		 <div class="panel-body">
		    <form method="post">
			  <div class="form-group">
			     <label>Email</label>
				 <input type="email" class="form-control" name="email">
			  </div>
			  <div class="form-group">
			     <label>Password</label>
				 <input type="password" class="form-control" name="password">
			  </div>
			  <button class="btn btn-primary" name="login">Login</button>
			</form>
		 </div>
	   </div>
	 </div>
   </div>
</div>
<?php
//jk ada tombol simpan(tombol simpan ditekan)
if(isset($_POST["login"]))
{
	$email = $_POST["email"];
	$password = $_POST["password"];
	//lakukan query cek akun di tabel pelanggan di db
	$ambil = $koneksi->query("SELECT * FROM pelanggan
	WHERE email_pelanggan='$email' AND password_pelanggan='$password'");
	
	//ngitung akun yg terambil
	$akunyangcocok = $ambil->num_rows;
	
	//jika 1 akun yang cocol, maka diloginkan
	if($akunyangcocok==1)
	{
		//anda sukses login
		//mendapatkan akun dlm bentuk array
		$akun = $ambil->fetch_assoc();
		//simpan di session pelanggan
		$_SESSION["pelanggan"] = $akun;
		echo "<script>alert('anda sukses login');</script>";
		echo "<script>location='checkout.php';</script>";
		
	}
	else
	{
		//anda gagal login
		echo "<script>alert('anda gagal login, periksa akun anda');</script>";
		echo "<script>location='login.php';</script>";
	}
}




?>

<script src="assets/dist/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/OwlCarousel/owl.carousel.min.js"></script>
</body>
</html>