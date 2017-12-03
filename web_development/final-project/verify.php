<?php


require_once './includes/class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
    $user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
    $id = base64_decode($_GET['id']);
    $code = $_GET['code'];

    $statusY = "Y";
    $statusN = "N";

    $stmt = $user->runQuery(file_get_contents("sql/checkStatus"));
    $stmt->execute(array(":uID"=>$id,":code"=>$code));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0)
    {
        if($row['userStatus']==$statusN)
        {
            $stmt = $user->runQuery(file_get_contents("sql/setStatus"));
            $stmt->bindparam(":status",$statusY);
            $stmt->bindparam(":uID",$id);
            $stmt->execute();

            $msg = "
		           <div class='alert alert-success'>
				   <button class='close' data-dismiss='alert'>&times;</button>
					  <strong>WoW !</strong>  Your Account is Now Activated : <a href='login.php'>Login here</a>
			       </div>
			       ";
        }
        else
        {
            $msg = "
		           <div class='alert alert-error'>
				   <button class='close' data-dismiss='alert'>&times;</button>
					  <strong>sorry !</strong>  Your Account is allready Activated : <a href='login.php'>Login here</a>
			       </div>
			       ";
        }
    }
    else
    {
        $msg = "
		       <div class='alert alert-error'>
			   <button class='close' data-dismiss='alert'>&times;</button>
			   <strong>sorry !</strong>  No Account Found : <a href='signup.php'>Signup here</a>
			   </div>
			   ";
    }
}

require './assets/head.php';
?>

<div class="container">
    <div class="bg-faded p-4 my-4">
        <?php if(isset($msg)) { echo $msg; } ?>
    </div>
</div> <!-- /container -->

<?php require './assets/foot.php';?>
