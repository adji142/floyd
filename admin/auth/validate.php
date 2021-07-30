<?php
header('content-type:application/json');
if (isset($_POST['email']) && isset($_POST['password'])) {
    require_once '../../core/main.class.php';
    $auth = new users();
    $data = $auth->login($_POST['email'], $_POST['password']);
    echo json_encode($data);
}