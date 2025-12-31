<?php
$conn = new mysqli("localhost","root","","cuti_db");
if($conn->connect_error){
    die("Koneksi database gagal");
}
?>