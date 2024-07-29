<?php
session_start();
require_once "koneksi.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$nm = $_POST['Tnm_pengguna'];
	$saran = $_POST['Tsaran'];
	$kueri = mysqli_query($koneksi, "insert into tbsaran (nama,saran) values ('$nm','$saran');");
	if($kueri) header('Location:saran.php');
}
include "library.php";
head('Kritik &amp; Saran',1);
style(1); ?>
<style type="text/css">
<!--
.style1 {font-family: Georgia, "Times New Roman", Times, serif}
.style2 {
	font-size: 16px;
	font-family: Georgia, "Times New Roman", Times, serif;
}
-->
</style>
<body>
<?php
menu();
?>
<?php
include "template/kiri.php";
?>

<h1 class="style1">Kritik &amp; Saran</h1>
<form method="POST">
<div class='form-group'>
	<label for="Tnm_pengguna" class="label-control style1">Nama Anda :</label>
	<input id="Tnm_pengguna" class="form-control" type="text" name="Tnm_pengguna" maxlength=30 required placeholder="Name Anda"/>
</div>
<div class='form-group'>
	<label for="Tsaran" class="label-control style1">Saran &amp; Kritik : </label>
	<textarea id="Tsaran" class="form-control" type="text" name="Tsaran" minlength=10 rows=10  required placeholder="saran & Kritik"></textarea>
</div>
<button type="submit" name="Bsimpan" class="btn btn-success">Kirim</button>
<button type="reset" class="btn btn-danger">Ulangi</button>
</form>
<br/>
<br/>
<fieldset>
	<legend><h2 class="style2">Kritik &amp; Saran</h2>
	</legend>
<div class="row">
<?php
$kueri = mysqli_query($koneksi, "select * from tbsaran");
if(mysqli_num_rows($kueri) < 1) {
	echo "<strong><center>Kritik dan Saran masih kosong...</center></strong><br/><br/>";
}
else {
while ($isi=mysqli_fetch_array($kueri,MYSQLI_BOTH)){
$hari = substr($isi['tgl_kirim'],8,2);
$bulan = substr($isi['tgl_kirim'],5,2);
$tahun = substr($isi['tgl_kirim'],0,4);
?>
<div class="col-sm-12">
<h4><?php echo $isi['nama']; ?> <small><?php echo tanggal_indo($hari,$bulan,$tahun); ?></small></h4>
<p><?php echo $isi['saran']; ?></p>
<br>
</div>
<?php
}
}
?>
</div>
</fieldset>
<?php
include "template/kanan.php";
include "template/footer.php";
?>
