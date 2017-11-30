<?php


session_start();
require_once './includes/class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
    $user_home->redirect('index.php');
}

if ($user_home->isAdmin()) {
    $user_home->redirect('admin_home.php');
}

$stmt = $user_home->runQuery(file_get_contents("sql/getUserID"));
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$orders = $user_home->getAllUserOrders($row['userEmail']);

require './assets/head.php';
?>

<div class="container">
    <div class="bg-faded p-4 my-4">
        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i>
            <?php echo $row['userEmail']; ?> <i class="caret"></i>
        </a>

        <a href="logout.php">Logout</a>
    </div>

    <div class="bg-faded p-4 my-4">
        <?php if (isset($orders) && !empty($orders)):?>
            <h3>My Orders</h3>
            <?php
                foreach ($orders as $order) {
                    $item = $user_home->getItem($order['orderItemID']);
                    echo "<p class='btn-group-sm'>".$item['itemName']."..........$".$item['itemPrice']." <a class='btn btn-primary' href='cart.php?itemID=".$item['itemID']."'>Order Again</a></p>";
                }
            ?>
        <?php else:?>
            <p><h3>Order our fabulous items.....<a href="menu.php">Menu</a></h3></p>
        <?php endif;?>
    </div>
</div>

<?php require './assets/foot.php';?>
