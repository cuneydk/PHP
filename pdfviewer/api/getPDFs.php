<?php
header('Content-Type: application/json');
error_reporting(0);
require_once('../sql.php');

$email = "";
if (isset($_COOKIE["UserInfo"])) {
    $email = explode("=", $_COOKIE["UserInfo"]);
    $email = str_replace('&name', '', $email[1]);
}

if (isset($_COOKIE["UserInfo"])) {
    $status = explode("=", $_COOKIE["UserInfo"]);
}

$data['data'] = array();
if ($status[3] == "Admin") { //Yetkisi Admin olan
    $query = "select * from pdf"; // Tum pdfleri ceker
} else { //diger yetkilerde
    $query = "select * from pdf where Email='$email'"; //kendisine aitler
}

$result_query = mysqli_query($conn362, $query);
$rowcount = mysqli_num_rows($result_query);
while ($row = $result_query->fetch_array()) { //sorguyu satir satir getir
    $data['data'][] = array("name" => $row['Name'], "surname" => $row['Surname'], "student_no" => $row['Student_No'], "lesson_name" => $row['Lesson_Name'], 'keywords' => $row['Keywords'], "date" => $row['Date'], "title" => $row['Title'], "supervisor" => $row['Supervisor'], "jury_member" => $row['Jury_Member'], "jury_member2" => $row['Jury_Member2'], "summary" => $row['Summary'], "Email" => $row['Email'],  "Ogretim" => $row['Ogretim']);
}
$object = (object)$data;
echo json_encode($object);
?>