<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="<?php echo adminassets_url('css/normalize.css');?>">
    <link rel="stylesheet" href="<?php echo adminassets_url('css/main.css');?>">
    <link rel="stylesheet" href="<?php echo adminassets_url('css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo adminassets_url('css/all.min.css');?>">
    <link rel="stylesheet" href="<?php echo adminassets_url('fonts/flaticon.css');?>">
    <link rel="stylesheet" href="<?php echo adminassets_url('css/animate.min.css');?>">
    <link rel="stylesheet" href="<?php echo adminassets_url('css/jquery.dataTables.min.css');?>">
    <link rel="stylesheet" href="<?php echo adminassets_url('css/style.css');?>">
    <link rel="stylesheet" href="<?php echo adminassets_url('css/dropzone.min.css');?>">
	<link rel="stylesheet" href="<?php echo adminassets_url('magnific-popup/css/magnific-popup.css');?>">

    <script src="<?php echo adminassets_url('js/modernizr-3.6.0.min.js');?>"></script>
	<script type="text/javascript">
		var baseurl = "<?php echo  base_url(); ?>";
	</script>
    <style>
    .no-arrow a::after{
        display: none;
    }</style>
</head>
<body>
    <div id="preloader.;"></div>
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <div class="navbar navbar-expand-md header-menu-one bg-light">
            <div class="nav-bar-header-one">
                <div class="header-logo"><?php echo  $this->title;?></div>
                <div class="toggle-button sidebar-toggle">
                    <button type="button" class="item-link">
                        <span class="btn-icon-wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="d-md-none mobile-nav-bar">
               <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false">
                    <i class="far fa-arrow-alt-circle-down"></i>
                </button>
                <button type="button" class="navbar-toggler sidebar-toggle-mobile">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
                <ul class="navbar-nav">
                    <li class="navbar-item header-search-bar">
                        <h5 class="item-title"><?php echo date('l, d-m-Y @ h:i A');?></h5>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="navbar-item dropdown header-admin">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <div class="admin-title">
                                <h5 class="item-title"><?php echo $displayname; ?></h5>
                            </div>
                            <div class="admin-img">
                                
                                <img src="<?php echo adminassets_url('img/figure/admin.jpg');?>" alt="Admin">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">Admin</h6>
                            </div>
                            <div class="item-content">
                                <ul class="settings-list">
                                    <li><a href="<?php echo base_url('welcome/logout'); ?>"><i class="flaticon-turn-off"></i>Log Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
               <div class="mobile-sidebar-header d-md-none">
                    <div class="header-logo"> <?php echo  $this->title;?></div>
               </div>
                <div class="sidebar-menu-content">
                    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-open-book"></i><span>Manage Goles</span></a>
                            <ul class="nav sub-group-menu <?php echo isactivemenu(array('addgole','index'));?>">
                                <li class="nav-item">
                                    <a href="<?php echo base_url('dashboard'); ?>" class="nav-link menu-active"><i class="fas fa-angle-right"></i>List</a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="<?php echo base_url('dashboard/addgole'); ?>" class="nav-link"><i class="fas fa-angle-right"></i>Add New</a>
                                </li>
                            </ul>
                        </li>
						                         
                        <li class="nav-item sidebar-nav-item no-arrow">
                            <a href="<?php echo base_url('dashboard/pendinggole'); ?>" class="nav-link" style="color: #edf0f38c;"><i class="flaticon-open-book"></i>Pending Gole</a>
                        </li>

                        <li class="nav-item sidebar-nav-item no-arrow">
                            <a href="<?php echo base_url('dashboard/history'); ?>" class="nav-link" style="color: #edf0f38c;"><i class="flaticon-open-book"></i>Successful Goles</a>
                        </li>


                        <li class="nav-item sidebar-nav-item no-arrow">
                            <a href="https://invincix.com/" class="nav-link" style="color: #edf0f38c;"><i class="flaticon-open-book"></i>Visit invincix</a>
                        </li>

                        <li class="nav-item sidebar-nav-item no-arrow">
                            <a href="http://shubhamnayak.herokuapp.com/" class="nav-link" style="color: #edf0f38c;"><i class="flaticon-open-book"></i>Created By</a>
                        </li>
                        <li class="nav-item sidebar-nav-item no-arrow">
                            <a href="<?php echo base_url('welcome/logout'); ?>" class="nav-link" style="color: #edf0f38c;"><i class="flaticon-open-book"></i>Log Out</a>
                        </li>

              
                        <li class="nav-item sidebar-nav-item no-arrow">
                            <img src="<?php echo adminassets_url('images/maxresdefault.jpg');?>" alt="">
                        </li>
                       
						
                    </ul>
                </div>
            </div>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <div class="breadcrumbs-area" style="padding: 10px;"></div>
                