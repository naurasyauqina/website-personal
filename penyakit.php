<?php
session_start();
require_once "koneksi.php";
include "library.php";
head('Informasi Penyakit',1);
style(1); ?>
<body>
<?php
menu();
include "template/kiri.php";
?>
<h1>Data Penyakit</h1>
<?php
$id = $_GET['id_penyakit'];
$kueri = mysqli_query($koneksi,"select * from penyakit where id_penyakit='$id'");
?>
<?php
while ($isi=mysqli_fetch_array($kueri,MYSQLI_BOTH)){ ?>

<div class='form-group' align='justify'>
	<label for="Tketerangan" class="label-control">Keterangan Penyakit :</label>
	<?php echo $isi['keterangan']; ?>
</div>

<?php
}
include "template/kanan.php";
include "template/footer.php";
?>
