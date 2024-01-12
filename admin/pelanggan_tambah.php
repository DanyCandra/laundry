<?php include 'header.php'; ?>

<div class="container">	
	<br/>
	<br/>
	<br/>
	<div class="col-md-5 col-md-offset-3">
		
		<div class="panel">
			<div class="panel-heading">
				<h4>Tambah Pelanggan Baru</h4>
			</div>
			<div class="panel-body">


				<form method="post" action="pelanggan_aksi.php">
					<div class="form-group">
						<label>Nama *</label>
						<input type="text" class="form-control" name="nama" placeholder="Masukkan nama ..">
					</div>	

					<div class="form-group">
						<label>Telepon *</label>
						<input type="number" class="form-control" name="telepon" placeholder="Masukkan no.telepon ..">
					</div>	

					<div class="form-group">
						<label>Alamat</label>
						<input type="text" class="form-control" name="alamat" placeholder="Masukkan alamat ..">
					</div>	

					<div class="form-group">
						<label>Keterangan</label>
						<input type="text" class="form-control" name="keterangan" placeholder="Masukan Keterangan .." value="-">
					</div>	

					<br/>

					<input type="submit" class="btn btn-primary" value="Simpan">	
				</form>


			</div>
		</div>
	</div>

</div>

<?php include 'footer.php'; ?>