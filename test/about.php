<?php
$activePage = 'about';
include './core/main.class.php';
$backEnd = new BackEndClass();
$profile = $backEnd->getUserProfile();
?>
<!DOCTYPE html>
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <title>Hotel</title>
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
        <header id="header-container">

            <?php include './template/header.php'; ?>

        </header>
        <div class="clearfix"></div>
        <!-- Header Container / End -->


        <!-- Content
        ================================================== -->

        <!-- Map Container -->
        <div class="contact-map margin-bottom-60">
            <!-- Office -->
            <!--            <div class="address-box-container">
                            <div class="address-container" data-background-image="images/our-office.jpg">
                                <div class="office-address">
                                    <h3>Our Office</h3>
                                    <ul>
                                        <li>John Street 304</li>
                                        <li>New York</li>
                                        <li>Phone (123) 123-456 </li>
                                    </ul>
                                </div>
                            </div>
                        </div>-->
            <br><br>
            <!-- Office / End -->

        </div>
        <div class="clearfix"></div>
        <!-- Map Container / End -->


        <!-- Container / Start -->
        <div class="container">
            <div class="row">
                <!-- Contact Details -->
                <div class="col-md-12">
                    <h4 class="headline margin-bottom-30">Informasi</h4>
                    <p>Program pencari hotel dengan metode Floyd Warshall. Hotel yang berada di wilayah administrasi karesidenan Surakarta antara lain Surakarta Kota, Kab. Boyolali, Kab. Klaten, Kab. Sukoharjo, Kab. Karanganyar, Kab. Sragen, dan Kab. Wonogiri</p>
                    <!-- Contact Details -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="sidebar-textbox">
                                <ul class="contact-details">
                                    <li><i class="im im-icon-Checked-User"></i> <strong>Nama:</strong> <span><?= $profile[0]['nama'] ?></span></li>
                                    <li><i class="im im-icon-Student-Hat"></i> <strong>NIM:</strong> <span><?= $profile[0]['nim'] ?></span></li>
                                    <li><i class="im im-icon-Student-Hat"></i> <strong>Jenjang:</strong> <span><?= $profile[0]['jenjang'] ?></span></li>
                                    <li><i class="im im-icon-Student-Hat"></i> <strong>Program Study:</strong> <span><?= $profile[0]['prodi'] ?></span></li>
                                    <li><i class="im im-icon-University-2"></i> <strong>Universitas:</strong> <span><a href="http://sinus.ac.id" target="_BLANK"><?= $profile[0]['universitas'] ?></a></span></li>
                                    <li><i class="im im-icon-Envelope"></i> <strong>E-Mail:</strong> <span><a href="mailto:<?= $profile[0]['email'] ?>"></a><?= $profile[0]['email'] ?></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img class="img img-responsive img-thumbnail pull-right" style="max-height: 400px" src="admin/assets/dist/img/<?= $profile[0]['img'] ?>"

                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- Container / End -->
        <!-- Footer
        ================================================== -->
        <div id="footer" class="margin-top-55">
            <!-- Main -->
            <div class="container">
                <!--                <div class="row">
                                    <div class="col-md-5 col-sm-6">
                                        <img class="footer-logo" src="images/logo.png" alt="">
                                        <br><br>
                                        <p>Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros. Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.</p>
                                    </div>
                
                                    <div class="col-md-4 col-sm-6 ">
                                        <h4>Helpful Links</h4>
                                        <ul class="footer-links">
                                            <li><a href="#">Login</a></li>
                                            <li><a href="#">Sign Up</a></li>
                                            <li><a href="#">My Account</a></li>
                                            <li><a href="#">Add Listing</a></li>
                                            <li><a href="#">Pricing</a></li>
                                            <li><a href="#">Privacy Policy</a></li>
                                        </ul>
                
                                        <ul class="footer-links">
                                            <li><a href="#">FAQ</a></li>
                                            <li><a href="#">Blog</a></li>
                                            <li><a href="#">Our Partners</a></li>
                                            <li><a href="#">How It Works</a></li>
                                            <li><a href="#">Contact</a></li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>		
                
                                    <div class="col-md-3  col-sm-12">
                                        <h4>Contact Us</h4>
                                        <div class="text-widget">
                                            <span>12345 Little Lonsdale St, Melbourne</span> <br>
                                            Phone: <span>(123) 123-456 </span><br>
                                            E-Mail:<span> <a href="#"><span class="__cf_email__" data-cfemail="462920202f252306233e272b362a236825292b">[email&#160;protected]</span></a> </span><br>
                                        </div>
                
                                        <ul class="social-icons margin-top-20">
                                            <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
                                            <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
                                            <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
                                            <li><a class="vimeo" href="#"><i class="icon-vimeo"></i></a></li>
                                        </ul>
                
                                    </div>
                
                                </div>-->

                <!-- Copyright -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyrights">© 2017 DEDY SUTRISNO. STMIK SINAR NUSANTARA SURAKARTA.</div>
                    </div>
                </div>

            </div>

        </div>
        <!-- Footer / End -->


        <!-- Back To Top Button -->
        <div id="backtotop"><a href="#"></a></div>


    </div>
    <!-- Wrapper / End -->



    <!-- Scripts
    ================================================== -->
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
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
    <script type="text/javascript" src="scripts/infobox.min.js"></script>
    <script type="text/javascript" src="scripts/markerclusterer.js"></script>
    <script type="text/javascript" src="scripts/maps.js"></script>



</body>
</html>