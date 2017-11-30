<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Student Employee Portal</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/black-tie/jquery-ui.css" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <!-- Site JS -->
    <script src="<?php echo TEMPLATE_BASE ?>js/site.js"></script>


    <!-- Site CSS -->
    <link rel="stylesheet" href="<?php echo TEMPLATE_BASE ?>css/style.css">

    <!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
    <div class="top-header-bar clear">
        <div class="dropdown" id="user-welcome">
            <button class="dropdown-toggle" type="button" data-toggle="dropdown" id="welcome">
            <h4>Welcome, <?php echo ($_SESSION['employee']->firstName . ' ' . $_SESSION['employee']->lastName) ?><span class="caret"></span></h4>
            </button>
            <ul class="dropdown-menu">
                <?php //if ( $_SESSION['isAdmin'] == false ) : ?>
                <li><a href="#">Sample Link #1</a></li>
                <li><a href="#">Sample Link #2</a></li>
                <?php 
                //endif;
                //if ( $_SESSION['isAdmin'] == true ) : 
            ?>
                <!--
                <li><a href="admin.php">Admin Panel</a></li>
                <li><a href="admin.php?action=upload&item=term">Upload Term</a></li>
                <li><a href="admin.php?action=upload&item=image">Upload Image</a></li>
                <li><a href="admin.php?action=remove&item=term">Remove Term</a></li>
                <li><a href="admin.php?action=remove&item=image">Remove Image</a></li>
                -->
                <?php //endif; ?>
            </ul>
        </div>

        <!--</ul>-->
        <h1 id='header-title'>CAI Time-Entry</h1>
        <a href="logout.php" id="sign-out" style="color: inherit;">
            <h4>Sign Out</h4>
        </a>


    </div>
    <main>
        <?php echo $content; ?>
    </main>
    <!--</div>-->
    <!--<script src="js/scripts.js"></script>-->
</body>

</html>
