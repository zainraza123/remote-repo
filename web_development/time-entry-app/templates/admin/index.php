<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>
        Time Entry (<?php echo $_SESSION['employee']->organizationName ?>) - <?php echo $page_title ?>
    </title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo TEMPLATE_BASE ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo TEMPLATE_BASE ?>vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php echo TEMPLATE_BASE ?>/vendor/datatables/DataTables-1.10.15/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo TEMPLATE_BASE ?>/vendor/datatables/dataTables.min.css" rel="stylesheet">
    
    <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-html5-1.3.1/b-print-1.3.1/rg-1.0.0/se-1.2.2/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-html5-1.3.1/b-print-1.3.1/rg-1.0.0/se-1.2.2/datatables.min.js"></script>-->

    <!-- Custom CSS -->
    <link href="<?php echo TEMPLATE_BASE ?>dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo TEMPLATE_BASE ?>vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo TEMPLATE_BASE ?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="<?php echo TEMPLATE_BASE ?>vendor/jquery/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/black-tie/jquery-ui.css" />

    <link href="<?php echo TEMPLATE_BASE ?>css/style.css" rel="stylesheet">
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
                <a class="navbar-brand" href="index.php">Time-Entry (<?php echo $_SESSION['employee']->organizationName ?>)</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <h5>Welcome,
                        <?php echo ($_SESSION['employee']->firstName . ' ' . $_SESSION['employee']->lastName);?>
                    </h5>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="settings.php"><i class="fa fa-cogs fa-fw"></i> Settings</a>
                        </li>
                        <li>
                            <a href="changeOrganization.php"><i class="fa fa-users fa-fw"></i> Change Organization</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="settings.php?setting=logout" onclick="return confirm('Are you sure want to log out?')"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse collapse">
                    <ul class="nav" id="side-menu" style="font-size:110%;">
                        <!--<li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>-->
                        <li>
                            <a href="index.php"><i class="fa fa-edit fa-fw"></i> Time Entry</a>
                        </li>
                        <li>
                            <a href="schedules.php"><i class="fa fa-calendar fa-fw"></i> Schedules</a>
                        </li>
                        
                        <?php if ($_SESSION['employee']->role == 'Student') :?>
                        
                        <?php else : ?>
                            <?php if ($_SESSION['employee']->role != 'Student Administrator') :?>
                                <li>
                                    <a href="pendingHours.php"><i class="fa fa-calendar-check-o fa-fw"></i> Approve Projects</a>
                                </li>
                            <?php endif; ?>
                        <li>
                            <a href="report.php"><i class="fa fa-bar-chart-o fa-fw"></i> Reports</a>
                        </li>
                        <li>
                            <a href="project.php"><i class="fa fa-folder-open fa-fw"></i> Projects</a>
                        </li>
                        <li>
                            <a href="client.php"><i class="fa fa-address-card fa-fw"></i> Clients</a>
                        </li>
                        <li>
                            <a href="employee.php"><i class="fa fa-users fa-fw"></i> Employees</a>
                        </li>
                        <li>
                            <a href="invoicing.php"><i class="fa fa-money fa-fw"></i> Invoicing</a>
                        </li>
                        <?php endif; ?>

                        <!--<li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>-->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!--<div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $page_title ?>
                        </div>
                    </div>-->

                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <?php echo $content; ?>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
        </div>
    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo TEMPLATE_BASE ?>vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo TEMPLATE_BASE ?>vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!--<script src="<?php echo TEMPLATE_BASE ?>vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo TEMPLATE_BASE ?>vendor/morrisjs/morris.min.js"></script>
    <script src="<?php echo TEMPLATE_BASE ?>data/morris-data.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo TEMPLATE_BASE ?>js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <!--<script src="<?php echo TEMPLATE_BASE ?>/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo TEMPLATE_BASE ?>/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo TEMPLATE_BASE ?>/vendor/datatables-responsive/dataTables.responsive.js"></script>-->
    <script src="<?php echo TEMPLATE_BASE ?>/vendor/datatables/dataTables.min.js"></script>
    
    <!-- TinyMCE -->
    <script src="<?php echo TEMPLATE_BASE ?>/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?php echo TEMPLATE_BASE ?>/vendor/tinymce/jquery.tinymce.min.js"></script>

    <!-- Page Specific JavaScript -->
    <script src="<?php echo TEMPLATE_BASE ?>/js/site.js"></script>
</body>

</html>
