<?php 
// menghubungkan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$telepon = $_POST['telepon'];
$alamat = $_POST['alamat'];
$keterangan = $_POST['keterangan'];

// update data
mysqli_query($koneksi,"update pelanggan set nama='$nama', telepon='$telepon', alamat='$alamat', keterangan='$keterangan' where id='$id'");

// mengalihkan halaman kembali ke halaman pelanggan
header("location:pelanggan.php");

?>