<?php 

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
$nama = $_POST['nama'];
$telepon = $_POST['telepon'];
$alamat = $_POST['alamat'];
$keterangan = $_POST['keterangan'];

// input data ke tabel pelanggan
mysqli_query($koneksi,"insert into pelanggan values('','$nama','$alamat','$telepon','$keterangan')");

header("location:pelanggan.php");

?>