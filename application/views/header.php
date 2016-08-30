<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Withholding tax | <?php echo $title; ?></title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url(); ?>resource/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?php echo base_url(); ?>resource/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="<?php echo base_url(); ?>resource/dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo base_url(); ?>resource/dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="<?php echo base_url(); ?>resource/bower_components/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo base_url(); ?>resource/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">Withholding tax</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  
			    <?php
				$CI = & get_instance();
				echo $CI->session->userdata('user_fullname_thai')
			    ?>
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li> -->
                            <li><a href="<?php echo site_url('logoff'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form" style="margin: 0px auto;">

                                    <img src="<?php echo base_url(); ?>resource/logo.png" width="60">
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </li>

                            <li class="active">
                                <a href="<?php echo site_url('User/lists') ?>"><i class="fa fa-user"></i> User Management</a>
                            </li>

                            <li class="active">
                                <a href="<?php echo site_url('customer/lists') ?>"><i class="fa fa-group"></i> Customer Management</a>
                            </li>

                            <li class="active">
                                <a href="<?php echo site_url('expensetype/lists') ?>"><i class="fa fa-file-text-o"></i> Expense Type Management</a>
                            </li>

                            <li class="active">
                                <a href="<?php echo site_url('transaction/lists') ?>"><i class="fa fa-list-ul"></i> Transaction</a>
                            </li>

                            <li class="active">
                                <a href="<?php echo '#'; //site_url('Report')  ?>"><i class="fa fa-signal"></i> Report</a>
				<ul class="nav nav-second-level">
				    <li>
					<a href="<?php echo site_url('Report/whtCriteria') ?>">WHT Certificate</a>
				    </li>
				    <li>
					<a href="<?php echo site_url('Report/summaryCriteria') ?>">Summary Report</a>
				    </li>
				</ul>
                            </li> 

                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>