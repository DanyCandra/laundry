<!DOCTYPE html>
<html>
<head>
<title>Laundry Serkom - dany candra</title>

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
	
	<div class="col-md-10 col-md-offset-1">								
		<?php 
		// menangkap id yang dikirim melalui url
		$id = $_GET['id'];

		// megambil data pelanggan yang ber id di atas dari tabel pelanggan
		$transaksi = mysqli_query($koneksi,"select * from transaksi,pelanggan where transaksi.id='$id' and transaksi.id_pelanggan=pelanggan.id");
		while($t=mysqli_fetch_array($transaksi)){
			?>
			<center><h2>LAUNDRY " Serkom "</h2></center>
			<h3>INVOICE-<?php echo $id; ?></h3>

			
			<br/>
			
			<table class="table">
				<tr>
					<th width="20%">Tgl. Laundry</th>
					<th>:</th>
					<td><?php echo $t['tanggal_transaksi']; ?></td>
				</tr>
				<tr>
					<th>Nama Pelanggan</th>
					<th>:</th>
					<td><?php echo $t['nama']; ?></td>
				</tr>
				<tr>
					<th>HP</th>
					<th>:</th>
					<td><?php echo $t['telepon']; ?></td>
				</tr>
				<tr>
					<th>Alamat</th>
					<th>:</th>
					<td><?php echo $t['alamat']; ?></td>
				</tr>
				<tr>
					<th>Berat Cucian (Kg)</th>
					<th>:</th>
					<td><?php echo $t['berat']; ?></td>
				</tr>
				<tr>
					<th>Tgl. Selesai</th>
					<th>:</th>
					<td><?php echo $t['tanggal_selesai']; ?></td>
				</tr>
				<tr>
					<th>Status</th>
					<th>:</th>
					<td>
						<?php 
						if($t['status']=="0"){
							echo "<div class='label label-warning'>PROSES</div>";
						}else if($t['status']=="1"){
							echo "<div class='label label-info'>DI CUCI</div>";
						}else if($t['status']=="2"){
							echo "<div class='label label-success'>SELESAI</div>";
						} 
						?>		
					</td>
				</tr>
				<tr>
					<th>Harga</th>
					<th>:</th>
					<td><?php echo "Rp. ".number_format($t['total_harga'])." ,-"; ?></td>
				</tr>
			</table>

			<br/>

			<h4>Daftar Cucian</h4>
			<table class="table table-bordered table-striped">
				<tr>
					<th>Jenis Pakaian</th>
					<th width="20%">Jumlah</th>
				</tr>		

				<?php 


				// menampilkan pakaian-pakaian dari transaksi yang ber id di atas
				$pakaian = mysqli_query($koneksi,"select * from transaksi_detail where id_transaksi='$id'");

				while($p=mysqli_fetch_array($pakaian)){
					?>					
					<tr>
						<td><?php echo $p['jenis']; ?></td>
						<td width="5%"><?php echo $p['jumlah']; ?></td>
					</tr>
					<?php } ?>							
				</table>

				<br/>
				<p><center><i>" Terima kasih telah mempercayakan cucian anda pada kami ".</i></center></p>

				<?php 
			}
			?>
		</div>


	</div>

	<script type="text/javascript">
		window.print();
	</script>

</body>
</html>