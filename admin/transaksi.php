<?php include 'header.php'; ?>

<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>Data Transaksi Laundry</h4>
		</div>
		<div class="panel-body">

			<a href="transaksi_tambah.php" class="btn btn-sm btn-info pull-right">Transaksi Baru</a>
			
			<br/>
			<br/>

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
					<th width="20%">OPSI</th>
				</tr>

				<?php 
				// koneksi database
				include '../koneksi.php';

				// mengambil data pelanggan dari database
				$data = mysqli_query($koneksi,"select * from pelanggan,transaksi where id_pelanggan=pelanggan.id order by transaksi.id desc");
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
						<td>
							<a href="transaksi_invoice.php?id=<?php echo $d['id']; ?>" target="_blank" class="btn btn-sm btn-warning">Invoice</a>
							<a href="transaksi_edit.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-info">Edit</a>
							<a href="transaksi_hapus.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-danger">Batalkan</a>
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