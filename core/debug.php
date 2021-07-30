<?php
include './main.class.php';
include('./fw.class.php');

$graphclass= new graph();

$graph = $graphclass->makeGraph();
$nodes = $graphclass->makeNodes();

$asal = array_search($_GET['asal'], $nodes);
$tujuan = array_search($_GET['tujuan'], $nodes);

$fw = new FloydWarshall($graph, $nodes);
//$fw->print_graph();
//$fw->print_dist();
//$fw->print_pred();
//$fw->print_path($asal, $tujuan);
$sp = $fw->get_path($asal, $tujuan);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../assets/img/method.png">
        <title>Debug | Floyd Warshall</title>
        <link href="../admin/nodemaker/assets/bootstrap-3.3.7/css/bootstrap.min_1.css" rel="stylesheet" type="text/css"/>
        <link href="../admin/nodemaker/assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="../scripts/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
        <style>
            body {
                /*min-height: 2000px;*/
                padding-top: 70px;
            }

        </style>
    </head>
    <body>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="javascript:void(0);"> <i class="fa fa-puzzle-piece"></i> Floyd Warshall Debug Mode</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <!--                    <ul class="nav navbar-nav">
                                            <li class="active"><a href="javascript:void(0);">Debug</a></li>
                                            <li><a href="#about">Kembali</a></li>
                                        </ul>-->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../">Kembali</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <div class="container-fluid">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-lg-2">
                        <form class="form-group">
                            <label for="asal">Asal: </label>
                            <input type="text" class="form-control" required="" autocomplete="off" autofocus="" id="asal" name="asal">
                            <label for="tujuan">Tujuan: </label>
                            <input type="text" class="form-control" required="" autocomplete="off" id="tujuan" name="tujuan">
                            <br>
                            <button class="btn btn-primary pull-right" type="submit">Cari</button>
                        </form> 
                    </div>
                    <div class="col-lg-10">
                        <h3>Rute Terdekat dari <?= $nodes[$asal] ?> menuju <?= $nodes[$tujuan] ?> adalah: </h3>
                        <p>
                            <?php
                            foreach ($sp as $value) {
                                echo $nodes[$value] . ' - ';
                            }
                            ?>
                        </p>
                        <h3>Dengan Jarak: </h3>
                        <p><?= $fw->get_distance($asal, $tujuan) ?> Meter</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?= $fw->print_graph(); ?>
                </div>
                <div class="col-lg-12">
                    <?= $fw->print_dist(); ?>
                </div>
                <div class="col-lg-12">
                    <?= $fw->print_pred(); ?>
                    <br>
                </div>
            </div>

        </div> <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../scripts/jquery-2.2.0.min.js" type="text/javascript"></script>
        <script src="../admin/nodemaker/assets/bootstrap-3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../scripts/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="../scripts/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $('.datatable').DataTable({
                    scrollY: "500px",
                    scrollX: true,
                    ordering: false,
                    scrollCollapse: true,
                    paging: false,
                    bFilter: false,
                    info: false
                });
            });
        </script>
</html>
