<?php


session_start();
require_once './includes/class.user.php';
$user_home = new USER();

if ((isset($_GET['itemID']) && !empty($_GET['itemID']) && (!isset($_GET['removeItem']) && $_GET['removeItem'] != 'true'))) {
    $_SESSION['cart'][] = $_GET['itemID'];
    $user_home->redirect('menu.php');
}

if ((isset($_GET['itemID']) && !empty($_GET['itemID'])) && (isset($_GET['removeItem']) && $_GET['removeItem'] == 'true')) {
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($_GET['itemID'] == $item) {
            unset($_SESSION['cart'][$key]);
        }
    }
}


require './assets/head.php';
?>

<div class="container">
    <div class="bg-faded p-4 my-4">
        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):?>
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <?php $cartItem = $user_home->getItem($item);?>
                <p><?php echo $cartItem['itemName']?>..........<strong>$<?php echo $cartItem['itemPrice']?> </strong> <span class="btn-group-sm"><a class="btn btn-secondary" href="cart.php?itemID=<?php echo $item?>&removeItem=true" >Remove Item</a></span></p>
            <?php endforeach; ?>
        <?php else:?>
            <p>Your Cart is empty</p>
        <?php endif;?>
    </div>

    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):?>
        <div class="bg-faded p-4 my-4">
            <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $cartItem = $user_home->getItem($item);
                    $total = $total + $cartItem['itemPrice'];
                    $_SESSION['total'] = $total;
                }
            ?>
            <strong>Total: $<?php echo $_SESSION['total'];?></strong>
            <a class="btn btn-primary" href="checkout.php">Checkout</a>
        </div>
    <?php endif;?>
</div>

<?php require './assets/foot.php';?>
