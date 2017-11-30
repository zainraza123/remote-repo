<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading text-center">
                    <img src="images/nku-logo.png" alt="nku logo" style="width: 75%;">
                </div>
                <div class="panel-body">
                    <?php if (isset($message)) : ?>
                        <div id="message" class="alert alert-danger">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="username" type="text" required autofocus>
                            </div>
                            <div class="form-group input-group">
                                <input class="form-control" placeholder="Password" id="password" name="password" type="password" value="" required>
                                <span class="input-group-addon"><i class="fa fa-eye" aria-hidden="true" id="togglePassword"></i></span>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <input type="submit" class="btn btn-lg btn-block" id="loginButton" value="Login">
                            <!--<a href="index.html" class="btn btn-lg btn-success btn-block">Login</a>-->
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="poweredByCAI">
    <img src="images/cai.png" alt="powered by CAI">
</div>
