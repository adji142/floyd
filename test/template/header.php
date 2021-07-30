<?php

function checkActive($val, $param) {
    if ($val == $param) {
        return 'current';
    }
}
?>
<header id="header-container" class="fixed fullwidth">
    <!-- Header -->
    <div id="header" class="not-sticky">
        <div class="container">
            <!-- Left Side Content -->
            <div class="left-side">
                <!-- Logo -->
                <div id="logo">
                    <a href="./"><img src="images/logo.png" alt=""></a>
                </div>
                <!-- Mobile Navigation -->
                <div class="menu-responsive">
                    <i class="fa fa-reorder menu-trigger"></i>
                </div>
                <!-- Main Navigation -->
                <nav id="navigation" class="style-1">
                    <ul id="responsive">
                        <li><a class="<?= checkActive('home', $activePage) ?>" href="./">Home</a></li>
                        <li><a class="<?= checkActive('about', $activePage) ?>" href="javascript:void(0);">About</a>
                            <ul>
                                <!--<li><a href="javascript:void(0);">Contact</a></li>-->
                                <li><a href="about.php">Informasi</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div class="clearfix"></div>
                <!-- Main Navigation / End -->

            </div>
            <!-- Left Side Content / End -->
            <!-- Right Side Content / End -->
            <div class="right-side">
                <div class="header-widget">
                    <a href="#sign-in-dialog" class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i> Sign In</a>
                    <!--<a href="dashboard-add-listing.html" class="button border with-icon">Add Listing <i class="sl sl-icon-plus"></i></a>-->
                </div>
            </div>
            <!-- Right Side Content / End -->

            <!-- Sign In Popup -->
            <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

                <div class="small-dialog-header">
                    <h3>Sign In</h3>
                </div>

                <!--Tabs -->
                <div class="sign-in-form style-1">

                    <ul class="tabs-nav">
                        <li class="active"><a href="#tab1">Log In</a></li>
                        <!--<li><a href="#tab2">Register</a></li>-->
                    </ul>

                    <div class="tabs-container alt">

                        <!-- Login -->
                        <div class="tab-content active" id="tab1" style="display: none;">
                            <form method="post" class="login">

                                <p class="form-row form-row-wide">
                                    <label for="email">Email:
                                        <i class="im im-icon-Mail"></i>
                                        <input type="email" class="input-text" name="email" id="email" value="" />
                                    </label>
                                </p>

                                <p class="form-row form-row-wide">
                                    <label for="password">Password:
                                        <i class="im im-icon-Lock-2"></i>
                                        <input class="input-text" type="password" name="password" id="password"/>
                                    </label>
                                    <span class="lost_password">
                                        <a href="#" >Lost Your Password?</a>
                                    </span>
                                </p>

                                <div class="form-row">
                                    <button type="button" onclick="login()" class="button border margin-top-5 pull-right">Login</button>
                                    <!--                                            <div class="checkboxes margin-top-10">
                                                                                    <input id="remember-me" type="checkbox" name="check">
                                                                                    <label for="remember-me">Remember Me</label>
                                                                                </div>-->
                                </div>
                                <span id="error_message" class="text text-danger hide">Login Failed <i class="fa fa-times"></i></span>
                            </form>
                        </div>

                        <!-- Register -->
                        <div class="tab-content" id="tab2" style="display: none;">

                            <form method="post" class="register">

                                <p class="form-row form-row-wide">
                                    <label for="username2">Username:
                                        <i class="im im-icon-Male"></i>
                                        <input type="text" class="input-text" name="username" id="username2" value="" />
                                    </label>
                                </p>

                                <p class="form-row form-row-wide">
                                    <label for="email2">Email Address:
                                        <i class="im im-icon-Mail"></i>
                                        <input type="text" class="input-text" name="email" id="email2" value="" />
                                    </label>
                                </p>

                                <p class="form-row form-row-wide">
                                    <label for="password1">Password:
                                        <i class="im im-icon-Lock-2"></i>
                                        <input class="input-text" type="password" name="password1" id="password1"/>
                                    </label>
                                </p>

                                <p class="form-row form-row-wide">
                                    <label for="password2">Repeat Password:
                                        <i class="im im-icon-Lock-2"></i>
                                        <input class="input-text" type="password" name="password2" id="password2"/>
                                    </label>
                                </p>

                                <input type="submit" class="button border fw margin-top-10" name="register" value="Register" />

                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Sign In Popup / End -->

        </div>
    </div>
    <!-- Header / End -->

</header>