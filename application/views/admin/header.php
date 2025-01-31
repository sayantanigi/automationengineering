<?php
$get_setting=$this->Crud_model->get_single('setting');
if(empty($_SESSION['automation_admin']['id'])) {
    redirect(admin_url());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Automation Engineering Services | <?php if(!empty($title)){ echo ucfirst($title);} else{ echo "Dashboard";}?></title>

    <link rel="shortcut icon" href="<?=base_url(); ?>uploads/logo/<?= $get_setting->favicon?>">

    <link rel="stylesheet" href="<?=base_url(); ?>dist/assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?=base_url(); ?>dist/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>dist/assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="<?=base_url(); ?>dist/assets/plugins/datatables/datatables.min.css">

    <link rel="stylesheet" href="<?=base_url(); ?>dist/assets/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="<?=base_url(); ?>dist/assets/css/animate.min.css">

    <link rel="stylesheet" href="<?=base_url(); ?>dist/assets/css/admin.css">

    <!-- server side table -->
    <link rel="stylesheet" href="<?= base_url();?>dist/admin_assets/select2/select2.css">

    <!-- end server side table -->

</head>
<body>
    <div class="main-wrapper">

        <div class="header">
            <div class="header-left">
                <a href="##" class="logo logo-small">
                    <img src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" alt="Logo" width="30" height="30">
                </a>
            </div>
            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fas fa-align-left"></i>
            </a>
            <a class="mobile_btn" id="mobile_btn" href="javascript:void(0);">
                <i class="fas fa-align-left"></i>
            </a>
            <ul class="nav user-menu">

                <!-- <li class="nav-item dropdown noti-dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="far fa-bell"></i> <span class="badge badge-pill"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="##">
                                        <div class="media">
                                            <span class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle" alt="" src="<?=base_url(); ?>dist/assets/img/provider/provider-01.jpg">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details">
                                                    <span class="noti-title">Thomas Herzberg have been subscribed</span>
                                                </p>
                                                <p class="noti-time">
                                                    <span class="notification-time">15 Sep 2020 10:20 PM</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="##">
                                        <div class="media">
                                            <span class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle" alt="" src="<?=base_url(); ?>dist/assets/img/provider/provider-02.jpg">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details">
                                                    <span class="noti-title">Matthew Garcia have been subscribed</span>
                                                </p>
                                                <p class="noti-time">
                                                    <span class="notification-time">13 Sep 2020 03:56 AM</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="##">
                                        <div class="media">
                                            <span class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle" alt="" src="<?=base_url(); ?>dist/assets/img/provider/provider-03.jpg">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details">
                                                    <span class="noti-title">Yolanda Potter have been subscribed</span>
                                                </p>
                                                <p class="noti-time">
                                                    <span class="notification-time">12 Sep 2020 09:25 PM</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="##">
                                        <div class="media">
                                            <span class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle" alt="User Image" src="<?=base_url(); ?>dist/assets/img/provider/provider-04.jpg">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details">
                                                    <span class="noti-title">Ricardo Flemings have been subscribed</span>
                                                </p>
                                                <p class="noti-time">
                                                    <span class="notification-time">11 Sep 2020 06:36 PM</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="##">
                                        <div class="media">
                                            <span class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle" alt="User Image" src="<?=base_url(); ?>dist/assets/img/provider/provider-05.jpg">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details">
                                                    <span class="noti-title">Maritza Wasson have been subscribed</span>
                                                </p>
                                                <p class="noti-time">
                                                    <span class="notification-time">10 Sep 2020 08:42 AM</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="##">
                                        <div class="media">
                                            <span class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle" alt="User Image" src="<?=base_url(); ?>dist/assets/img/provider/provider-06.jpg">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details">
                                                    <span class="noti-title">Marya Ruiz have been subscribed</span>
                                                </p>
                                                <p class="noti-time">
                                                    <span class="notification-time">9 Sep 2020 11:01 AM</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="">
                                        <div class="media">
                                            <span class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle" alt="User Image" src="<?=base_url(); ?>dist/assets/img/provider/provider-07.jpg">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details">
                                                    <span class="noti-title">Richard Hughes have been subscribed</span>
                                                </p>
                                                <p class="noti-time">
                                                    <span class="notification-time">8 Sep 2020 06:23 AM</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="##">View all Notifications</a>
                        </div>
                    </div>
                </li> -->


                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle user-link  nav-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" width="40" alt="Admin">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?= admin_url('profile'); ?>">Change Password</a>
                        <a class="dropdown-item" href="<?= admin_url(); ?>login/logout" >Logout</a>
                    </div>
                </li>

            </ul>
        </div>
