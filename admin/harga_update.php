<?php 
// menghubungkan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
$id = $_POST['id'];
$jenis = $_POST['jenis'];
$harga = $_POST['harga'];
$keterangan = $_POST['keterangan'];

// update data
mysqli_query($koneksi,"update harga set jenis='$jenis', harga='$harga', tanggal_update=now(), keterangan='$keterangan' where id=$id");

// mengalihkan halaman kembali ke halaman pelanggan
header("location:harga.php");

?>