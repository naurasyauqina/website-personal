<body onLoad="print()">
<link rel='stylesheet' href='bootstrap/css/bootstrap.min.css'>
		
		<link rel='stylesheet' href='bootstrap/css/style.css'>
		
		<script src='bootstrap/js/jquery-3.1.1.js'></script>
		<script src='bootstrap/js/bootstrap.min.js'></script>
    <br>
    <br>

    <table width="1000" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr>
        <td align="center" style="border-bottom:2px #000 solid"><b>Sistem Pakar Diagnosa Penyakit Pulpitis Pada Gigi Manusia</b><br />
         <b>Praktek Gigi Drg.Fahreni</b><br><b>Dharmasraya, Sumatera Barat, Indonesia</b></td>
      </tr>
    </tr>
    </table><br><br>
<h4 align="center"><b>Hasil Konsultasi</b></h4><br>
<?php

error_reporting(0);
include "koneksi.php";
$h=mysqli_query($koneksi,"select * from tbhasil_konsultasi where id_hasil='$_GET[id]'");
$hasil=mysqli_fetch_array($h);
$quser=mysqli_query($koneksi,"select * from tbuser where id_user='$_GET[id_u]'");
$user=mysqli_fetch_array($quser);

echo"<h4><b>Data Diri :</b</h4>";
echo"<table class='table table-condensed table-bordered' border=1>
<tr><th>Tgl. Konsultasi</th><td>".date('d-m-Y')."</td></tr>
<tr><th>Id User</th> <td>$user[id_user] </td></tr>
<tr><th>Nama Lengkap</th> <td>$user[nm_pengguna] </td></tr>
<tr><th>Nohp</th> <td>$user[nohp] </td></tr>
<tr><th>Email</th> <td>$user[email] </td></tr>
</table>";
echo"<h4><b>Gejala Dipilih :</b></h4>
<table class='table table-condensed table-bordered' border=1>
<tr><th>Id Gejala</th> <th>Gejala</th></tr>";
$s="$_GET[gjl]";
$pecahgp=explode(",",$s);
foreach($pecahgp as $gejd => $value2){
	$qb=mysqli_query($koneksi,"select * from tbgejala where id_gejala='$value2'");
	$b=mysqli_fetch_array($qb);
	echo"<tr><td>$value2</td><td>$b[nm_gejala]</td></tr>";
}
echo"</table><br>";

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
		echo"Gigi anda terdiagnosa penyakit : $h2[nm_penyakit])</br>";
		echo"Keterangan : $h2[keterangan]</br>";
		//mysqli_query($koneksi,"insert into tbhasil_konsultasi values('','$_SESSION[username]','$h2[id_penyakit]',now(),'$s')");
		
		$terdeteksi="ya";
	}
}

if($terdeteksi!="ya"){
	echo"penyakit tidak terdeteksi!!";
}

?>
</body>