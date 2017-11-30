<?php
require_once ('./includes/class.user.php');
$user = new USER();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Business Casual - Start Bootstrap Theme</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
          rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic"
          rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.css" rel="stylesheet">

</head>

<body>

<div class="tagline-upper text-center text-heading text-shadow text-white mt-5 d-none d-lg-block">Cafe X</div>


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-faded py-lg-4">
    <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="menu.php">Menu</a>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="about.php">About</a>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="blog.php">Blog</a>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="contact.php">Contact</a>
                </li>

                <?php if (isset($_SESSION['userSession']) && !empty($_SESSION['userSession'])):?>
                    <li class="nav-item px-lg-4">
                        <span class="nav-link text-uppercase text-expanded">About</span>
                    </li>
                <?php endif?>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="cart.php">Cart</i>(<?php if (isset($_SESSION['cart'])) {echo count($_SESSION['cart']);} else {echo '0';}?>)</a>
                </li>

                <li class="nav-item px-lg-4">
                    <?php if (isset($_SESSION['userSession']) && !empty($_SESSION['userSession'])):?>
                        <a class="nav-link text-uppercase text-expanded" href="logout.php">Logout</a>
                    <?php else: ?>
                        <a class="nav-link text-uppercase text-expanded" href="login.php">Login</a>
                    <?php endif;?>
                </li>

                <li class="nav-item px-lg-4">
                    <form align="right" method="GET" action="menu.php" enctype="multipart/form-data">
                        <input type="text" name="search-term" placeholder="Search" />
                        <input type="submit" value="search"/>
                    </form>
                </li>
            </ul>


        </div>

    </div>

</nav>
