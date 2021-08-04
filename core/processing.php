<?php

header('Content-Type:application/json');
include './main.class.php';
include'./fw.class.php';

$graphclass = new graph();
$graph = $graphclass->makeGraph();
$nodes = $graphclass->makeNodes();

$asal = array_search($_POST['asal'], $nodes);
$asalx = $_POST['asal'];
// var_dump($asalx);
if ($_POST['tujuan'] == "") {
	$tujuan = $nodes;
}
else{
	$tujuan = array_search($_POST['tujuan'], $nodes);
}

$finalarr = array('count' => 0, 'data'=>array());

// var_dump($tujuan);


if (count($tujuan) > 1) {
	// if (($keyx = array_search($_POST['asal'], $tujuan)) !== false) {
	//     unset($tujuan[$keyx]);
	// }

	$x = 0;
	// var_dump($tujuan);
	foreach ($tujuan as $key) {
		// var_dump($key);
		$fw = new FloydWarshall($graph, $nodes);
		$path = $fw->get_path($asal, $key);

		$distance = $fw->get_distance($asal, $key);
		$dataMateng = [];
		$detailedNode = [];
		// var_dump($x."=>".count($path)."=>".$key);
		for ($i = 0; $i < count($path); $i++) {
			// var_dump($path);
		    $getdetail = $graphclass->getNodeDetail($path[$i]);
		    while ($row = mysqli_fetch_assoc($getdetail)) {
		    	// var_dump(count($row));
		        array_push($detailedNode, $row);
		    }
		}
		$dataMateng['jarak'] = floatval($distance);
		$dataMateng['path'] = $detailedNode;
		// echo json_encode($detailedNode);

		// array_push($finalarr['data'], $dataMateng);
		// $x+=1;

		if (floatval($distance) > 0) {
			if ($key != $_POST['asal']) {
				array_push($finalarr['data'], $dataMateng);
			}
		}
		$x+=1;
	}
	$finalarr['count'] = $x;

	// var_dump($finalarr['data'][0]);
$arrayNum = 0;
$test = array();
foreach ($finalarr['data'] as $key) {
	// var_dump(count($key['path']));
	// var_dump($key['path'][count($key['path']) -1]);

	if ($key['path'][count($key['path']) -1]['destination'] == 'FALSE') {
		unset($finalarr['data'][$arrayNum]);
		$test = array_values($finalarr['data']);
		// var_dump($finalarr['data']);
	}

	$arrayNum += 1;
}

// var_dump($dataJadi);
$finalarr['data'] = array();
$finalarr['data'] = $test;

}
else{
	$fw = new FloydWarshall($graph, $nodes);


	// $path = $fw->get_path($asal, $tujuan);
	$path = $fw->get_path($asal, $tujuan);
	// var_dump($asal);
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

	array_push($finalarr['data'], $dataMateng);
	$finalarr['count'] = 1;
}
usort($finalarr['data'], function($a, $b) {
    return $a['jarak'] <=> $b['jarak'];
    // var_dump($a);
});
echo json_encode($finalarr);
