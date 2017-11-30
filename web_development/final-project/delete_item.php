<?php


session_start();
require_once './includes/class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
    $user_home->redirect('index.php');
}

if (!$user_home->isAdmin()) {
    $user_home->redirect('home.php');
}

if (!isset($_GET['itemID']) || empty($_GET['itemID'])) {
    $user_home->redirect('menu.php');
}

if ((isset($_GET['itemID']) && !empty($_GET['itemID'])) && (isset($_GET['delete']) && $_GET['delete'] == "true")) {
    $user_home->deleteItem($_GET['itemID']);
    $user_home->redirect('menu.php');
}

$item = $user_home->getItem($_GET['itemID']);

$stmt = $user_home->runQuery(file_get_contents("sql/getUserID"));
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$categories = $user_home->getItemCategory();

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
        <h3>Are Sure?</h3>
        <p>Are you sure, you want to delete item, <span style="font-weight: bold"><?php echo $item['itemName']?></span></p>
        <a class="btn btn-danger" href="delete_item.php?itemID=<?php echo $_GET['itemID']?>&delete=true">Yes</a>
        <a class="btn btn-primary" href="menu.php">No</a>
    </div>
</div>

<?php require './assets/foot.php';?>
