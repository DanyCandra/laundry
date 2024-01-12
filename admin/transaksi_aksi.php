<?php 
// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
$pelanggan = $_POST['pelanggan'];
$berat = $_POST['berat'];
$tanggal_selesai = $_POST['tanggal_selesai'];
$harga=$_POST['harga'];
$tgl_hari_ini = date('Y-m-d h:i:sa');
$status = 0;


//mengambil data harga per kilo dari database
$h = mysqli_query($koneksi,"select harga from harga where id=$harga");
$harga_per_kilo = mysqli_fetch_assoc($h);


// menghitung harga laundry, harga perkilo x berat cucian
$total_harga = $berat * $harga_per_kilo['harga'];


// input data ke tabel transaksi
mysqli_query($koneksi,"INSERT INTO transaksi (`id_pelanggan`, `id_admin`, `id_harga`, `tanggal_transaksi`, `tanggal_selesai`, `berat`, `total_harga`, `status`) VALUES ($pelanggan, 1, $harga, now(), '$tanggal_selesai', $berat, $total_harga, $status)");

// menyimpan id dari data yang di simpan pada query insert data sebelumnya
$id_terakhir = mysqli_insert_id($koneksi);


// menangkap data form input array (jenis pakaian dan jumlah pakaian)
$jenis_pakaian = $_POST['jenis_pakaian'];
$jumlah_pakaian = $_POST['jumlah_pakaian'];
$keterangan = $_POST['keterangan'];

// input data cucian berdasarkan id transaksi (invoice) ke table pakaian
for($x=0;$x<count($jenis_pakaian);$x++){
	if($jenis_pakaian[$x] != ""){
		mysqli_query($koneksi,"INSERT INTO `database_serkom`.`transaksi_detail` (`id_transaksi`, `jenis`, `jumlah`,`keterangan`) VALUES ('$id_terakhir', '$jenis_pakaian[$x]','$jumlah_pakaian[$x]', '$keterangan[$x]');");

	}
}


header("location:transaksi.php");

?>