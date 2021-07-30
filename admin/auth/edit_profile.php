<?php

require_once '../../core/AES.class.php';
require_once '../../core/main.class.php';
$users = new users();
$target_dir = "../assets/dist/img/";
$nama = $_POST['nama_profil'];
$email = $_POST['email_profil'];
$password = $_POST['password2_profil'];
$nim = $_POST['nim_profil'];
$universitas = $_POST['universitas_profil'];
$prodi = $_POST['prodi_profil'];
$jenjang = $_POST['jenjang_profil'];
if (isset($_POST['img'])) {
    $img = $_POST['img'];
} else {
    $img = 'none';
}
$id = $_POST['id_profil'];
$img_name = '';

//AES ENcryption
$imputText = $password;
$imputKey = "masterkey256encr";
$blockSize = 256;
$aes = new AES($imputText, $imputKey, $blockSize);
$encryptedPass = $aes->encrypt();
//END AES ENcryption

if ($_FILES['img']['size'] == 0) {
    $resultSet = $users->editProfile($nama, $email, $encryptedPass, $nim, $universitas, $prodi, $jenjang, $img, $id);
    echo '<h2>Update Profil Complete... <br><small> You\'ll redirected to homepage a few moment</small></h2><br>'
    . '<p><a href="../">Click here</a> if redirect failed</p>';
    header("refresh:3; url=signout.php");
} else {
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $check = getimagesize($_FILES["img"]["tmp_name"]);

    if (!move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
        echo "Sorry, there was an error uploading your file.";
    } else {
        $img_name = basename($_FILES["img"]["name"]);
        $resultSet = $users->editProfile($nama, $email, $encryptedPass, $nim, $universitas, $prodi, $jenjang, $img_name, $id);
        echo '<h2>Update Profil Complete.... <br><small> You\'ll redirected to homepage a few moment</small></h2><br>'
        . '<p><a href="../">Click here</a> if redirect failed</p>';
        header("refresh:3; url=signout.php");
    }
}