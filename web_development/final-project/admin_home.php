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

if (isset($_GET['itemID']) && !empty($_GET['itemID'])) {
    $_SESSION['itemID'] = $_GET['itemID'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        if (isset($key) && empty($value)) {
            $err[] = ucwords(str_replace("_", " ", $key)) . ' is required.';
        }
    }

    if (!isset($_SESSION['itemID']) && empty($_SESSION['itemID'])) {
        $target_dir = "./img/uploads/";
        $temp = explode(".", $_FILES["item_image"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $target_file = $target_dir . $newfilename;

        if (!move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file)) {
            $err[] = "Sorry, there was an error uploading your file.";
        }

        if (!isset($err)) {
            $_POST['item_image'] = $newfilename;
            $user_home->saveItem($_POST);
            $save_msg = 'New Item Saved.';
        }
    } else {
        $user_home->editItem($_POST, $_SESSION['itemID']);
        $save_msg = 'Item Saved.';
        unset($_SESSION['itemID']);
        $user_home->redirect('menu.php');
    }

}

if (isset($_SESSION['itemID']) && !empty($_SESSION['itemID'])) {
    $item = $user_home->getItem($_GET['itemID']);
}

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
        <?php if (isset($_GET['itemID'])):?>
            <h3>Edit Menu Item</h3>
        <?php else:?>
            <h3>Add New Item to Menu</h3>
        <?php endif;?>

        <?php if (isset($err) && !empty($err)):?>
            <?php foreach ($err as $msg):?>
                <span style="font-weight: bold; color: red">**** <?php echo $msg;?></span><br>
            <?php endforeach;?>
        <?php endif; unset($err);?>

        <?php if (isset($save_msg) && !empty($save_msg)):?>
            <span style="font-weight: bold; color: green">**** <?php echo $save_msg;?></span><br>
        <?php endif;?>

        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group col-lg-4">
                    <label class="text-heading">* Item Name</label>
                    <input value="<?php if (isset($item)) {echo $item['itemName'];} elseif (isset($_POST) && !empty($_POST)) {}?>" name="item_name" type="text" class="form-control" required>
                </div>
                <div class="form-group col-lg-4">
                    <label class="text-heading">* Item Category</label>
                    <select name="item_category" class="form-control">
                        <?php foreach ($categories as $category):  ?>
                            <option value="<?php echo $category['itemCategoryID']?>" <?php if (isset($item)) {if ($item['itemCategoryID'] == $category['itemCategoryID']) {echo 'selected';}} elseif(isset($_POST) && !empty($_POST)) {if ($category['itemCategoryID'] == $_POST['item_category']) {echo 'selected';}}?>><?php echo $category['itemCategoryName'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group col-lg-4">
                    <label class="text-heading">* Item Price</label>
                    <input value="<?php if (isset($item)) {echo $item['itemPrice'];} elseif (isset($_POST) && !empty($_POST)) {}?>" name="item_price" type="tel" class="form-control" required>
                </div>
                <div class="clearfix"></div>
                <?php if (!isset($_GET['itemID'])):?>
                    <div class="form-group col-lg-12">
                        <label class="text-heading">* Select Item Image to Upload</label>
                        <input type="file" name="item_image" id="fileToUpload" required>
                    </div>
                <?php endif;?>
                <div class="form-group col-lg-12">
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require './assets/foot.php';?>
