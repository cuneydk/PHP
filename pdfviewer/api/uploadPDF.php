<?php
$files = array();
$uploadDirectory = "\\pdfviewer\\pdf\\";
$errors = []; // Store errors here
if (isset($_FILES)) {
    foreach ($_FILES as $file) {
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileTmpName = $file['tmp_name'];
        $fileType = $file['type'];
        $uploadPath = $_SERVER['DOCUMENT_ROOT'] . $uploadDirectory . basename($fileName);
        if ($fileSize > 10000000) {
            $errors[] = "En fazla dosya boyutu (10MB)";
        }
        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            if ($didUpload) {
                echo basename($fileName);
            } else {
                echo "Hata olustu";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "Hata olustu" . "\n";
            }
        }
    }
}