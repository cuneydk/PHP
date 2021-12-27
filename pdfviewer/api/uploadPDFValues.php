<?php require_once('../sql.php');

$name = isset($_POST['name'])?$_POST["name"]:"";
$surname = isset($_POST['surname'])?$_POST["surname"]:"";
$studentNo = isset($_POST['studentNo'])?$_POST["studentNo"]:"";
$lessonName = isset($_POST['lessonName'])?$_POST["lessonName"]:"";
$summary = isset($_POST['summary'])?$_POST["summary"]:"";
$keywords = isset($_POST['keywords'])?$_POST["keywords"]:"";
$date = isset($_POST['date'])?$_POST["date"]:"";
$title = isset($_POST['title'])?$_POST["title"]:"";
$supervisor = isset($_POST['supervisor'])?$_POST["supervisor"]:"";
$juryMember = isset($_POST['juryMember'])?$_POST["juryMember"]:"";
$juryMember2 = isset($_POST['juryMember2'])?$_POST["juryMember2"]:"";
$Ogretim = isset($_POST['Ogretim'])?$_POST["Ogretim"]:"";
if (isset($_COOKIE["UserInfo"])) {
    $email = explode("=", $_COOKIE["UserInfo"]);
    $email = str_replace('&name', '', $email[1]);
}

$query = "INSERT INTO pdf (Name,Surname,Student_No,Lesson_Name,Summary,Keywords,Date,Title,Supervisor,Jury_Member,Jury_Member2,Email,Ogretim) 
 VALUES('$name','$surname','$studentNo','$lessonName','$summary','$keywords','$date','$title','$supervisor','$juryMember','$juryMember2','$email','$Ogretim')";
$result_query=mysqli_query($conn362,$query);

?>