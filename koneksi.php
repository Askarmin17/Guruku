<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


$servername = "sql109.infinityfree.com"; 
$username   = "if0_40846486";           
$password   = "bSbceAaaXpGRn";         
$database   = "if0_40846486_les_privat";   


$conn = mysqli_connect($servername, $username, $password, $database);


if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
} else {

}
?>