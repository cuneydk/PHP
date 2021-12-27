<?php
unset($_COOKIE['UserInfo']); //cerezi birak
setcookie('UserInfo', null, -1, '/');
header('Location: index.php'); //yonlendirme yap