<?php require_once('header.php') ?>
<body class="gray-bg">
    
<div class="navbar-wrapper">
    <nav class="navbar navbar-dark bg-dark" role="navigation">
        <div class="container">
            <?php if(isset($_COOKIE["UserInfo"])) { $status=explode("=", $_COOKIE["UserInfo"]); if ($status[3]=="Admin"){?>
            <a class="navbar-brand" href="admindashboard.php">ADMIN PANELI</a>
            <?php }} ?>
            <div class="navbar-header page-scroll">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="nav-link page-scroll" href="index.php">ANASAYFA</a></li>
                    <?php if(!isset($_COOKIE["UserInfo"])) { ?>
                    <li><a class="nav-link page-scroll" href="login.php">GIRIS</a></li>
                    <li><a class="nav-link page-scroll" href="register.php">KAYIT OL</a></li>
                    <?php }else{ ?>
                    <li><a class="nav-link page-scroll" href="pdfsAdmin.php">MAKALELER</a></li>
                    <li><a class="nav-link page-scroll" href="logout.php">CIKIS</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div class="form-group">
            <input id="emailLogin" type="email" class="form-control" placeholder="E-Posta" required="">
        </div>
        <div class="form-group">
            <input id="passwordLogin" type="password" class="form-control" placeholder="Şifre" required="">
        </div>
        <button type="submit" onclick="loginUser()" class="btn btn-outline-success">Giriş Yap</button>
        <p class="text-muted text-center"><small>ya da </small></p>
        <a class="btn btn-sm btn-white btn-block" href="register.php">Kayıt Ol</a>
    </div>
</div>


<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/plugins/sweetalert/sweetalert.min.js"></script>
<script>

    function loginUser(){ //login fonksiyonu
        let email = $('#emailLogin').val() //email tut
        let password = $('#passwordLogin').val() //sifre tut
        $.ajax({ //cagri yap
            url: "api/getUser.php",
            type: 'POST',
            data: { //veri
                email: email, 
                password: password,
            },
            success: function (response) {
                swal({
                    title: "", //mesaj pop
                    text: "Giriş Yaptınız..",
                    type: "success"
                },function () {
                    window.location.href = 'index.php'; //index e git
                });
            },
            error: function (response){ //hata firlatirsa 
                swal("", "E-Posta/Şifre Hatalı!", "error"); //uyari mesaji pop
            }
        });
    }
</script>
</body>
</html>