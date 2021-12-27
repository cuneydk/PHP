<?php
header('Content-Type: application/json');
error_reporting(0);
require_once('../sql.php');
session_start();
$id = isset($_POST['id']) ? $_POST['id'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
if ($_GET["getAll"] == 'true') { //User ekraninda tüm userlari listelemek icin giriyor
    $data['data'] = array();
    $query = "select * from users";
    $result_query = mysqli_query($conn362, $query);
    $rowcount = mysqli_num_rows($result_query);
    while ($row = $result_query->fetch_array()) {
        $data['data'][] = array("id" => $row['userID'], "name" => $row['userName'], "email" => $row['userMail'], "password" => $row['userPass'], "userType" => $row['userType']);
    }
    $object = (object)$data;
    echo json_encode($object);
} else if (isset($_POST['id'])) { //user guncelleme ekraninda textboxlari dolu getiriyor
    $data['data'] = array();
    $query = "select * from users where userID='$id'";
    $result_query = mysqli_query($conn362, $query);
    $rowcount = mysqli_num_rows($result_query);
    while ($row = $result_query->fetch_array()) {
        $data['data'][] = array("id" => $row['userID'], "name" => $row['userName'], "email" => $row['userMail'], "password" => $row['userPass'], "userType" => $row['userType']);
    }
    $object = (object)$data;
    echo json_encode($object);
} else { //Veritabaninda e-mail ve pass var mi?
    $query = "select * from users where userMail='$email' and userPass='$password'";
    $result_query = mysqli_query($conn362, $query);
    $rowcount = mysqli_num_rows($result_query);
    if ($rowcount != 1) { //tek kayit yoksa
        header('HTTP/1.1 500 Internal Server Booboo');
        die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
    } else { //Bulundu ise
        while ($rows = $result_query->fetch_array()) {
            $name = $rows["userName"];
            $email = $rows["userMail"];
            $status = $rows["userType"];
        }
        $cookie_name = "UserInfo"; //cerez olustur
        $cookie_value = $status;
        //cerezde bulunacak kullanici bilgileri ve gecerlilik suresi
        setcookie($cookie_name, 'mail=' . $email . '&name=' . $name . '&status=' . $status, time() + (86400 * 30), "/");
        die(json_encode(array('message' => 'Basarili', 'code' => 200)));
    }
}
?>