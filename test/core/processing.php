<?php

header('Content-Type:application/json');
include './main.class.php';
include'./fw.class.php';

$graphclass = new graph();
$graph = $graphclass->makeGraph();
$nodes = $graphclass->makeNodes();

$asal = array_search($_POST['asal'], $nodes);
$tujuan = array_search($_POST['tujuan'], $nodes);


$fw = new FloydWarshall($graph, $nodes);


$path = $fw->get_path($asal, $tujuan);
$distance = $fw->get_distance($asal, $tujuan);
$dataMateng = [];
$detailedNode = [];
for ($i = 0; $i < count($path); $i++) {
    $getdetail = $graphclass->getNodeDetail($path[$i]);
    while ($row = mysqli_fetch_assoc($getdetail)) {
        array_push($detailedNode, $row);
    }
}
$dataMateng['jarak'] = $distance;
$dataMateng['path'] = $detailedNode;
echo json_encode($dataMateng);
