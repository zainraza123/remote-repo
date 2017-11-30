<?php


session_start();
require_once './includes/class.user.php';
$user_home = new USER();
$items = $user_home->getAllItems();

if ($_SERVER['REQUEST_METHOD'] == "GET" && (isset($_GET['search-term']) && !empty($_GET['search-term']))) {
    $products = $user_home->searchProducts($_GET['search-term']);
}

require './assets/head.php';
?>



<div class="container">


    <div class="bg-faded p-4 my-4">
        <?php if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search-term"])):?>
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-lg-4">
                        <img src="img/uploads/<?php echo $product['itemImgName'];?>" width="100px" height="100px">
                        <p><?php echo $product['itemName'];?> <span>$<?php echo $product['itemPrice'];?></span></p>
                        <p><a href="cart.php?itemID=<?php echo $product['itemID']?>">Add to Cart</a></p>
                        <?php if (isset($_SESSION['userSession']) && $user_home->isAdmin()): ?>
                            <p><a href="admin_home.php?itemID=<?php echo $product['itemID']?>">Edit Item</a></p>
                            <p><a href="delete_item.php?itemID=<?php echo $product['itemID']?>">Delete Item</a></p>
                        <?php endif;?>
                    </div>
                <?php endforeach;?>
            </div>
        <?php else:?>
            <div id="accordion" role="tablist">

                <div class="card">
                    <div class="card-header" role="tab" id="headingOne">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <h3>Coffee</h3>
                            </a>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($items as $item): ?>
                                    <?php if ($item['itemCategoryID'] == 1):?>
                                        <div class="col-lg-4">
                                            <img src="img/uploads/<?php echo $item['itemImgName'];?>" width="100px" height="100px">
                                            <p><?php echo $item['itemName'];?> <span>$<?php echo $item['itemPrice'];?></span></p>
                                            <p><a href="cart.php?itemID=<?php echo $item['itemID']?>">Add to Cart</a></p>
                                            <?php if (isset($_SESSION['userSession']) && $user_home->isAdmin()): ?>
                                                <p><a href="admin_home.php?itemID=<?php echo $item['itemID']?>">Edit Item</a></p>
                                                <p><a href="delete_item.php?itemID=<?php echo $item['itemID']?>">Delete Item</a></p>
                                            <?php endif;?>
                                        </div>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="card">
                    <div class="card-header" role="tab" id="headingTwo">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <h3>Tea</h3>
                            </a>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($items as $item): ?>
                                    <?php if ($item['itemCategoryID'] == 2):?>
                                        <div class="col-lg-4">
                                            <img src="img/uploads/<?php echo $item['itemImgName'];?>" width="100px" height="100px">
                                            <p><?php echo $item['itemName'];?> <span>$<?php echo $item['itemPrice'];?></span></p>
                                            <p><a href="cart.php?itemID=<?php echo $item['itemID']?>">Add to Cart</a></p>
                                            <?php if (isset($_SESSION['userSession']) && $user_home->isAdmin()): ?>
                                                <p><a href="admin_home.php?itemID=<?php echo $item['itemID']?>">Edit Item</a></p>
                                                <p><a href="delete_item.php?itemID=<?php echo $item['itemID']?>">Delete Item</a></p>
                                            <?php endif;?>
                                        </div>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="card">
                    <div class="card-header" role="tab" id="headingThree">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <h3>Soft Drink</h3>
                            </a>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($items as $item): ?>
                                    <?php if ($item['itemCategoryID'] == 3):?>
                                        <div class="col-lg-4">
                                            <img src="img/uploads/<?php echo $item['itemImgName'];?>" width="100px" height="100px">
                                            <p><?php echo $item['itemName'];?> <span>$<?php echo $item['itemPrice'];?></span></p>
                                            <p><a href="cart.php?itemID=<?php echo $item['itemID']?>">Add to Cart</a></p>
                                            <?php if (isset($_SESSION['userSession']) && $user_home->isAdmin()): ?>
                                                <p><a href="admin_home.php?itemID=<?php echo $item['itemID']?>">Edit Item</a></p>
                                                <p><a href="delete_item.php?itemID=<?php echo $item['itemID']?>">Delete Item</a></p>
                                            <?php endif;?>
                                        </div>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header" role="tab" id="headingfour">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                <h3>Sandwiches</h3>
                            </a>
                        </h5>
                    </div>
                    <div id="collapsefour" class="collapse" role="tabpanel" aria-labelledby="headingfour" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($items as $item): ?>
                                    <?php if ($item['itemCategoryID'] == 4):?>
                                        <div class="col-lg-4">
                                            <img src="img/uploads/<?php echo $item['itemImgName'];?>" width="100px" height="100px">
                                            <p><?php echo $item['itemName'];?> <span>$<?php echo $item['itemPrice'];?></span></p>
                                            <p><a href="cart.php?itemID=<?php echo $item['itemID']?>">Add to Cart</a></p>
                                            <?php if (isset($_SESSION['userSession']) && $user_home->isAdmin()): ?>
                                                <p><a href="admin_home.php?itemID=<?php echo $item['itemID']?>">Edit Item</a></p>
                                                <p><a href="delete_item.php?itemID=<?php echo $item['itemID']?>">Delete Item</a></p>
                                            <?php endif;?>
                                        </div>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header" role="tab" id="headingfive">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                    <h3>Bakery</h3>
                                </a>
                            </h5>
                        </div>

                        <div id="collapsefive" class="collapse" role="tabpanel" aria-labelledby="headingfive" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($items as $item): ?>
                                        <?php if ($item['itemCategoryID'] == 5):?>
                                            <div class="col-lg-4">
                                                <img src="img/uploads/<?php echo $item['itemImgName'];?>" width="100px" height="100px">
                                                <p><?php echo $item['itemName'];?> <span>$<?php echo $item['itemPrice'];?></span></p>
                                                <p><a href="cart.php?itemID=<?php echo $item['itemID']?>">Add to Cart</a></p>
                                                <?php if (isset($_SESSION['userSession']) && $user_home->isAdmin()): ?>
                                                    <p><a href="admin_home.php?itemID=<?php echo $item['itemID']?>">Edit Item</a></p>
                                                    <p><a href="delete_item.php?itemID=<?php echo $item['itemID']?>">Delete Item</a></p>
                                                <?php endif;?>
                                            </div>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php endif;?>

    </div>

</div>


<?php require './assets/foot.php';?>
