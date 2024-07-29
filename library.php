<?php
function kode($tb,$fb,$kd){
include "koneksi.php";
$perintah="select $fb as 'kode' from {$tb} order by kode asc;";
$run=mysqli_query($koneksi, $perintah);
$hasil="";
if(mysqli_num_rows($run) < 1) $hasil=$kd."01";
else{
	while($isi=mysqli_fetch_array($run,MYSQLI_BOTH)){
		$kode=intval(substr($isi['kode'],-3));
		$kode++;
		if($kode<=9) $hasil="${kd}0{$kode}";
			else if($kode<=99 && $kode>=10) $hasil="{$kd}0{$kode}";
			else if($kode<=999 && $kode>100) $hasil="{$kd}{$kode}";
			else $hasil="{$kd}{$kode}";
			}
}
mysqli_free_result($run);
return $hasil;
}
function style($posisi=1){
	switch($posisi){
		case 1 : {
			include "template/style.php";
			break;
			}
		case 2 : {
			include "../template/style.php";
			}
		default : {
			}
		}
}
function head($judul="Halaman",$posisi=1){
	switch($posisi){
	case 1 : {
		echo "
		<!DOCTYPE html>
		<html lang='en'>
		<head>
		<title>$judul</title>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='bootstrap/css/bootstrap.min.css'>
		
		<link rel='stylesheet' href='bootstrap/css/style.css'>
		
		<script src='bootstrap/js/jquery-3.1.1.js'></script>
		<script src='bootstrap/js/bootstrap.min.js'></script>
		";
		break;
		}
	case 2 : {
		echo "
		<!DOCTYPE html>
		<html lang='en'>
		<head>
		<title>$judul</title>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='../bootstrap/css/bootstrap.min.css'>
		<script src='../bootstrap/js/jquery-3.1.1.js'></script>
		<script src='../bootstrap/js/bootstrap.min.js'></script>
		";
		break;
		}
	default : {
		}
	}
}
function menu(){
	?>
	
	<div class=' text-center'>
	<img src='/pakar/gambar/banner6.jpg' width:"400" height:"200" alt='pakar' class='img img-responsive'>
	<nav class='navbar navbar-inverse' style=' 
		font-family:serif;
	'>
	
	<div class='navbar-header'>
	<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
	<span class='icon-bar'></span>
	<span class='icon-bar'></span>
	<span class='icon-bar'></span>                        
	</button>
	</div>
    <div class='collapse navbar-collapse' id='myNavbar'>
    <ul class='nav navbar-nav'>
    <li class=''><a href='../../pakar'>BERANDA</a></li>
    </ul>
    <ul class='nav navbar-nav'>
	
  <?php
    if(isset($_SESSION['id_tipe'])){
    switch($_SESSION['id_tipe']){
		case 1 : {
			echo "
			<li class='dropdown'>
			<a class='dropdown-toggle' data-toggle='dropdown' href='/pakar/kelola_member/member.php'>Data Konsultasi
			<span class='caret'></span></a>
			<ul class='dropdown-menu'>
			<li><a href='/pakar/kelola_penyakit/penyakit.php'>Kelola Penyakit</a></li>
			<li><a href='/pakar/kelola_gejala/gejala.php'>Kelola Gejala</a></li>
			<li><a href='/pakar/kelola_rule/rule.php'>Kelola Rule</a></li>
			</ul>
			</li>
			<li class='dropdown'>
			<a class='dropdown-toggle' data-toggle='dropdown' href=#'>Data Member
			<span class='caret'></span></a>
			<ul class='dropdown-menu'>
			<li><a href='/pakar/kelola_member/member.php'>Kelola Member</a></li>
			</ul>
			</li>
			<li><a href='/pakar/kelola_saran/saran.php'>Kelola Saran</a></li>
			<li><a href='/pakar/laporan/diagnosa.php'>Laporan Konsultasi</a></li>
			";
			break;}
		case 3 : {
			echo "<li><a href='konsultasi.php?hal=1'>Konsultasi</a></li>";
			echo "<li><a href='galeri.php'>Galeri</a></li>";
			echo "<li><a href='informasi_penyakit.php'>Informasi Penyakit</a></li>";
			echo "<li><a href='saran.php'>Kritik &amp; Saran</a></li>";
			break;}
		}		
	} else {
		echo "<li><a href='galeri.php'>GALERI</a></li>";
		echo "<li><a href='informasi_penyakit.php'>INFORMASI PENYAKIT</a></li>";
		echo "<li><a href='saran.php'>KRITIK &amp; SARAN</a></li>";
	}
	echo "</ul><ul class='nav navbar-nav navbar-right'>";
	if(!isset($_SESSION['username'])){
	echo "
	<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
	<li><a href='registrasi.php'><span class='glyphicon glyphicon-log-in'></span> Registrasi</a></li>
	";
	}
	else {
	echo "
	<li><a href='/pakar'><span class='glyphicon glyphicon-user'></span> Hai, {$_SESSION['username']}</a></li>
	<li><a href='/pakar/logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>
	";
	}
	echo "</ul></div></div></nav>";
}

function cek_akses($akses=1){
	if(empty($_SESSION['id_tipe'])) header('Location:/pakar/login.php');
	if($_SESSION['id_tipe']!=$akses) header('Location:/pakar');
}

function cek_login(){
	if(!isset($_SESSION['id_tipe'])) header('Location:/pakar');
	}
function pesan($jenis = 'success',$pesan='',$pilihan=0){
	switch($pilihan){
	case 0 : {
		$_SESSION['pesan']="
		<br/><div class='alert alert-{$jenis} alert-dismissable'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<strong>Pesan!</strong><br/>$pesan
		</div>";
		$pesan = $_SESSION['pesan'];
		break;
		}
	case 1 : {
		if (!isset($_SESSION['pesan'])) return null;
		$pesan = $_SESSION['pesan'];
		unset($_SESSION['pesan']);
	}
}
RETURN $pesan;
}
function tanggal_indo($hari,$bulan,$tahun){
	 $hari_tmp = date("l", mktime(0, 0, 0, $bulan, $hari, $tahun));
	 $bulan_tmp = date("F", mktime(0, 0, 0, $bulan, $hari, $tahun));
	 $tahun_tmp = date("Y", mktime(0, 0, 0, $bulan, $hari, $tahun));
	 switch($hari_tmp){
		 case "Monday" : {
			$ket_hari = "Senin";
			break;
			}
		 case "Sunday" : {
			$ket_hari = "Minggu";
			break;
			}
		 case "Tuesday" : {
			$ket_hari = "Selasa";
			break;
			}
		 case "Wednesday" : {
			$ket_hari = "Rabu";
			break;
			}
		 case "Thursday" : {
			$ket_hari = "Kamis";
			break;
			}
		 case "Friday" : {
			$ket_hari = "Jumat";
			break;
			}
		 case "Saturday" : {
			$ket_hari = "Sabtu";
			break;
			}
		 }
	switch($bulan_tmp){
		case "January" : {
			$ket_bln = "Januari";
			break;
		}
		case "February" : {
			$ket_bln = "Februari";
			break;
		}
		case "March" : {
			$ket_bln = "Maret";
			break;
		}
		case "April" : {
			$ket_bln = "April";
			break;
		}
		case "May" : {
			$ket_bln = "Mei";
			break;
		}
		case "Juny" : {
			$ket_bln = "Juni";
			break;
		}
		case "July" : {
			$ket_bln = "Juli";
			break;
		}
		case "August" : {
			$ket_bln = "Agustus";
			break;
		}
		case "September" : {
			$ket_bln = "September";
			break;
		}
		case "October" : {
			$ket_bln = "Oktober";
			break;
		}
		case "November" : {
			$ket_bln = "November";
			break;
		}
		case "December" : {
			$ket_bln = "Desember";
			break;
		}
	 }
	 RETURN $ket_hari.", ".date('d')." ".$ket_bln." ".$tahun_tmp;
}
?>
