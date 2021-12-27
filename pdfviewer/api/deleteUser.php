<?php require_once('../sql.php');
$id = $_POST['id'];
$sorgu = "Delete from users Where userID='$id' LIMIT 1"; //Olasi bir hata durumunda en fazla 1 kayitla sinirla Limit 1
$sorgu_sonucu=mysqli_query($conn362,$sorgu);
?>