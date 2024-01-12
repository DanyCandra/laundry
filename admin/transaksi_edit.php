<?php include 'header.php'; ?>

<?php 

// koneksi database
include '../koneksi.php';
?>
<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>Edit Transaksi Laundry</h4>
		</div>
		<div class="panel-body">
			<div class="col-md-8 col-md-offset-2">
				<a href="transaksi.php" class="btn btn-sm btn-info pull-right">Kembali</a>
				<br/>
				<br/>
				<?php 
				// menangkap id yang dikirim melalui url
				$id = $_GET['id'];

				// megambil data pelanggan yang ber id di atas dari tabel pelanggan
				$transaksi = mysqli_query($koneksi,"select * from transaksi where id='$id'");
				while($t=mysqli_fetch_array($transaksi)){
					?>
					<form method="post" action="transaksi_update.php">
						<!-- menyimpan id transaksi yang di edit dalam form hidden berikut -->
						<input type="hidden" name="id" value="<?php echo $id; ?>">

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
									<option <?php if($d['id']==$t['id_pelanggan']){echo "selected='selected'";} ?> value="<?php echo $d['id']; ?>"><?php echo $d['nama']; ?></option>								
									<?php 
								}
								?>		
							</select>				
						</div>	

						<div class="form-group">
							<label>Berat</label>
							<input type="number" class="form-control" name="berat" placeholder="Masukkan berat cucian .." required="required" value="<?php echo $t['berat']; ?>">
						</div>	

						<div class="form-group">
							<label>Tgl. Selesai</label>
							<input type="date" class="form-control" name="tanggal_selesai" required="required" value="<?php echo $t['tanggal_selesai']; ?>">
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
								<option <?php if($h['id']==$t['id_harga']){echo "selected='selected'";} ?> value="<?php echo $h['id']; ?>"><?php echo $h['jenis']; ?><?php echo ' - '; ?><?php echo $h['harga']; ?></option>										
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
							</tr>		

							<?php 
							// menyimpan id transaksi ke variabel id_transaksi
							$id_transaksi = $t['id'];

							// menampilkan pakaian-pakaian dari transaksi yang ber id di atas
							$pakaian = mysqli_query($koneksi,"select * from transaksi_detail where transaksi_detail.id_transaksi='$id_transaksi'");

							while($p=mysqli_fetch_array($pakaian)){
								?>					
								<tr>
									<td><input type="text" class="form-control" name="jenis_pakaian[]" value="<?php echo $p['jenis']; ?>"></td>
									<td><input type="number" class="form-control" name="jumlah_pakaian[]" value="<?php echo $p['jumlah']; ?>"></td>
								</tr>
								<?php } ?>
								<tr>
									<td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
									<td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
								</tr>
								<tr>
									<td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
									<td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
								</tr>
								<tr>
									<td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
									<td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
								</tr>
								<tr>
									<td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
									<td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
								</tr>						
							</table>

							<div class="form-group alert alert-info">
								<label>Status</label>
								<select class="form-control" name="status" required="required">										
									<option <?php if($t['status']=="0"){echo "selected='selected'";} ?> value="0">PROSES</option>																		
									<option <?php if($t['status']=="1"){echo "selected='selected'";} ?> value="1">DI CUCI</option>																		
									<option <?php if($t['status']=="2"){echo "selected='selected'";} ?> value="2">SELESAI</option>																		
								</select>				
							</div>	

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