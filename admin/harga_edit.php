<?php include 'header.php'; ?>

<div class="container">	
	<br/>
	<br/>
	<br/>
	<div class="col-md-5 col-md-offset-3">
		
		<div class="panel">
			<div class="panel-heading">
				<h4>Edit Harga</h4>
			</div>
			<div class="panel-body">

				<?php 
				// menghubungkan koneksi
				include '../koneksi.php';

				// menangkap id yang dikirim melalui url
				$id = $_GET['id'];

				// megambil data harga yang ber id di atas dari tabel harga
				$data = mysqli_query($koneksi,"select * from harga where harga.id='$id'");
				while($d=mysqli_fetch_array($data)){
					?>

					<form method="post" action="harga_update.php">
						<div class="form-group">
							<label>Jenis</label>
							<!-- form id pelanggan yang di edit, untuk di kirim ke file aksi -->
							<input type="hidden" name="id" value="<?php echo $d['id']; ?>">
							
							<input type="text" class="form-control" name="jenis" placeholder="Masukkan jenis harga .." value="<?php echo $d['jenis']; ?>">
						</div>	

						<div class="form-group">
							<label>HP</label>
							<input type="number" class="form-control" name="harga" placeholder="Masukkan harga .." value="<?php echo $d['harga']; ?>">
						</div>	

						<div class="form-group">
							<label>Keterangan</label>
							<input type="text" class="form-control" name="keterangan" value="<?php echo $d['keterangan']; ?>">
						</div>	

						<br/>

						<input type="submit" class="btn btn-primary" value="Simpan">	
					</form>

					<?php 
				}
				?>
			</div>
		</div>
	</div>

</div>

<?php include 'footer.php'; ?>