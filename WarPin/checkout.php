<?php
	error_reporting(0);
	include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
	$a = mysqli_fetch_object($kontak);

	$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
	$p = mysqli_fetch_object($produk);

	if(isset($_POST['submit'])){
		$product_id = $_POST['product_id'];
		$quantity = $_POST['quantity'];
		$customer_name = $_POST['customer_name'];

		// Get product price
		$product = mysqli_query($conn, "SELECT product_price FROM tb_product WHERE product_id = '$product_id'");
		$pr = mysqli_fetch_object($product);
		$total_price = $pr->product_price * $quantity;

		$insert = mysqli_query($conn, "INSERT INTO tb_pembelian (
            product_id,
            jumlah,
            total_harga,
            tanggal_pembelian,
            nama_pelanggan
        ) VALUES (
            '$product_id',
            '$quantity',
            '$total_price',
            NOW(),
            '$customer_name'
        )");


		if($insert){
			echo '<script>alert("Pembelian berhasil! Terima kasih telah berbelanja.")</script>';
			echo '<script>window.location="produk.php"</script>';
		}else{
			echo 'gagal '.mysqli_error($conn);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Checkout - WarPin</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href="index.php">WarpPin</a></h1>
			<ul>
				<li><a href="produk.php">Produk</a></li>
			</ul>
		</div>
	</header>

	<!-- search -->
	<div class="search">
		<div class="container">
			<form action="produk.php">
				<input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
				<input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
				<input type="submit" name="cari" value="Cari Produk">
			</form>
		</div>
	</div>

	<!-- checkout -->
	<div class="section">
		<div class="container">
			<h3>Checkout Produk</h3>
			<div class="box">
				<div class="col-2">
					<img src="produk/<?php echo $p->product_image ?>" width="40%">
				</div>
				<div class="col-2">
					<h3><?php echo $p->product_name ?></h3>
					<h4>Rp. <?php echo number_format($p->product_price) ?></h4>
					<p>Deskripsi :<br>
						<?php echo $p->product_description ?>
					</p>
				</div>
			</div>
			<div class="box">
				<form action="" method="POST">
					<input type="hidden" name="product_id" value="<?php echo $p->product_id ?>">
					<input type="number" name="quantity" class="input-control" placeholder="Jumlah" required min="1">
					<input type="text" name="customer_name" class="input-control" placeholder="Nama Lengkap" required>
					<input type="submit" name="submit" value="Beli Sekarang" class="btn">
				</form>
			</div>
		</div>
	</div>

	<!-- footer -->
	<div class="footer">
		<div class="container">
			<h4>Alamat</h4>
			<p><?php echo $a->admin_address ?></p>

			<h4>Email</h4>
			<p><?php echo $a->admin_email ?></p>

			<h4>No. Hp</h4>
			<p><?php echo $a->admin_telp ?></p>
			<small>Copyright &copy; 2025 - WarPin.</small>
		</div>
	</div>
</body>
</html>
