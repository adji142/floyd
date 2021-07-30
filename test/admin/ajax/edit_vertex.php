<?php

header('Content-Type:application/json');
require_once '../../core/main.class.php';
$BackEndClass = new BackEndClass();

$target_dir = "../../images/hotel/";
$nama = $_POST['nama'];
$asal = $_POST['has_source'];
$node = $_POST['node'];

$result = $BackEndClass->editVertexByForm($node, $nama, $asal);
echo json_encode($result);
