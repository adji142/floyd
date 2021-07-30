<?php

header('Content-Type: application/json');
require_once '../core/main.class.php';
$FrontEndClass = new FrontEndClass();
$klinik = $FrontEndClass->getTempat();
$data = [];
while ($row = mysqli_fetch_assoc($klinik)) {
    $field = [];
    $field['id'] = $row['node'];
    $field['price'] = $row['nama'];
    $field['title'] = $row['nama'];
    $field["address"] = $row['alamat'];
    $field['thumbnail'] = "assets/img/marker/logo.png"; //. $row['thumb'];
    $field['verified'] = true;
    $field['latitude'] = floatval($row['lat']);
    $field['longitude'] = floatval($row['lng']);
//    additional
    $field['img'] = $row['img'];
//    $field['alamat'] = $row['alamat'];
    $field['deskripsi'] = $row['deskripsi'];
    $field['telp'] = $row['telp'];

    array_push($data, $field);
}
echo json_encode($data);
