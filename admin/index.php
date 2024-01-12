<?php include 'header.php'; ?>

<?php 
// koneksi database
include '../koneksi.php'; 
?>

<div class="container">
	<div class="alert alert-info text-center">
		<h4 style="margin-bottom: 0px"><b>Selamat datang!</b> di sistem informasi laundry serkom dany.</h4>			
	</div>

	<div class="panel">
		<div class="panel-heading">
			<h4>Dashboard</h4>
		</div>
		<div class="panel-body">
			
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h1>
								<i class="glyphicon glyphicon-user"></i> 
								<span class="pull-right">
									
									<?php 
									$pelanggan = mysqli_query($koneksi,"select * from pelanggan");
									echo mysqli_num_rows($pelanggan);
									?>
								</span>
							</h1>
							Jumlah Pelanggan
						</div>						
					</div>				
				</div>		

				<div class="col-md-3">
					<div class="panel panel-warning">
						<div class="panel-heading">
							<h1>
								<i class="glyphicon glyphicon-retweet"></i> 
								<span class="pull-right">
									
									<?php 
									$proses = mysqli_query($koneksi,"select * from transaksi where status='0'");
									echo mysqli_num_rows($proses);
									?>
								</span>
							</h1>
							Jumlah Cucian Di Proses
						</div>						
					</div>				
				</div>		

				<div class="col-md-3">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h1>
								<i class="glyphicon glyphicon-info-sign"></i> 
								<span class="pull-right">
									
									<?php 
									$proses = mysqli_query($koneksi,"select * from transaksi where status='1'");
									echo mysqli_num_rows($proses);
									?>
								</span>
							</h1>
							Jumlah Cucian Siap Ambil
						</div>						
					</div>				
				</div>				

				<div class="col-md-3">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h1>
								<i class="glyphicon glyphicon-ok-circle"></i> 
								<span class="pull-right">
									
									<?php 
									$proses = mysqli_query($koneksi,"select * from transaksi where status='2'");
									echo mysqli_num_rows($proses);
									?>
								</span>
							</h1>
							Jumlah Cucian Selesai
						</div>						
					</div>				
				</div>				
			</div>		

		</div>
	</div>

	<div class="panel">
		<div class="panel-heading">
			<h4>Riwayat Transaksi Terakhir</h4>
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-striped">
				<tr>
					<th width="1%">No</th>
					<th>Invoice</th>
					<th>Tanggal Transaksi</th>
					<th>Pelanggan</th>
					<th>Berat (Kg)</th>
					<th>Tanggal Selesai</th>
					<th>Harga</th>
					<th>Status</th>									
				</tr>

				<?php 				
				// mengambil data pelanggan dari database
				$data = mysqli_query($koneksi,"select * from pelanggan,transaksi where pelanggan.id=transaksi.id_pelanggan order by transaksi.tanggal_transaksi desc limit 7");
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
		</div>
	</div>


</div>

<?php include 'footer.php'; ?>