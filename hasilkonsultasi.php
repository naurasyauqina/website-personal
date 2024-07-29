<?php
session_start();
error_reporting(0);
require_once "koneksi.php";
include "library.php";

$id=$_SESSION['id_user'];


cek_akses(3);
head('Konsultasi',1);




style(1); ?>
<body >
<?php
menu();
include "template/kiri.php";

$quser=mysqli_query($koneksi,"select * from tbuser where id_user='$id'");
$user=mysqli_fetch_array($quser)
?>
<h4><span>Hasil Konsultasi</span></h4>
<?php
echo"<h4><b>Data Diri :</b></h4>";
echo"<table class='table table-condensed table-bordered'>
<tr><th>Tgl. Konsultasi</th><td>".date('d-m-Y')."</td></tr>
<tr><th>Id User</th> <td>$user[id_user] </td></tr>
<tr><th>Nama Lengkap</th> <td>$user[nm_pengguna] </td></tr>
<tr><th>Nohp</th> <td>$user[nohp] </td></tr>
<tr><th>Email</th> <td>$user[email] </td></tr>
</table>";
echo"<h4><b>Gejala Dipilih :</b></h4>
<table class='table'>
<tr><th>Id Gejala</th> <th>Gejala</th></tr>";
$s="$_GET[gjl]";
$pecahgp=explode(",",$s);
foreach($pecahgp as $gejd => $value2){
	$qb=mysqli_query($koneksi,"select * from tbgejala where id_gejala='$value2'");
	$b=mysqli_fetch_array($qb);
	echo"<tr><td>$value2</td><td>$b[nm_gejala]</td></tr>";
}
echo"</table>";

$p=mysqli_query($koneksi,"select * from penyakit order by id_penyakit");
while($rp=mysqli_fetch_array($p)){
	$atas=0;
	$bawah=0;
$jb=mysqli_query($koneksi,"select * from rule where id_penyakit='$rp[id_penyakit]'");
$bawah=mysqli_num_rows($jb);
	$pecahgp=explode(",",$s);
foreach($pecahgp as $gejd => $value){
	$qrule=mysqli_query($koneksi,"select * from rule where id_penyakit='$rp[id_penyakit]'");
	while($rule=mysqli_fetch_array($qrule)){
		if($value=="$rule[id_gejala]"){
			$atas=$atas+1;
		}
	}
}	

$idk="$rp[id_penyakit]";
$hp[$idk]=$atas/$bawah;
//echo"$atas/$bawah<br/>";
}

$max=max($hp);
$p2=mysqli_query($koneksi,"select * from penyakit order by id_penyakit");
while($h2=mysqli_fetch_array($p2)){
	$idk="$h2[id_penyakit]";
	
	if($max==$hp[$idk] and $max==1){
		echo"<div align='justify'> Gigi anda terdiagnosa penyakit : $h2[nm_penyakit]</br>";
		echo"Keterangan : $h2[keterangan]</div></br>";
		mysqli_query($koneksi,"insert into tbhasil_konsultasi values('', '$_SESSION[id_user]', '$_SESSION[username]','$h2[id_penyakit]',now(),'$s')");
		
		$terdeteksi="ya";
	}
}

if($terdeteksi!="ya"){
	echo"Penyakit tidak terdeteksi!!";
}
$c=mysqli_query($koneksi,"select * from tbhasil_konsultasi where username='$_SESSION[username]' order by tgl_hasil desc");
$cetak=mysqli_fetch_array($c);
echo"<p><a class='btn btn-info' href='cetak.php?id=$cetak[id_hasil]&id_u=$id&gjl=$_GET[gjl]' target='_blank'>Cetak Hasil Konsultasi</a></p>";
include "template/kanan.php";
include "template/footer.php";
?>




