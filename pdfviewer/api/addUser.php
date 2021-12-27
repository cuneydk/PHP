<?php
require_once('../sql.php');
$adisoyadi = $_POST['name'];
$eposta = $_POST['email'];
$sifre = $_POST['password'];
$yetki = isset($_POST['userType']) ? $_POST['userType']:"Normal";
$sorgu = "INSERT INTO users (userMail,userName,userPass,userType) VALUES('$eposta','$adisoyadi','$sifre','$yetki')";
$sorgu_sonucu=mysqli_query($conn362,$sorgu);
?>