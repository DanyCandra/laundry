<?php include 'header.php'; ?>

<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>Filter Laporan</h4>
		</div>
		<div class="panel-body">		

			<form action="laporan.php" method="get">
				<table class="table table-bordered table-striped">
					<tr>				
						<th>Dari Tanggal</th>
						<th>Sampai Tanggal</th>							
						<th width="1%"></th>
					</tr>
					<tr>
						<td>
							<br/>
							<input type="date" name="tgl_dari" class="form-control">
						</td>
						<td>
							<br/>
							<input type="date" name="tgl_sampai" class="form-control">
							<br/>
						</td>
						<td>
							<br/>
							<input type="submit" class="btn btn-primary" value="Filter">
						</td>
					</tr>

				</table>
			</form>
			
		</div>
	</div>

	<br/>

	<?php 
	if(isset($_GET['tgl_dari']) && isset($_GET['tgl_sampai'])){

		$dari = $_GET['tgl_dari'];
		$sampai = $_GET['tgl_sampai'];

		?>
		<div class="panel">
			<div class="panel-heading">
				<h4>Data Laporan Laundry dari <b><?php echo $dari; ?></b> sampai <b><?php echo $sampai; ?></b></h4>
			</div>
			<div class="panel-body">			

				<a target="_blank" href="cetak_print.php?dari=<?php echo $dari; ?>&sampai=<?php echo $sampai; ?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-print"></i> CETAK</a>
				
				<br/>
				<br/>
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
					// koneksi database
					include '../koneksi.php';

					

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
			</div>
		</div>
		<?php } ?>

	</div>

	<?php include 'footer.php'; ?>