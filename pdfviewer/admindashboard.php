<?php require_once('header.php') ?>
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold"><?php if (isset($_COOKIE["UserInfo"])) {
                                    $name = explode("=", $_COOKIE["UserInfo"]);
                                    $name = str_replace('&status', '', $name[2]);
                                    echo $name;
                                } ?></span>
                            <span class="text-muted text-xs block">İşlemler <b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="logout.php">Oturumu Sonlandır</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li>
                    <a href="index.php"><i class="fa fa-home"></i> <span class="nav-label">Anasayfa</span></a>
                </li>
                <li>
                    <a href="admindashboard.php"><i class="fa fa-table"></i> <span class="nav-label">PDF Arşivi</span></a>
                </li>
                <?php if (isset($_COOKIE["UserInfo"])) {
                $status = explode("=", $_COOKIE["UserInfo"]);
                if ($status[3] == "Admin") { ?>
                    <li>
                        <a href="usersAdmin.php"><i class="fa fa-user-circle"></i> <span class="nav-label">Kullanıcı İşlemleri</span>
                        </a>
                    </li><?php }} ?>
                <li>
                    <a href="pdfsAdmin.php"><i class="fa fa-file-pdf-o"></i> <span class="nav-label">Makale Yükle</span></a>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="wrapper wrapper-content animated fadeIn">
            <div class="p-w-md m-t-sm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-content"> <!-- PDF listeledigimiz tablo -->
                                <div class="table-responsive">
                                    <table id="pdfsTable" class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Ad</th>
                                            <th>Soyad</th>
                                            <th>Öğrenci No</th>
                                            <th>Ders Adı</th>
                                            <th>Anahtar Kelimeler</th>
                                            <th>Dönem</th>
                                            <th>Başlık</th>
                                            <th>Danışman</th>
                                            <th>Jüri 1</th>
                                            <th>Jüri 2</th>
                                            <th>Özet</th>
                                            <th>Sahibi</th>
                                            <th>Ogretim</th>
                                        </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>
</div>


<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>


<script src="assets/js/inspinia.js"></script>
<script src="assets/js/plugins/pace/pace.min.js"></script>
<script src="assets/js/plugins/dataTables/datatables.min.js"></script>
<script src="assets/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
        pdfsTable = $('#pdfsTable').DataTable({
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            columnDefs:[
                {className:"overflowTd","targets":[10]}
            ],
            buttons: [
                {extend: 'excel', title: 'KOU-Tez-Listesi'},
            ],
            ajax: 'api/getPDFs.php',
            columns: [
                {
                    data: "name"
                },
                {
                    data: "surname"
                },
                {
                    data: "student_no"
                },
                {
                    data: "lesson_name"
                },
                {
                    data: "keywords"
                },
                {
                    data: "date"
                },
                {
                    data: "title"
                },
                {
                    data: "supervisor"
                },
                {
                    data: "jury_member"
                },
                {
                    data: "jury_member2"
                },
                {
                    data: "summary"
                },
                {
                    data: "Email"
                },
                {
                    data: "Ogretim"
                }
            ],
        });
    });
</script>
</body>
</html>