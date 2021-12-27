<?php require_once("header.php") ?>

<body>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kullanıcı Bilgileri Güncelleme Ekranı</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group"> <input id="updateUserName" type="text"
                                                                   placeholder="Ad Soyad"
                                                                   class="form-control"></div>
                <div class="form-group"> <input id="updateUserEmail" disabled type="email"
                                                                    placeholder="E-Posta"
                                                                    class="form-control"></div>
                <div class="form-group"> <input id="updateUserPassword"
                                                                       type="password"
                                                                       placeholder="Şifre"
                                                                       class="form-control"></div>
                <div class="form-group"> <input id="updateUserType" type="text"
                                                                        placeholder="Normal ya da Admin"
                                                                        class="form-control"></div>
            </div>
            <div class="modal-footer">
            <button type="button" onclick="updateUser()" class="btn btn-outline-success">Güncelle</button>
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>
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
                            <div class="ibox-content">
                                <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Yeni Kullanıcı Ekleme Ekranı</h3>

                                    <div class="form-group"> <input id="addUserName" type="text"
                                                                                       placeholder="Ad Soyad"
                                                                                       class="form-control"></div>
                                    <div class="form-group"> <input id="addUserEmail" type="email"
                                                                                        placeholder="E-Posta"
                                                                                        class="form-control"></div>
                                    <div class="form-group"> <input id="addUserPassword"
                                                                                           type="password"
                                                                                           placeholder="Şifre"
                                                                                           class="form-control"></div>
                                    <div class="form-group"> <input id="addUserType" type="text"
                                                                                            placeholder="Normal ya da Admin"
                                                                                            class="form-control"></div>
                                    <div class="form-group">
                                        <button class="btn btn-outline-success" onclick="addUser()"
                                                type="submit"><strong>Kullanıcıyı Ekle</strong></button>
                                    </div>

                                </div>
                                <div class="table-responsive">
                                    <table id="usersTable" class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Kullanıcı ID</th>
                                            <th>Ad Soyad</th>
                                            <th>E-Posta</th>
                                            <th>Şifre</th>
                                            <th>Yetkilendirme</th>
                                            <th></th>
                                            <th></th>
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

<!-- Mainly scripts -->
<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="assets/js/inspinia.js"></script>
<script src="assets/js/plugins/pace/pace.min.js"></script>

<script src="assets/js/plugins/dataTables/datatables.min.js"></script>
<script src="assets/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

<script src="assets/js/plugins/sweetalert/sweetalert.min.js"></script>

<script>
    var usersTable = null;
    $(document).ready(function () {
        usersTable = $('#usersTable').DataTable({
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'excel', title: 'KOU-Kullanıcı-Listesi'},
            ],
            ajax: 'api/getUser.php?getAll=true',
            columns: [
                {
                    data: "id"
                },
                {
                    data: "name"
                },
                {
                    data: "email"
                },
                {
                    data: "password"
                },
                {
                    data: "userType"
                },
                {
                    data: "id",
                    render: function (data) {
                        return `<button onclick="editUser(\'${data}\')" class="btn btn-outline-success"  data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil"></i> <b>Güncelle</b></button>`;
                    },
                },
                {
                    data: "id",
                    render: function (data) {
                        return `<button onclick="deleteUser(\'${data}\')" class="btn btn-outline-danger"><i class="fa fa fa-minus-square"></i> <b>Sil</b></button>`;
                    },
                }
            ],

        });
    });

    function editUser(id) {
        $.ajax({
            url: "api/getUser.php",
            type: 'POST',
            data: {
                id: id
            },
            success: function (response) {
                $('#updateUserName').val(response.data[0].name);
                $('#updateUserEmail').val(response.data[0].email);
                $('#updateUserPassword').val(response.data[0].password);
                $('#updateUserType').val(response.data[0].userType);
            }
        });
    }

    function updateUser() {
        let updateUserName=$('#updateUserName').val();
        let updateUserEmail=$('#updateUserEmail').val();
        let updateUserPassword=$('#updateUserPassword').val();
        let updateUserType=$('#updateUserType').val();
        $.ajax({
            url: "api/updateUser.php",
            type: 'POST',
            data: {
                name:updateUserName,
                email:updateUserEmail,
                password:updateUserPassword,
                userType:updateUserType
            },
            success: function (response) {
                $('#exampleModal').modal('hide');
                usersTable.ajax.reload();
                swal({
                    title:"",
                    text: "Kullanıcı güncellendi.",
                    type: "success"
                });
            }
        });
    }

    function deleteUser(id) {
        $.ajax({
            url: "api/deleteUser.php",
            type: 'POST',
            data: {
                id: id
            },
            success: function (response) {
                usersTable.ajax.reload();
                swal({
                    title:"",
                    text: "Kullanıcı silindi!",
                    type: "warning"
                });
            }
        });
    }

    function addUser() {
        let name = $('#addUserName').val();
        let email = $('#addUserEmail').val();
        let password = $('#addUserPassword').val();
        let userType = $('#addUserType').val();
        $.ajax({
            url: "api/addUser.php",
            type: 'POST',
            data: {
                name: name,
                email: email,
                password: password,
                userType: userType,
            },
            success: function (response) {
                usersTable.ajax.reload();
                swal({
                    title:"",
                    text: "Yeni kullanıcı eklendi.",
                    type: "success"
                });
            }
        });
    }
</script>
</body>
</html>