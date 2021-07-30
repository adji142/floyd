<?php
//error_reporting(0);
$activePage = 'tempat';
require_once '../core/main.class.php';
$users = new users();
$sessions = $users->sessionCheck();

if (!$sessions['logged']) {
    header('location:../');
}

$BackEndClass = new BackEndClass();
$hotel = $BackEndClass->getTempat();
$GetTempat = $BackEndClass->GetNode();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hotel | Floyd Warshall</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" type="text/css"/>
        <link href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/gritter/jquery.gritter.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/iprofile/iprofile.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/Smoothbox-master/css/smoothbox.css" rel="stylesheet" type="text/css"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            .form-head >tr>th{
                width: 20%;
                text-align: right;
            }
            .form-head >tr>td>textArea{
                resize: none;
            }
        </style>
    </head>
    <body class="hold-transition skin-red-light sidebar-mini">
        <div class="wrapper">
            <?php include './template/header.php'; ?>
            <!-- =============================================== -->
            <aside class="main-sidebar">
                <section class="sidebar">
                    <?php include './template/navigation.php'; ?>
                </section>
            </aside>
            <!-- =============================================== -->
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Data Tempat
                        <small>Floyd Warshall</small>
                    </h1>
                </section>
                <section class="content">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tabel Data Tempat</h3>
                                <!-- <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-warning btn-flat" data-toggle="modal" data-target="#md_edit_hotel" id="add">
                                        <i class="fa fa-plus"></i> Input baru...</button>
                                </div> -->
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12" id="export_button_hotel">
                                    <!--<span class="text-muted">Export </span>-->
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table id="tb_hotel" class="table table-hover table-striped">
                                        <thead>
                                            <tr class="bg-red">
                                                <th>No</th>
                                                <th class="text-center">Img</th>
                                                <th>Nama</Th>
                                                <th>Alamat</th>
                                                <th>Telp</th>
                                                <th>Info</th>
                                                <th></th>
                                                <th>Id Node</th>

                                            </tr>
                                        </thead>
                                        <tbody class="img-viewer">
                                            <?php
                                            $num = 1;
                                            foreach ($hotel as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td><?=
                                                        $num;
                                                        $num++
                                                        ?></td>
                                                    <td class="text-center">
                                                        <a class="sb" href="../images/hotel/<?= $value['img'] ?>" title="<?= $value['nama'] ?>">
                                                            <img data-original="../images/hotel/<?= $value['img'] ?>" id="imgThumb<?= $value['id_vertex'] ?>" class="img img-responsive" style="max-height: 50px" src="../images/hotel/<?= $value['img'] ?>">
                                                        </a>
                                                    </td>
                                                    <td><?= $value['nama'] ?></td>
                                                    <td class="">
                                                        <?=
                                                        $value['alamat']
                                                        ?>
                                                    </td>
                                                    <td><?= $value['telp'] ?></td>
                                                    <td><?= $value['deskripsi']; ?></td>
                                                    <td class="text-center"><button type="button" onclick="showEditDialog_hotel(<?= $value['id_vertex'] ?>,<?= $value['id_node'] ?>)" class="btn btn-danger btn-xs btn-flat" title="Edit"><span class="glyphicon glyphicon-pencil"></span></button></td>
                                                    <td>
                                                        <?= $value['id_node'] ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">

                        </div>
                    </div>
                    <!--MODAL EDIT hotel-->
                    <div  id="md_edit_hotel" class="modal">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form id="registration_form" name="registration_form" class="form-horizontal" method="POST" action="ajax/edit_hotel.php" enctype="multipart/form-data">
                                    <input type="text" name="id_vertex" id="id_vertex" value="">
                                    <input type="text" name="id_tempat" id="id_tempat" value="">
                                    <input type="hidden" name="method" id="method" value="edit">
                                    <div class="modal-header bg-red">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="glyphicon glyphicon-remove-circle"></span></button>
                                        <h4 class="modal-title">Edit Hotel</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="img-section centered text-center">
                                                    <img id="imghotel_edit" src="" class="img img-responsive img-thumbnail" alt="[img hotel]">
                                                    <input type="file" id="image-input-hotel" name="img-hotel" onchange="readURL_hotel(this);" accept="image/x-png,image/jpeg" class="form-control form-input Profile-input-file centered" >
                                                </div>
                                                <p class="text-center"id="image_name_preview_hotel"><i class="fa fa-pencil"></i> klik gambar untuk mengganti</p>
                                            </div>
                                            <div class="col-lg-8">
                                                <table class="table table-condensed table-hover compact"  cellspacing="0">
                                                    <tbody class="form-head">
                                                        <tr>
                                                            <th>Nama Tempat</th>
                                                            <td><input class="form-control" tabindex="1" type="text" name="namahotel_edit" id="namahotel_edit"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>No Telp.</th>
                                                            <td><input class="form-control" tabindex="2" type="text" name="telphotel_edit" id="telphotel_edit"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Alamat Tempat</th>
                                                            <td><textarea class="form-control" tabindex="3" rows="4" type="text" name="alamathotel_edit" id="alamathotel_edit"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Info / Deskripsi</th>
                                                            <td><textarea class="form-control" tabindex="4" rows="4" type="text" name="infohotel_edit" id="infohotel_edit"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Node</th>
                                                            <td>
                                                                <select name="node" class="form-control" required="" id="node">
                                                                    <option value="0">Pilih Node</option>
                                                                    <?php
                                                                        foreach ($GetTempat as $key => $value) {
                                                                            echo "<option value='".$value['id']."'>".$value['nama']."</option>";
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-check"> </i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php include './template/footer.php'; ?>
            <?php include './template/aside.php'; ?>
            <div class="control-sidebar-bg"></div>
        </div>
        <!--plugin utama-->
        <script src="assets/plugins/jQuery/jquery-2.2.3.min.js" type="text/javascript"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <!--plugin extension (untuk export)-->
        <script src="assets/plugins/datatables/extensions/export/dataTables.buttons.min.js" type="text/javascript"></script>
        <script src="assets/plugins/datatables/extensions/export/buttons.bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/plugins/datatables/extensions/export/jszip.min.js" type="text/javascript"></script>
        <script src="assets/plugins/datatables/extensions/export/pdfmake.min.js" type="text/javascript"></script>
        <script src="assets/plugins/datatables/extensions/export/vfs_fonts.js" type="text/javascript"></script>
        <script src="assets/plugins/datatables/extensions/export/buttons.print.min.js" type="text/javascript"></script>
        <script src="assets/plugins/datatables/extensions/export/buttons.html5.min.js" type="text/javascript"></script>
        <script src="assets/plugins/Smoothbox-master/js/smoothbox.jquery2.min.js" type="text/javascript"></script>
        <!--just stuff plugin :) -->        
        <script src="assets/plugins/select2/select2.full.min.js" type="text/javascript"></script>
        <script src="assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <script src="assets/plugins/noty-2.4.1/js/noty/packaged/jquery.noty.packaged.min.js" type="text/javascript"></script>
        <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
        <script src="assets/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="assets/plugins/iprofile/iprofile.js" type="text/javascript"></script>
        <script src="assets/dist/js/app.min.js" type="text/javascript"></script>
        <script src="assets/dist/js/demo.js" type="text/javascript"></script>
        <!--Custom Javascript-->
        <script src="script/hotel.js" type="text/javascript"></script>
    </body>
</html>

<script type="text/javascript">
    $('#add').click(function () {
        $('#id_tempat').val('');
    });
    $('#node').change(function () {
        $('#id_vertex').val($('#node').val());
    });
</script>