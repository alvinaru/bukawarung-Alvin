<?php
	session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}

	// Query for statistics
$total_products = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_product"));

$total_purchases = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM tb_pembelian")
);

$total_revenue = mysqli_fetch_array(
    mysqli_query($conn, "SELECT SUM(total_harga) AS total FROM tb_pembelian")
)['total'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WarPin</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href="dashboard.php">WarPin</a></h1>
			<ul>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li><a href="profil.php">Profil</a></li>
				<li><a href="data-kategori.php">Data Kategori</a></li>
				<li><a href="data-produk.php">Data Produk</a></li>
				<li><a href="data-pembelian.php">Data Pembelian</a></li>
				<li><a href="keluar.php">Keluar</a></li>
			</ul>
		</div>
	</header>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Dashboard</h3>
			<div class="box">
				<h4>Selamat Datang <?php echo $_SESSION['a_global']->admin_name ?> di Toko Online</h4>
			</div>

			<!-- Statistics -->
			<div class="box">
				<h4 style="font-size: 24px; font-weight: 600; margin-bottom: 20px; color: #333;">Statistik</h4>
				<div class="stats-grid">
					<div class="stat-card">
						<h2><?php echo $total_products; ?></h2>
						<p>Total Produk</p>
					</div>
					<div class="stat-card">
						<h2><?php echo $total_purchases; ?></h2>
						<p>Total Pembelian</p>
					</div>
					<div class="stat-card">
						<h2>Rp. <?php echo number_format($total_revenue); ?></h2>
						<p>Total Pendapatan</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- footer -->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2025 - WarPin.</small>
		</div>
	</footer>
</body>
</html>