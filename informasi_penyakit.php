<?php
session_start();
require_once "koneksi.php";
include "library.php";
head('Informasi Penyakit',1);
style(1); ?>
<style type="text/css">
<!--
.style1 {font-family: Georgia, "Times New Roman", Times, serif}
-->
</style>
<body>
<?php
menu();
include "template/kiri.php";
?>
<h1 class="style1">Informasi Penyakit</h1>
<?php
$kueri = mysqli_query($koneksi,"select id_penyakit,nm_penyakit from penyakit");
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title style1">Informasi Penyakit</h3>
  </div>
  <div class="panel-body">
    <ol>
		<?php 
		if(mysqli_num_rows($kueri) < 1) echo "Data Penyakit Kosong...";
		else {
			while ($isi=mysqli_fetch_array($kueri,MYSQLI_BOTH)){
				echo "<li><a href='penyakit.php?id_penyakit={$isi['id_penyakit']}'>{$isi['nm_penyakit']}</a></li>";
				}
			}
		?>
    </ol>
  </div>
</div>
<?php
include "template/kanan.php";
include "template/footer.php";
?>
