<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Laundry Malas Ngoding - WWW.MALASNGODING.COM</title>

	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>

</head>
<body>
	<!-- cek apakah sudah login -->
	<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:../index.php?pesan=belum_login");
	}
	?>


	<?php 
	// koneksi database
	include '../koneksi.php';
	?>
	<div class="container">

		<center><h2>LAUNDRY " Malas Ngoding "</h2></center>
		<br/>
		<br/>
		<?php 
		if(isset($_GET['dari']) && isset($_GET['sampai'])){

			$dari = $_GET['dari'];
			$sampai = $_GET['sampai'];
			?>
			<h4>Data Laporan Laundry dari <b><?php echo $dari; ?></b> sampai <b><?php echo $sampai; ?></b></h4>
			<table class="table table-bordered table-striped">
				<tr>
					<th width="1%">No</th>
					<th>Invoice</th>
					<th>Tanggal</th>
					<th>Pelanggan</th>
					<th>Berat (Kg)</th>
					<th>Tgl. Selesai</th>
					<th>Harga</th>
					<th>Status</th>				
				</tr>

				<?php 
				

					// mengambil data pelanggan dari database
				$data = mysqli_query($koneksi,"select * from pelanggan,transaksi where transaksi.id_pelanggan=pelanggan.id and date(tanggal_transaksi) > '$dari' and date(tanggal_transaksi) < '$sampai' order by transaksi.id desc");
				$no = 1;
					// mengubah data ke array dan menampilkannya dengan perulangan while
				while($d=mysqli_fetch_array($data)){
					?>
					<tr>
							<td><?php echo $no++; ?></td>
							<td>INVOICE-<?php echo $d['id']; ?></td>
							<td><?php echo $d['tanggal_transaksi']; ?></td>
							<td><?php echo $d['nama']; ?></td>
							<td><?php echo $d['berat']; ?></td>
							<td><?php echo $d['tanggal_selesai']; ?></td>
							<td><?php echo "Rp. ".number_format($d['total_harga']) ." ,-"; ?></td>
							<td>
								<?php 
								if($d['status']=="0"){
									echo "<div class='label label-warning'>PROSES</div>";
								}else if($d['status']=="1"){
									echo "<div class='label label-info'>DICUCI</div>";
								}else if($d['status']=="2"){
									echo "<div class='label label-success'>SELESAI</div>";
								}
								?>							
							</td>							
						</tr>
					<?php 
				}
				?>
			</table>			
			<?php } ?>

		</div>

		<script type="text/javascript">
			window.print();
		</script>

	</body>
	</html>