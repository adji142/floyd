<?php
//error_reporting(0);
$activePage = 'home';
require_once '../core/main.class.php';
$users = new users();
$sessions = $users->sessionCheck();

if (!$sessions['logged']) {
    header('location:../');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard | Floyd Warshall</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" type="text/css"/>
        <link href="assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/iprofile/iprofile.css" rel="stylesheet" type="text/css"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            #image_this{
                background: url("assets/dist/img/sinus.png") no-repeat center;
                background-color: #ECF0F5;
            }
        </style>
    </head>
    <!--<img src="../assets/dist/img/sinus.png" alt=""/>-->
    <body class="hold-transition skin-red-light sidebar-mini fixed">
        <!-- Site wrapper -->
        <div class="wrapper">
            <?php include './template/header.php'; ?>

            <aside class="main-sidebar">
                <section class="sidebar">

                    <?php include './template/navigation.php'; ?>
                </section>
            </aside>
            <!-- =============================================== -->
            <div class="content-wrapper" id="image_this">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        WELCOME HOME
                        <small><?= $sessions['nama'] ?></small>
                    </h1>
                    <ol class="breadcrumb">
                    </ol>
                </section>
                <section class="content">
                    <div class="row">

                    </div>
                </section>

            </div>
            <?php include './template/footer.php'; ?>
            <?php include './template/aside.php'; ?>
            <div class="control-sidebar-bg"></div>
        </div>
        <script src="assets/plugins/jQuery/jquery-2.2.3.min.js" type="text/javascript"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
        <script src="assets/dist/js/app.min.js" type="text/javascript"></script>
        <script src="assets/plugins/iprofile/iprofile.js" type="text/javascript"></script>
        <script src="assets/dist/js/demo.js" type="text/javascript"></script>
        <script src="script/custom.js" type="text/javascript"></script>
    </body>
</html>
