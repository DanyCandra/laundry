<?php 
// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
$id = $_POST['id'];
$pelanggan = $_POST['pelanggan'];
$berat = $_POST['berat'];
$tanggal_selesai = $_POST['tanggal_selesai'];
$harga=$_POST['harga'];
$status = $_POST['status'];

// mengambil data harga per kilo dari database
$h = mysqli_query($koneksi,"select harga from harga where id=$harga");
$harga_per_kilo = mysqli_fetch_assoc($h);

// menghitung harga laundry, harga perkilo x berat cucian
$total_harga = $berat * $harga_per_kilo['harga'];


// update data transaksi
mysqli_query($koneksi,"update transaksi set id_pelanggan='$pelanggan', id_harga='$harga',total_harga='$total_harga', berat='$berat', tanggal_selesai='$tanggal_selesai', status='$status' where id='$id'");


// menangkap data form input array (jenis pakaian dan jumlah pakaian)
$jenis_pakaian = $_POST['jenis_pakaian'];
$jumlah_pakaian = $_POST['jumlah_pakaian'];


// menghapus semua pakaian dalam transaksi ini
mysqli_query($koneksi,"delete from transaksi_detail where id_transaksi='$id'");

// input ulang data cucian berdasarkan id transaksi (invoice) ke table pakaian
for($x=0;$x<count($jenis_pakaian);$x++){
	if($jenis_pakaian[$x] != ""){
		mysqli_query($koneksi,"INSERT INTO `database_serkom`.`transaksi_detail` (`id_transaksi`, `jenis`, `jumlah`) VALUES ('$id', '$jenis_pakaian[$x]','$jumlah_pakaian[$x]');");
		//mysqli_query($koneksi,"insert into transaksi_detail values('','$id','$jenis_pakaian[$x]','$jumlah_pakaian[$x]')");
	}
}


header("location:transaksi.php");

?>