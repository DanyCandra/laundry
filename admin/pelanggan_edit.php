<?php include 'header.php'; ?>

<div class="container">	
	<br/>
	<br/>
	<br/>
	<div class="col-md-5 col-md-offset-3">
		
		<div class="panel">
			<div class="panel-heading">
				<h4>Edit Pelanggan</h4>
			</div>
			<div class="panel-body">

				<?php 
				// menghubungkan koneksi
				include '../koneksi.php';

				// menangkap id yang dikirim melalui url
				$id = $_GET['id'];

				// megambil data pelanggan yang ber id di atas dari tabel pelanggan
				$data = mysqli_query($koneksi,"select * from pelanggan where pelanggan.id='$id'");
				while($d=mysqli_fetch_array($data)){
					?>

					<form method="post" action="pelanggan_update.php">
						<div class="form-group">
							<label>Nama</label>
							<!-- form id pelanggan yang di edit, untuk di kirim ke file aksi -->
							<input type="hidden" name="id" value="<?php echo $d['id']; ?>">
							
							<input type="text" class="form-control" name="nama" placeholder="Masukkan nama .." value="<?php echo $d['nama']; ?>">
						</div>	

						<div class="form-group">
							<label>HP</label>
							<input type="number" class="form-control" name="telepon" placeholder="Masukkan no.hp .." value="<?php echo $d['telepon']; ?>">
						</div>	

						<div class="form-group">
							<label>Alamat</label>
							<input type="text" class="form-control" name="alamat" placeholder="Masukkan alamat .." value="<?php echo $d['alamat']; ?>">
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