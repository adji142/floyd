<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>FWS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>FLOYD WARSHALL</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="assets/dist/img/<?= $sessions['img'] ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?= $sessions['nama'] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="assets/dist/img/<?= $sessions['img'] ?>" class="img-circle" alt="User Image">
                            <p>
                                <?= $sessions['nama'] ?> - Administrator
                                <small><?= $sessions['email'] ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <button  data-toggle="modal" data-target="#md_edit_profil" class="btn btn-danger btn-flat">Profile</button>
                            </div>
                            <div class="pull-right">
                                <a href="auth/signout.php" class="btn btn-danger btn-flat"><i class="fa fa-lock"></i> Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div  id="md_edit_profil" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="registration_form" name="registration_form" class="form-horizontal" method="POST" action="auth/edit_profile.php" enctype="multipart/form-data">
                <input type="hidden" name="id_profil" id="id_profil" value="<?= $sessions['id']; ?>">
                <div class="modal-header bg-red">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="glyphicon glyphicon-remove-circle"></span></button>
                    <h4 class="modal-title">Edit Profil</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="img-section centered text-center">
                                <img src="assets/dist/img/<?= $sessions['img'] ?>" class="imgCircle" alt="Profile picture">
                                <input type="file" id="image-input" name="img" onchange="readURL(this);" accept="image/x-png,image/jpeg" class="form-control form-input Profile-input-file centered" >
                            </div>
                            <p class="text-center"id="image_name_preview"><i class="fa fa-pencil"></i> klik gambar untuk mengganti</p>
                        </div>
                        <div class="col-lg-9">
                            <table class="table table-condensed table-hover compact"  cellspacing="0">
                                <tbody>
                                    <tr>
                                        <th>Nama</th>
                                        <td><input class="form-control input-sm" tabindex="1" type="text" name="nama_profil" id="nama_profil" value="<?= $sessions['nama'] ?>"></td>
                                        <th>Prodi</th>
                                        <td><input class="form-control input-sm" tabindex="5" type="text" name="prodi_profil" id="nama_prodi" value="<?= $sessions['prodi'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><input class="form-control input-sm" tabindex="2" type="email" name="email_profil" id="email_profil" value="<?= $sessions['email'] ?>"></td>
                                        <th>Jenjang</th>
                                        <td><input class="form-control input-sm" tabindex="6" type="text" name="jenjang_profil" id="nama_jenjang" value="<?= $sessions['jenjang'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <th>Nim</th>
                                        <td><input class="form-control input-sm" tabindex="3" type="text" name="nim_profil" id="nim_profil" value="<?= $sessions['nim'] ?>"></td>
                                        <th>Password</th>
                                        <td><input class="form-control input-sm" tabindex="7" type="password" name="password_profil" id="password_profil" required=""></td>
                                    </tr>
                                    <tr>
                                        <th>Universitas</th>
                                        <td><input class="form-control input-sm" tabindex="4" type="text" name="universitas_profil" id="universitas_profil" value="<?= $sessions['universitas'] ?>"></td>
                                        <th>Password</th>
                                        <td><input class="form-control input-sm" tabindex="8" type="password" name="password2_profil" id="password2_profil" required=""></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-check"> </i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>