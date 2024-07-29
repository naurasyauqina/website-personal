<?php
session_start();
require_once "koneksi.php";
if(isset($_SESSION['username'])) header('Location:/pakar');
include "library.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){



	$username = $_POST['Tusername'];
	$password = $_POST['Tpassword'];
	//$a="rafiq";
	//echo md5($a);
	
	//echo "select * from admin where username='$username' and password=md5('$password');";
	
	if($_POST['level']==1){
		$kueri = mysqli_query($koneksi, "select * from admin where username='$username' and password='$password';");
	}else{
	$kueri = mysqli_query($koneksi, "select * from tbuser where username='$username' and password=$password;");
	}
	if(mysqli_num_rows($kueri) > 0) {
		while ($isi=mysqli_fetch_array($kueri,MYSQLI_BOTH)){
		$_SESSION['username']=$isi['username'];
		$_SESSION['id_user']=$isi['id_user'];
			if($_POST['level']==1){
			$_SESSION['id_tipe']=1;
			}else{
			$_SESSION['id_tipe']=3;
			$_SESSION['id_user']=$isi['id_user'];
				
			}
		}
		$pesan = pesan('success',"Anda berhasil login.",0);
		header('Location:index.php');
	}
	else $pesan = pesan('danger',"Username dan Password tidak cocok.",0);
}
else $pesan="";
head('Login',1);
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
<h1 class="style1">Login</h1>
<?php $pesan; ?>
<form method="POST">
<div class='form-group'>
	<label for="Tusername" class="label-control style1" ><strong>Username :</strong></label>
	<input id="Tusername" class="form-control" type="text" name="Tusername" maxlength=20 minlength=3 required placeholder="Username"/>
</div>
<div class='form-group'>
	<label for="Tusername" class="label-control style1">level :</label>
	<select name='level' class='form-control'>
	<option value=''>Pilih Level</option>
	<option value='1'>Admin</option>
	<option value='3'>Member</option>
	</select>
</div>

<div class='form-group'>
	<label for="Tpassword" class="label-control style1">Password :</label>
	<input id="Tpassword" class="form-control" type="password" name="Tpassword" maxlength=20 required placeholder="Password"/>
</div>
<button type="submit" name="Bsimpan" class="btn btn-success">Login</button>
<button type="reset" class="btn btn-danger">Ulangi</button>
</form>
<?php
include "template/kanan.php";
include "template/footer.php";
?>

