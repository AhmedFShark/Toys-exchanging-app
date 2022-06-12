<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
    /*if(isset($_SESSION['p_user_id'])){
        $uID = $_SESSION['p_user_id'];
        $p = mysqli_fetch_assoc(get_crud_by_user_id($uID, 'Patients'));
        $pts = mysqli_fetch_assoc(get_crud_by_user_id($uID, 'Patient Test Search'));
        $ptr = mysqli_fetch_assoc(get_crud_by_user_id($uID, 'Patient Test Report'));
        $u = mysqli_fetch_assoc(get_crud_by_user_id($uID, 'Users'));
        $pr = mysqli_fetch_assoc(get_crud_by_user_id($uID, 'Privileges'));
        $usr = mysqli_fetch_assoc(get_user_info_by_id($_SESSION['p_user_id']));
    }
    */
?>

<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Toy Exchange App</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../Masters/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../Masters/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../Masters/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../Masters/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../Masters/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../Masters/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="../Masters/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="../Masters/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../Masters/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../Masters/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="../Masters/assets/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../Masters/assets/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../Masters/assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->

        <link href="../Masters/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="../Masters/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

        <link href="../Masters/assets/global/plugins/typeahead/typeahead.css" rel="stylesheet" type="text/css" />
        <link href="../Masters/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />

        <link rel="apple-touch-icon" sizes="57x57" href="../ref/images/favicons/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../ref/images/favicons/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../ref/images/favicons/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../ref/images/favicons/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../ref/images/favicons/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../ref/images/favicons/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../ref/images/favicons/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../ref/images/favicons/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../ref/images/favicons/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="../ref/images/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="../ref/images/favicons/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="../ref/images/favicons/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="../ref/images/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="../ref/images/favicons/manifest.json">
        <link rel="shortcut icon" href="../ref/images/favicons/favicon.ico">
        <meta name="msapplication-TileColor" content="#2d89ef">
        <meta name="msapplication-TileImage" content="../ref/images/favicons/mstile-144x144.png">
        <meta name="msapplication-config" content="../ref/images/favicons/browserconfig.xml">
        </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid">
        <div class="page-wrapper">
            <div class="page-wrapper-row">
                <div class="page-wrapper-top">
                    <!-- BEGIN HEADER -->
                    <div class="page-header">
                        <!-- BEGIN HEADER TOP -->
                        <div class="page-header-top">
                            <div class="container">
                                <!-- BEGIN LOGO -->
                                <div class="page-logo">
                                    <a href="./">
                                        <img src="../Masters/images/toy_house_logo.png" alt="logo" class="logo-default" width="44px">
                                    </a>
                                </div>
                                <!-- END LOGO -->
                                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                                <a href="javascript:;" class="menu-toggler"></a>
                                <!-- END RESPONSIVE MENU TOGGLER -->


                                <div class="top-menu">
                                    <ul class="nav navbar-nav pull-right">
                                        <!-- BEGIN USER LOGIN DROPDOWN -->
                                        <li class="dropdown dropdown-user dropdown-dark">
                                            <?php if(logged_in()){ ?>
                                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                <img alt="" class="img-circle" src="<?php echo $_SESSION['photo']; ?>">
                                                <span class="username username-hide-mobile"><?php echo $_SESSION['username']; ?></span>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-default">
                                                <li>
                                                    <a href="profile.php">
                                                    <i class="icon-user"></i> My Profile </a>
                                                </li>
                                                <li class="divider"> </li>
                                                <li>
                                                    <a href="logout.php">
                                                    <i><span class="icon-logout"></span></i> Log Out </a>
                                                </li>
                                            </ul>
                                            <?php } else { ?>
                                                <a href="login.php"><span aria-hidden="true" class="icon-login"></span></i> Log in </a>
                                            <?php } ?>
                                        </li>

                                        <!-- END USER LOGIN DROPDOWN -->
                                    </ul>
                                </div>


                            </div>
                        </div>
                        <!-- END HEADER TOP -->
                        <!-- BEGIN HEADER MENU -->
                        <div class="page-header-menu">
                            <div class="container">
                                <!-- BEGIN MEGA MENU -->
                                <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
                                <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
                                <div class="hor-menu  ">
                                    <ul class="nav navbar-nav">
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown <?php if($tab_num == 0){ echo 'active'; } ?>">
                                            <a href="./"> Home
                                                <span class="arrow"></span>
                                            </a>
                                        </li>
                                        <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown <?php if($tab_num == 1){ echo 'active'; } ?>">
                                            <a href="toys.php"> Toy list
                                                <span class="arrow"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- END MEGA MENU -->
                            </div>
                        </div>
                        <!-- END HEADER MENU -->
                    </div>
                    <!-- END HEADER -->
                </div>
            </div>
