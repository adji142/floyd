<?php
//error_reporting(0);
$activePage = 'vertex';
require_once '../core/main.class.php';
$users = new users();
$sessions = $users->sessionCheck();

if (!$sessions['logged']) {
    header('location:../');
}

$BackEndClass = new BackEndClass();
$vertex = $BackEndClass->getVertex();

function checker($value) {
    if ($value == 'TRUE') {
        return '<a class="fa fa-check"></a> Ya';
    } else {
        return '<a class="fa fa-times"></a> Tidak';
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Vertex | Floyd Warshall</title>
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
        <link href="assets/plugins/iCheck/all.css" rel="stylesheet" type="text/css"/>
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
            #map-modal{
                height: 400px;
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
                        Data TEMPAT
                        <small>Floyd Warshall</small>
                    </h1>
                </section>
                <section class="content">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tabel Data Vertex</h3>
                            <!--                            <div class="box-tools pull-right">
                                                            <button type="button" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#md_add_keluhan">
                                                                <i class="fa fa-plus"></i> Input baru...</button>
                                                        </div>-->
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12" id="export_button_vertex">
                                    <!--<span class="text-muted">Export </span>-->
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table id="tb_vertex" class="table table-hover table-striped">
                                        <thead>
                                            <tr class="bg-red">
                                                <th>No</th>
                                                <th>Nomor Vertex</Th>
                                                <th>Nama/Ket</th>
                                                <th>Koordinat</th>
                                                <th>Asal</th>
                                                <th>Tujuan</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="img-viewer">
                                            <?php
                                            $num = 1;
                                            foreach ($vertex as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td><?=
                                                        $num;
                                                        $num++
                                                        ?></td>
                                                    <td><?= $value['node'] ?></td>
                                                    <td class="">
                                                        <?=
                                                        $value['nama']
                                                        ?>
                                                    </td>
                                                    <td><a href="javascript:void(0);"  onclick="showMapModal(<?= $value['koordinat'] ?>)" class=""><?= $value['koordinat'] ?></a></td>
                                                    <td><?= checker($value['source']) ?></td>
                                                    <td><?= checker($value['destination']) ?></td>
                                                    <td class="text-center"><button type="button" onclick="showEditDialog_vertex(<?= $value['koordinat'] ?>)" class="btn btn-danger btn-xs btn-flat" title="Edit"><span class="glyphicon glyphicon-pencil"></span></button></td>
                                                    <td><?= $value['source'] ?></td>
                                                    <td><?= $value['destination'] ?></td>
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
                    <!--MODAL EDIT Vertex-->
                    <div  id="md_edit_vertex" class="modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-red">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="glyphicon glyphicon-remove-circle"></span></button>
                                    <h4 class="modal-title">Edit Vertex</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <label>Nomor Vertex</label>
                                            <input class="form-control" id="nomor_vertex" disabled="" readonly="">
                                            <label>Koordinat</label>
                                            <input class="form-control" id="koordinat_vertex" disabled="" readonly="">
                                            <p class="text-danger">*Edit dari WebGIS Tool</p>
                                        </div>
                                        <div class="col-xs-7">
                                            <label>Nama/Keterangan Vertex</label>
                                            <input class="form-control" id="nama_vertex">
                                            <br>
                                            <div class="form-group">
                                                <label>
                                                    <input id="has_source" type="checkbox" class="minimal">
                                                    Set Sebagai Lokasi Asal
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-danger btn-flat" onclick="postEditVertex()"><i class="fa fa-check"> </i> Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--MODAL MAP-->
                    <div  id="md_map" class="modal">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-red">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="glyphicon glyphicon-remove-circle"></span></button>
                                    <h4 id="md_map_title" class="modal-title">...</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div id="map-modal">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <h4 class="pull-left" id="footer_koordinat">Koordinat</h4>
                                    <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
                                </div>
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
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCG7FscIk67I9yY_fiyLc7-_1Aoyerf96E&language=id&region=ID&callback=initMap" async defer></script>
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
        <script src="assets/plugins/iCheck/icheck.js" type="text/javascript"></script>
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
        <script src="script/vertex.js" type="text/javascript"></script>
    </body>
</html>
