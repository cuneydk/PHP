<?php require_once("header.php") ?>
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
                    <a href="admindashboard.php"><i class="fa fa-table"></i> <span
                                class="nav-label">PDF Arşivi</span></a>
                </li>
                <?php if (isset($_COOKIE["UserInfo"])) {
                    $status = explode("=", $_COOKIE["UserInfo"]);
                    if ($status[3] == "Admin") { ?>
                        <li>
                            <a href="usersAdmin.php"><i class="fa fa-user-circle"></i> <span
                                        class="nav-label">Kullanıcı İşlemleri</span>
                            </a>
                        </li><?php }
                } ?>
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
                            <div class="ibox-title">
                                <h5>Makale Yükleme Ekranı</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="wrapper wrapper-content animated fadeIn">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ibox">
                                                <form action="#" class="dropzone" id="dropzoneForm">
                                                    <div class="fallback">
                                                        <input name="file" type="file"/>
                                                    </div>

                                                    <button class="btn btn-outline-success"
                                                            type="submit"><strong>Dosyayı Yükle</strong></button>

                                                </form>
                                                
                                            </div>
                                        </div>
                                    </div>
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
<script src="assets/js/plugins/dropzone/dropzone.js"></script>
<script src="assets/js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="assets/js/plugins/pdfjs/pdf.js"></script>
<script>

    var url = '';

    function getValues() {
        var formData = new FormData(); //jquery ile 
        formData.append('pdf', $('#dropzoneForm')[0].dropzone.getAcceptedFiles()[0]); //yuklenen ilk pdf'i al
        return formData;
    }

    function parsePDF(text) { //pdften gelen tum metinleri parsePDF ile aldik
        text = text.split(' ') //tum kelimeleri bosluga gore ayir
        countJuryMember = 0 
        cleanArray = text.filter((value) => value); //bos cekilen degerler varsa arrayden at
        for (var i = 0; i < cleanArray.length; i++) {
            if (cleanArray[i] == "................................................") {
                countJuryMember++;
            }
        }
        
        let index = cleanArray.indexOf("Soyadı:") //Soyadini buldugu yerin indexini tut
        let secondIndex = cleanArray.indexOf("İmza:", index) //imza buldugu yerin indexini tut
        let name = ""; 
        let surname = "";
        while (cleanArray.indexOf("Soyadı:", index) > 0) { //0 olana kadar don
            if (secondIndex>0){ //ikinci index sifir kontrolu
                for (var i = index + 1; i < secondIndex; i++) { //ilk bulunan isimden soyadina kadar don
                    if (i == secondIndex - 1) { //sayac son soyadina esitse
                        surname = surname + cleanArray[i]; //soyadina ekle
                    }else{
                        name = name + cleanArray[i] + ''; //degilse bulunan isimdir ekle
                    }
                }
            }
            name = name + ', '; //ayir
            surname = surname + ', ';
            index++; //index arttir
            index = cleanArray.indexOf("Soyadı:", index) //yeni ad indexini al
            secondIndex = cleanArray.indexOf("İmza:", index) //yeni soyad indexi al donguye devam
        }
        // let index = cleanArray.indexOf("Soyadı:")
        // let name = "";
        // let surname = "";
        // while (cleanArray.indexOf("Soyadı:",index)>0){
        // name = name+cleanArray[index + 1]+',';
        // surname = surname+cleanArray[index + 2]+',';
        // index++;
        // index=cleanArray.indexOf("Soyadı:",index)
        // }
        // let index = cleanArray.indexOf("Soyadı:")
        // let surIndex = cleanArray.indexOf("İmza:")
        // var name = ""
        // let surname = ""
        // var surname = cleanArray[surIndex -1]
        //     for (var j=index+1; j<surIndex-1; j++) {
        //         name = name + cleanArray[j]+',';
        //     }


        secondIndex = cleanArray.indexOf("Danışman,") //
        let supervisor = ""
        for (var i = secondIndex - 3; i < secondIndex; i++) { //Danışmandan önceki 3 index supervisor oldugundan
            supervisor = supervisor + " " + cleanArray[i] //burdada o 3 indexi birlestir supervisor yap
        }


        index = cleanArray.indexOf("................................................") //ilk aranan imza cizgisi
        secondIndex = cleanArray.indexOf("Jüri", index + 1) //juriyi bulup index al
        let juryMember = ""
        for (var i = index + 1; i < secondIndex; i++) {
            juryMember = juryMember + " " + cleanArray[i]
        }


        let juryMember2 = ""
        if (countJuryMember == 3) { //en fazla
            index = cleanArray.indexOf("................................................", secondIndex + 1)
            secondIndex = cleanArray.indexOf("Jüri", index + 1)
            for (var i = index + 1; i < secondIndex; i++) {
                juryMember2 = juryMember2 + " " + cleanArray[i]
            }
        }

        // index = cleanArray.indexOf("No:")
        // let studentNo = cleanArray[index + 1]
        index = cleanArray.indexOf("No:")
        let studentNo = ""
        while (cleanArray.indexOf("No:",index)>0){
            studentNo = studentNo+cleanArray[index + 1]+', '
            console.log(studentNo)
            index++;
            index=cleanArray.indexOf("No:",index)
        }

        let ogretim = "" //ogretim turunu okul no icinden alacagiz
         if (studentNo[5] == 1) { //5 inci karakter 1 ise
             ogretim = "1.Öğretim";
         } else { //diger durumlarda
             ogretim = "2.Öğretim";
         }

        index = cleanArray.indexOf("BÖLÜMÜ")
        let lessonName = cleanArray[index + 1] + ' ' + cleanArray[index + 2]

        index = cleanArray.lastIndexOf("ÖZET")
        secondIndex = cleanArray.indexOf("Anahtar") 
        let summary = ""
        for (var i = index+1; i < secondIndex; i++) {
            summary = summary + " " + cleanArray[i]
        }
        
        let thirdIndex = cleanArray.lastIndexOf("GİRİŞ")
        let keywords = ""
        for (var i = secondIndex+2; i < thirdIndex; i++) {
            keywords = keywords + " " + cleanArray[i]
        }

        // index = cleanArray.indexOf("Öğretim") //Öğrenimi buldugu indexi tut
        // let ogretim = cleanArray[index-1] +"Öğretim";

        // ogretim = ogretim.split('.')
        // if (ogretim[0] >= 1) {
        //     ogretim = cleanArray[index-1] +"Öğretim";
        // } else {
        //     ogretim = "X";
        // }

        index = cleanArray.indexOf("Tarih:")
        let date = cleanArray[index + 1];
        date = date.split('.')
            if (date[1] >08 && date[1] <= 12 ) { //09 10 11 12 aylari guz doneminde sayildi
                date = date[2] + "/" + ++date[2] + " Güz" //guz donemi egitim ogretim ilerki yili alir
            } else {
                const oncekiYil = date[2] - 1; //gecmis yili al
                date = oncekiYil + "/" + date[2] + " Bahar" //bahar durumu
            }
        
        index = cleanArray.indexOf("BÖLÜMÜ")
        let lastIndex = cleanArray.indexOf("Danışman,")
        let title = ""
        for (var i = index + 3; i < lastIndex-3; i++) {
            title = title + " " + cleanArray[i]
        }
        // index = cleanArray.indexOf("PROJESİ")
        // secondIndex = cleanArray.indexOf("PROJESİ", 9)
        // let title = ""
        // for (var i = index + 1; i < secondIndex + 1; i++) {
        //     title = title + " " + cleanArray[i]
        // }
        
        let values = {};
        values['name'] = name;
        values['surname'] = surname;
        values['studentNo'] = studentNo;
        values['lessonName'] = lessonName;
        values['summary'] = summary;
        values['keywords'] = keywords;
        values['date'] = date;
        values['title'] = title;
        values['supervisor'] = supervisor;
        values['juryMember'] = juryMember;
        values['juryMember2'] = juryMember2;
        values['Ogretim'] = ogretim;
        addPDFtoDatabase(values)
    }

    function addPDFtoDatabase(values) {
        $.ajax({
            type: "POST",
            url: "api/uploadPDFValues.php",
            data: {
                name: values['name'],
                surname: values['surname'],
                studentNo: values['studentNo'],
                lessonName: values['lessonName'],
                summary: values['summary'],
                keywords: values['keywords'],
                date: values['date'],
                title: values['title'],
                supervisor: values['supervisor'],
                juryMember: values['juryMember'],
                juryMember2: values['juryMember2'],
                Ogretim: values['Ogretim'],
            },
            success: function (response) {
                swal({
                    title:"",
                    text: "Yüklediğiniz PDF'ten alınan veriler veri tabanına kaydedildi.",
                    type: "success"
                });
            }
        });
    }

    $(document).on('submit', '#dropzoneForm', function (e) {
        e.preventDefault();
        e.stopPropagation();

        $.ajax({
            method: 'POST',
            url: "api/uploadPDF.php", //pdf dizinine yüklenen pdf atiyor
            data: getValues(),
            processData: false, //Jquery ile form data icin gerekli
            contentType: false, 
            success: function (response) {
                url = `./pdf/${response}`;
                PDFJS.getDocument(url).then(function (pdfDoc_) {

                    gettext(`./pdf/${response}`).then(function (text) {
                            parsePDF(text)
                        },
                        function (reason) {
                            console.error(reason);
                        });

                });
            }
        });
    });

    var pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 1.5,
        zoomRange = 0.25,
        canvas = document.getElementById('the-canvas'),
        ctx = canvas.getContext('2d');


    function gettext(pdfUrl) {
        var pdf = pdfjsDistBuildPdf.getDocument(pdfUrl);
        return pdf.then(function (pdf) {
            var maxPages = pdf.pdfInfo.numPages;
            var countPromises = [];
            for (var j = 1; j <= maxPages; j++) {
                var page = pdf.getPage(j);

                var txt = "";
                countPromises.push(page.then(function (page) {
                    var textContent = page.getTextContent();
                    return textContent.then(function (text) {
                        return text.items.map(function (s) {
                            return s.str;
                        }).join('');
                    });
                }));
            }
            return Promise.all(countPromises).then(function (texts) {
                return texts.join('');
            });
        });
    }
</script>
</body>
</html>