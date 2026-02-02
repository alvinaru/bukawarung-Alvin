<?php
	session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Data Pembelian - Bukawarung</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href="dashboard.php">Bukawarung</a></h1>
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
			<h3>Data Pembelian</h3>
			<div class="box">
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th>Produk</th>
							<th>Jumlah</th>
							<th>Total Harga</th>
							<th>Tanggal Pembelian</th>
							<th>Nama Pelanggan</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							$pembelian = mysqli_query($conn, "SELECT * FROM tb_pembelian LEFT JOIN tb_product USING (product_id) ORDER BY pembelian_id DESC");
							if(mysqli_num_rows($pembelian) > 0){
							while($row = mysqli_fetch_array($pembelian)){
						?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $row['product_name'] ?></td>
							<td><?php echo $row['jumlah'] ?></td>
							<td>Rp. <?php echo number_format($row['total_harga']) ?></td>
							<td><?php echo $row['tanggal_pembelian'] ?></td>
							<td><?php echo $row['nama_pelanggan'] ?></td>
						</tr>
						<?php }}else{ ?>
							<tr>
								<td colspan="6">Tidak ada data</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
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
