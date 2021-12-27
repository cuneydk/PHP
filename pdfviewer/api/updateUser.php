<?php require_once('../sql.php');
$name = isset($_POST['name'])?$_POST["name"]:"";
$email = isset($_POST['email'])?$_POST["email"]:"";
$password = isset($_POST['password'])?$_POST["password"]:"";
$userType = isset($_POST['userType'])?$_POST["userType"]:"";
$query = "UPDATE users SET userName='$name', userPass='$password', userType='$userType' Where userMail='$email' LIMIT 1";
$result_query=mysqli_query($conn362,$query);
?>