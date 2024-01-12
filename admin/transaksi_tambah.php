<?php include 'header.php'; ?>

<?php 

// koneksi database
include '../koneksi.php';
?>
<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>Transaksi Laundry Baru</h4>
		</div>
		<div class="panel-body">

			

			<div class="col-md-8 col-md-offset-2">
				<a href="transaksi.php" class="btn btn-sm btn-info pull-right">Kembali</a>
				<br/>
				<br/>
				<form method="post" action="transaksi_aksi.php">
					<div class="form-group">
						<label>Pelanggan</label>
						<select class="form-control" name="pelanggan" required="required">	
							<option value="">- Pilih Pelanggan</option>						
							<?php 						
							// mengambil data pelanggan dari database
							$data = mysqli_query($koneksi,"select * from pelanggan");						
							// mengubah data ke array dan menampilkannya dengan perulangan while
							while($d=mysqli_fetch_array($data)){
								?>
								<option value="<?php echo $d['id']; ?>"><?php echo $d['nama']; ?></option>								
								<?php 
							}
							?>		
						</select>				
					</div>	

					<div class="form-group">
						<label>Berat</label>
						<input type="number" class="form-control" name="berat" placeholder="Masukkan berat cucian .." required="required">
					</div>	

					<div class="form-group">
						<label>Tgl. Selesai</label>
						<input type="date" class="form-control" name="tanggal_selesai" required="required">
					</div>
					
					<div class="form-group">
						<label>Jenis Harga</label>
						<select class="form-control" name="harga" required="required">	
							<option value="">- Pilih Jenis Harga</option>						
							<?php 						
							// mengambil data pelanggan dari database
							$harga = mysqli_query($koneksi,"select * from harga");						
							// mengubah data ke array dan menampilkannya dengan perulangan while
							while($h=mysqli_fetch_array($harga)){
								?>
								<option value="<?php echo $h['id']; ?>"><?php echo $h['jenis']; ?><?php echo ' - '; ?><?php echo $h['harga']; ?></option>								
								<?php 
							}
							?>		
						</select>				
					</div>

					<br/>

					<table class="table table-bordered table-striped">
						<tr>
							<th>Jenis Pakaian</th>
							<th width="20%">Jumlah</th>
							<th>Keterangan</th>
						</tr>
						<tr>
							<td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
							<td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
							<td><input type="text" class="form-control" name="keterangan[]"></td>
						</tr>
						<tr>
							<td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
							<td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
							<td><input type="text" class="form-control" name="keterangan[]"></td>
						</tr>
						<tr>
							<td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
							<td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
							<td><input type="text" class="form-control" name="keterangan[]"></td>
						</tr>
						<tr>
							<td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
							<td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
							<td><input type="text" class="form-control" name="keterangan[]"></td>
						</tr>
						<tr>
							<td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
							<td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
							<td><input type="text" class="form-control" name="keterangan[]"></td>
						</tr>
						<tr>
							<td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
							<td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
							<td><input type="text" class="form-control" name="keterangan[]"></td>
						</tr>
						<tr>
							<td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
							<td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
							<td><input type="text" class="form-control" name="keterangan[]"></td>
						</tr>
						<tr>
							<td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
							<td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
							<td><input type="text" class="form-control" name="keterangan[]"></td>
						</tr>
						<tr>
							<td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
							<td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
							<td><input type="text" class="form-control" name="keterangan[]"></td>
						</tr>
						<tr>
							<td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
							<td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
							<td><input type="text" class="form-control" name="keterangan[]"></td>
						</tr>
					</table>

					<input type="submit" class="btn btn-primary" value="Simpan">	
				</form>

			</div>
			
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>