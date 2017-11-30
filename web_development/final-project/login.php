<?php


session_start();
require_once './includes/class.user.php';
$user_login = new USER();

if ($user_login->is_logged_in() != "") {
    $user_login->redirect('admin_home.php');
}

if (isset($_POST['btn-login'])) {
    $email = trim($_POST['txtemail']);
    $upass = trim($_POST['txtupass']);

    if ($user_login->login($email, $upass)) {
        $user_login->redirect('admin_home.php');
    }
}

require './assets/head.php';

?>

<div class="container">
    <div class="bg-faded p-4 my-4">
        <?php if (isset($_GET['inactive'])) : ?>
            <div class='alert alert-error'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it.
            </div>
        <?php endif; ?>

        <form class="form-signin" method="post">
            <?php if (isset($_GET['error'])): ?>
                <div class='alert alert-success'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Wrong Details!</strong>
                </div>
            <?php endif; ?>

            <h2 class="form-signin-heading">Sign In.</h2><hr/>

            <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required/>
            <input type="password" class="input-block-level" placeholder="Password" name="txtupass" required/><hr/>
            <button class="btn btn-large btn-primary" type="submit" name="btn-login">Sign in</button>
            <a href="signup.php" style="float:right;" class="btn btn-large">Sign Up</a><hr/>
            <a href="fpass.php">Lost your Password ? </a>
        </form>
    </div>
</div> <!-- /container -->

<?php require './assets/foot.php'; ?>
