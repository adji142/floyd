<?php
$activePage = 'home';
include './core/main.class.php';
$FrontEndClass = new FrontEndClass();
$pemadam = $FrontEndClass->getTempat();
$jumlahPemadam = mysqli_num_rows($pemadam);
$asal = $FrontEndClass->getAsal();
$tujuan = $FrontEndClass->getTujuan();
?>
<!DOCTYPE html>
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <title>Rumah Sakit Terdekat</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/colors/main.css" id="colors">
</head>
<body>
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Header Container
        ================================================== -->
        <?php include './template/header.php'; ?>
        <div class="clearfix"></div>
        <!-- Header Container / End -->
        <!-- Content
        ================================================== -->
        <div class="fs-container">
            <div class="fs-inner-container content">
                <div class="fs-content">

                    <!-- Search -->
                    <section class="search">

                        <div class="row">
                            <div class="col-md-12">

                                <!-- Row With Forms -->
                                <div class="row with-forms">

                                    <!-- Main Search Input -->
                                    <div class="col-fs-12">
                                        <h4>Lokasi Asal</h4>
                                        <select id="asal" data-placeholder="Pilih Lokasi Asal" class="chosen-select">
                                            <option label="blank"></option>	
                                            <?php while ($data = mysqli_fetch_assoc($asal)) { ?>
                                                <option value="<?= $data['node'] ?>" data-lat="<?= $data['lat'] ?>" data-lng="<?= $data['lng'] ?>"><?= $data['nama'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- Main Search Input -->
                                    <div class="col-fs-12">
                                        <h4>Lokasi Tujuan</h4>
                                        <select id="tujuan" data-placeholder="Pilih Lokasi Tujuan" class="chosen-select">
                                            <option label="blank" value=""></option>
                                            <option label="blank" value="">Terdekat</option>
                                            <?php while ($data = mysqli_fetch_assoc($tujuan)) { ?>
                                                <option value="<?= $data['node'] ?>"><?= $data['nama'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-fs-12">
                                        <div class="style-2">
                                            <!-- Tabs Navigation -->
                                            <ul class="tabs-nav">
                                                <li class="active"><a href="#tab1a"><i class="fa fa-star"></i> Hasil </a></li>
                                                <li><a href="#tab2a"><i class="fa fa-exclamation-circle"></i> Detail</a></li>
                                                <li><a href="#tab3a"><i class="fa fa-google"></i> Google Direction</a></li>
                                            </ul>

                                            <!-- Tabs Content -->
                                            <div class="tabs-container">
                                                <div class="tab-content" id="tab1a">
                                                    <p id="path"></p>
                                                    <p id="jarak"></p>
                                                    <a class="pull-right" href="core/debug.php" target="_BLANK">debug</a>
                                                </div>
                                                <div class="tab-content" id="tab2a">
                                                    <p id="keterangan"></p>
                                                </div>
                                                <div class="tab-content" id="tab3a">
                                                    <div id="google_direction">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- Row With Forms / End -->
                            </div>
                        </div>
                    </section>
                    <!-- Search / End -->
                    <section class="listings-container margin-top-30">
                        <!-- Sorting / Layout Switcher -->
                        <div class="row fs-switcher">

                            <div class="col-md-6">
                                <!-- Showing Results -->
                                <p class="showing-results"><?= $jumlahPemadam ?> Lokasi Ditemukan</p>
                            </div>

                        </div>


                        <!-- Listings -->
                        <div class="row fs-listings">
                            <?php
                            while ($data = mysqli_fetch_assoc($pemadam)) {
                                ?>
                                <!-- Listing Item -->
                                <div class="col-lg-12 col-md-12">
                                    <div class="listing-item-container list-layout" data-marker-id="<?= $data['node'] ?>">
                                        <a href="#" class="listing-item">
                                            <!-- Image -->
                                            <div class="listing-item-image">
                                                <img src="images/lokasi/<?= $data['img'] ?>" alt="[image not found]">
                                                <!--<span class="tag">Hotels</span>-->
                                            </div>
                                            <!-- Content -->
                                            <div class="listing-item-content">
                                                <div class="listing-item-inner">
                                                    <h3><?= $data['nama'] ?></h3>
                                                    <span><?= $data['alamat'] ?></span>
                                                    <span><?= $data['telp'] ?></span>
                                                </div>
                                                <!--<span class="like-icon"></span>-->
                                                <!--<div class="listing-item-details"><?= $data['telp'] ?></div>-->
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- Listing Item / End -->
                            <?php } ?>
                        </div>
                        <!-- Listings Container / End -->


                        <!-- Pagination Container -->
                        <div class="row fs-listings">
                            <div class="col-md-12">

                                <!-- Pagination -->
                                <div class="clearfix"></div>

                                <div class="clearfix"></div>
                                <!-- Pagination / End -->

                                <!-- Copyrights -->
                                <?php include './template/footer.php'; ?>

                            </div>
                        </div>
                        <!-- Pagination Container / End -->
                    </section>

                </div>
            </div>
            <div class="fs-inner-container map-fixed">

                <!-- Map -->
                <div id="map-container">
                    <div id="map" data-map-zoom="9" data-map-scroll="true">
                        <!-- map goes here -->
                    </div>
                </div>

            </div>
        </div>


    </div>
    <!-- Wrapper / End -->

    <!-- Scripts
    ================================================== -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="scripts/jpanelmenu.min.js"></script>
    <script type="text/javascript" src="scripts/chosen.min.js"></script>
    <script type="text/javascript" src="scripts/slick.min.js"></script>
    <script type="text/javascript" src="scripts/rangeslider.min.js"></script>
    <script type="text/javascript" src="scripts/magnific-popup.min.js"></script>
    <script type="text/javascript" src="scripts/waypoints.min.js"></script>
    <script type="text/javascript" src="scripts/counterup.min.js"></script>
    <script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
    <script type="text/javascript" src="scripts/tooltips.min.js"></script>
    <script type="text/javascript" src="scripts/custom.js"></script>

    <!-- Maps -->
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCG7FscIk67I9yY_fiyLc7-_1Aoyerf96E&language=id"></script>
    <script type="text/javascript" src="scripts/infobox.min.js"></script>
    <script type="text/javascript" src="scripts/markerclusterer.js"></script>
    <script type="text/javascript" src="scripts/maps.js"></script>
</body>
</html>