<?php include('../includes/config.php');  //var_dump($_SESSION['logged_user']) ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Login</title>
    <link href="css/StyleSheet.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <script src="js/jquery-1.11.3.min.js"></script>
</head>
<body>
    <div class="adminbox">
        <div class="adminbox-left">
            <div class="sidebar">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
                    <div class="sidebar-nav navbar-collapse slimscrollsidebar active" style="overflow: hidden; width: auto; height: 100%;">
                        <ul class="nav in" id="side-menu">
                            <li class="user-pro">
                                <a href="javascript:;" class="waves-effect">
                                    <img src="https://fitsigma.froid.works/fitsigma/images/user.svg" class="img-circle img-change">
                                    <span class="hide-menu"><?php echo $_SESSION['logged_user']['MemberName'] ?><span class="fa arrow"></span></span>
                                </a>
                                <ul class="nav nav-second-level collapse">
                                  
                                    <li><a href="index.php?logout=1"><i class="fa fa-power-off"></i>Logout</a></li>
                                </ul>
                            </li>
                            <li class="nav-small-cap m-t-10">--- <?php echo $_SESSION['logged_user']['MemberName'] ?></li>
                            <li><a href="index.php" class="waves-effect active"><i class="fa fa-tachometer mr5"></i><span class="hide-menu">Dashboard </span></a></li>

                            <!-- // admin -->
                            <?php if($_SESSION['logged_user']['MemberType'] == 1) { ?>
                                <li><a href="subscriptions.php" class="waves-effect "><i class="fa fa-user"></i>
                                    <span class="hide-menu">Subscriptions </span></a></li>
                                <li><a href="Payments.php" class="waves-effect "><i class="fa fa-usd mr5"></i><span class="hide-menu gap-payments">Payments <span class="fa arrow"></span></span></a>
                                </li>

                                <li><a href="plan.php" class="waves-effect "><i class="fa fa-envelope mr5"></i><span class="hide-menu">Plans </span></a>
                                </li>

                                <li><a href="slot.php" class="waves-effect "><i class="fa fa-envelope mr5"></i><span class="hide-menu">Slot </span></a>
                                </li>

                                <li><a href="member.php" class="waves-effect "><i class="fa fa-envelope mr5"></i><span class="hide-menu">Member </span></a>
                                </li>
                            <?php } else { ?>
                            
                            <?php } ?>

                            
                            <li><a href="Message.php" class="waves-effect "><i class="fa fa-envelope mr5"></i><span class="hide-menu">Message </span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>            
        </div>