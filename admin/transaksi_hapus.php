<?php 
// menghubungkan koneksi
include '../koneksi.php';

// menangkap data id yang dikirim dari url
$id = $_GET['id'];

// menghapus data pakaian dalam transaksi ini
mysqli_query($koneksi,"delete from transaksi_detail where id_transaksi='$id'");

// menghapus transaksi
mysqli_query($koneksi,"delete from transaksi where id='$id'");



// alihkan halaman ke halaman transaksi
header("location:transaksi.php");
?>