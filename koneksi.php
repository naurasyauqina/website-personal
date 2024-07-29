<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "pakar";
$koneksi = mysqli_connect($host,  $username, $password, $database);
if(!$koneksi) die("error");
?>
