<?php
session_start();
error_reporting(0);
require_once "koneksi.php";
include "library.php";
cek_akses(3);
head('Konsultasi',1);
style(1); ?>
<style type="text/css">
<!--
.style1 {font-family: Georgia, "Times New Roman", Times, serif}
.style2 {font-family: Georgia, "Times New Roman", Times, serif; font-size: 36px; }
-->
</style>
<body>
<?php
menu();
include "template/kiri.php";

$gejala=mysqli_query($koneksi,"select * from tbgejala");
$jml=mysqli_num_rows($gejala);
?>
<h3 class="style2">Konsultasi</h3>
</hr>
<p><span class="style1">Jawablah Pertanyaan Sesuai dengan Gejala Penyakit Gigi Anda !!!</span><?php echo "$_GET[hal]"; ?> <span class="style1">dari</span> <?php echo "$jml"; ?></p>

<?php
$posisi=$_GET['hal']-1;
$g=mysqli_query($koneksi,"select * from tbgejala order by id_gejala asc limit $posisi,1");
$r=mysqli_fetch_array($g);
?>
<table class='table'>
<tr><td align='center'><span class="style1">Apakah </span><?php echo " $r[nm_gejala]"; ?>..?</td>
</tr>
<tr>
<?php
if($_GET['gjl']!=""){
	$gjl="$_GET[gjl],$r[id_gejala]";
}else{
	$gjl="$r[id_gejala]";
}
if($jml=="$_GET[hal]"){
	echo"<tr><td align='center'>";
	echo"<a href='hasilkonsultasi.php?gjl=$gjl' class='btn btn-info btn-lg'>Ya</a>";
	echo"<a href='hasilkonsultasi.php?gjl=$_GET[gjl]' class='btn btn-danger btn-lg'>Tidak</a>";
echo"</td></tr>";
}else{
	$hal=$_GET[hal]+1;
	echo"<tr><td align='center'>";
	echo"<a href='konsultasi.php?hal=$hal&gjl=$gjl' class='btn btn-info btn-lg'>Ya</a>";
	echo"<a href='konsultasi.php?hal=$hal&gjl=$_GET[gjl]' class='btn btn-danger btn-lg'>Tidak</a>";
echo"</td></tr>";
}
?>

</table>
<?php
include "template/kanan.php";
include "template/footer.php";
?>
