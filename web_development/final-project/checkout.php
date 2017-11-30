<?php


session_start();
require_once './includes/class.user.php';
$user_home = new USER();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $user_home->redirect('cart.php');
}

if($user_home->is_logged_in())
{
    $stmt = $user_home->runQuery(file_get_contents("sql/getUserID"));
    $stmt->execute(array(":uid"=>$_SESSION['userSession']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderNum = uniqid();
    if ($user_home->is_logged_in()) {
        $orderEmail = $row['userEmail'];
    } else {
        $orderEmail = $_POST['email'];
    }
    foreach ($_SESSION['cart'] as $key => $value) {
        $orders[$key]['orderNum'] = $orderNum;
        $orders[$key]['orderEmail'] = $orderEmail;
        $orders[$key]['orderItemID'] = $value;
    }

    foreach ($orders as $order) {
        $user_home->placeOrder($order);
        $msg = 'Order Placed.';
    }
    unset($_SESSION['cart']);
}

require './assets/head.php';
?>

<div class="container">
    <?php if (isset($msg)):?>
        <div class="bg-faded p-4 my-4">
            <h3>Your Order Placed. Your Order Number: <?php echo $orderNum;?></h3>
        </div>
    <?php else:?>
        <?php if (!$user_home->is_logged_in()):?>
            <div class="bg-faded p-4 my-4">
                To save your order for future, <a class="btn btn-primary" href="signup.php">Sign Up</a> Or <a class="btn btn-secondary" href="login.php">Login</a>
            </div>
        <?php endif;?>

        <div class="bg-faded p-4 my-4">
            <hr class="divider">
            <h2 class="text-center text-lg text-uppercase my-0">Review
                <strong>Order</strong>
            </h2>
            <hr class="divider">
            <form method="post">
                <?php if ($user_home->is_logged_in()): ?>
                    <p>Order Email: <strong><?php echo $row['userEmail'];?></strong></p>
                <?php else:?>
                    <div class="form-group col-lg-4">
                        <label class="text-heading">Email Address</label>
                        <input name="email" type="email" class="form-control" required>
                    </div>
                <?php endif;?>

                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <?php $cartItem = $user_home->getItem($item);?>
                        <p><?php echo $cartItem['itemName']?>..........<strong>$<?php echo $cartItem['itemPrice']?> </strong></p>
                    <?php endforeach; ?>
                <?php else:?>
                    <p>Your Cart is empty</p>
                <?php endif;?>

                <p><strong>Total: $<?php echo $_SESSION['total'];?></strong></p>

                <div class="form-group col-lg-12">
                    <button type="submit" class="btn btn-secondary">Place Order</button>
                </div>
            </form>
        </div>
    <?php endif;?>
</div>

<?php require './assets/foot.php';?>
