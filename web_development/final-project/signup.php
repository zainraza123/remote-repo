<?php


session_start();
require_once './includes/class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
    $reg_user->redirect('admin_home.php');
}


if(isset($_POST['btn-signup']))
{
    $uname = trim($_POST['txtuname']);
    $email = trim($_POST['txtemail']);
    $upass = trim($_POST['txtpass']);
    $code = md5(uniqid(rand()));

    $stmt = $reg_user->runQuery(file_get_contents("sql/getLoginUser"));
    $stmt->execute(array(":email_id"=>$email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($stmt->rowCount() > 0)
    {
        $msg = "
		      <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  email allready exists , Please Try another one
			  </div>
			  ";
    }
    else
    {
        if($reg_user->register($uname,$email,$upass,$code))
        {
            $id = $reg_user->lasdID();
            $key = base64_encode($id);
            $id = $key;

            $message = "					
						Hello $uname,
						<br /><br />
						To complete your registration  please , just click following link<br/>
						<br /><br />
						<a href='http://csweb.hh.nku.edu/csc301/razaz1/PHP_FinalProject/final_project/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>
						<br /><br />
						Thanks,";

            $subject = "Confirm Registration";

            $reg_user->send_mail($email,$message,$subject);
            $msg = "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Success!</strong>  We've sent an email to $email.
                    Please click on the confirmation link in the email to create your account. 
			  		</div>
					";
        }
        else
        {
            echo "sorry , Query could no execute...";
        }
    }
}

require './assets/head.php';

?>

<div class="container">
    <div class="bg-faded p-4 my-4">
        <?php if(isset($msg)) echo $msg;  ?>
        <form class="form-signin" method="post">
            <h2 class="form-signin-heading">Sign Up</h2><hr />
            <input type="text" class="input-block-level" placeholder="Username" name="txtuname" required />
            <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
            <input type="password" class="input-block-level" placeholder="Password" name="txtpass" required />
            <hr />
            <button class="btn btn-large btn-primary" type="submit" name="btn-signup">Sign Up</button>
            <a href="index.php" style="float:right;" class="btn btn-large">Sign In</a>
        </form>
    </div>
</div> <!-- /container -->

<?php require './assets/foot.php';?>
