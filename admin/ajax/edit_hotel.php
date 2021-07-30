<?php

require_once '../../core/main.class.php';
$BackEndClass = new BackEndClass();

$target_dir = "../../images/hotel/";
$nama = $_POST['namahotel_edit'];
$telp = $_POST['telphotel_edit'];
$alamat = $_POST['alamathotel_edit'];
$deskripsi = $_POST['infohotel_edit'];
$id_vertex = $_POST['id_vertex'];

if (isset($_POST['img-hotel'])) {
    $img = $_POST['img-hotel'];
} else {
    $img = 'none';
}

if (isset($_POST['id_tempat'])) {
    $id_tempat = $_POST['id_tempat'];
} else {
    $id_tempat = '';
}
echo $id_tempat;
$img_name = '';


if ($_FILES['img-hotel']['size'] == 0) {
    if ($id_tempat == '') {
        $result = $BackEndClass->insertTempat($id_vertex, $alamat, $deskripsi, $telp, $img_name);
    } else {
        $resVertex = $BackEndClass->editVertex($id_vertex, $nama);
        $reshotel = $BackEndClass->editTempat($id_tempat, $alamat, $deskripsi, $telp, $img_name);
//        echo 'vertex: ' . $resVertex . '<br>hotel: ' . $reshotel;
    }
    header("location: ../tempat.php");
} else {
    $target_file = $target_dir . basename($_FILES["img-hotel"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $check = getimagesize($_FILES["img-hotel"]["tmp_name"]);

    if (!move_uploaded_file($_FILES["img-hotel"]["tmp_name"], $target_file)) {
        echo "Sorry, there was an error uploading your file.";
    } else {
        $img_name = basename($_FILES["img-hotel"]["name"]);
        if ($id_tempat == '') {
            $result = $BackEndClass->insertTempat($id_vertex, $alamat, $deskripsi, $telp, $img_name);
        } else {
            $resVertex = $BackEndClass->editVertex($id_vertex, $nama);
            $reshotel = $BackEndClass->editTempat($id_tempat, $alamat, $deskripsi, $telp, $img_name);
//            echo 'vertex: ' . $resVertex . '<br>hotel: ' . $reshotel;
        }
        header("location: ../tempat.php");
    }
}