<?php

function checkPage($current, $data) {
    if ($current == $data) {
        return 'active';
    }
}
?>
<div class="user-panel">
    <div class="pull-left image">
        <img src="assets/dist/img/<?= $sessions['img'] ?>" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
        <p><?= $sessions['nama'] ?></p>
        <a href="javascript:void(0);"><i class="fa fa-circle text-success"></i> Administrator</a>
    </div>
</div>
<form action="javascript:void(0);" method="get" class="sidebar-form">
    <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
        </span>
    </div>
</form>
<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li class="<?= checkPage($activePage, 'home') ?>">
        <a href="index.php">
            <i class="fa fa-dashboard"></i> 
            <span>Dashboard</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>
    </li>
    <li class="header">DATA</li>
    <li class="<?= checkPage($activePage, 'tempat') ?>" data-toggle="tooltip" data-placement="bottom" title="Management data Hotel" >
        <a href="tempat.php"><i class="fa fa-puzzle-piece"></i>
            <span>Data Tempat</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>
    </li>
    <li class="header">MAPS</li>
    <li class="<?= checkPage($activePage, 'vertex') ?>" data-toggle="tooltip" data-placement="bottom" title="Edit keterangan vertex" >
        <a href="vertex.php">
            <i class="fa fa-puzzle-piece"></i>
            <span>Data Vertex / Node</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>
    </li>
    <!--    <li class="">
            <a href="javascript:void(0);" class="">
                <i class="fa fa-puzzle-piece"></i>
                <span>Data Graph</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
        </li>-->
    <li class="">
        <a href="nodemaker/" data-toggle="tooltip" data-placement="bottom" title="create, edit Vertex / Graph" target="_blank">
            <i class="fa fa-map"></i>
            <span>WebGIS Tool</span>
            <span class="pull-right-container">
                <i class="fa fa-external-link pull-right"></i>
            </span>
        </a>
    </li>
    <li class="header">SISTEM</li>
<!--    <li class="<?= checkPage($activePage, 'about') ?>">
        <a href="history.php">
            <i class="fa fa-info-circle"></i> 
            <span>Tentang</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>
    </li>-->
    <li>
        <a href="Auth/signout.php"><i class="fa fa-lock"></i> 
            <span>Logout</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>
    </li>

    <li class="header">LABELS</li>
    <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
    <li><a href="#"><i class="fa fa-circle-o text-blue"></i> <span>Information</span></a></li>
</ul>