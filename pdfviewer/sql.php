<?php
date_default_timezone_set('Europe/Istanbul');
$serverName = "localhost";
$uid = "root";
$pwd = "";
$databaseName = "pdfdb";
$conn362 = new mysqli($serverName, $uid, $pwd, $databaseName);
mysqli_set_charset($conn362, "utf8");