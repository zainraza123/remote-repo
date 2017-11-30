<h1 style="text-align: left;">Change Organization</h1>
<form class="form" action="" method="POST">
<div class="form-group">
    <?php foreach ($organizations as $organization) : ?>
        <div class="radio">
            <?php if ($organization['organizationID'] == $employee->organizationID) : ?>
                <label>
                    <input type="radio" name="organization" value="<?php echo $organization['organizationID'] ?>" checked><?php echo $organization['organizationName'] ?>
                </label>
            <?php else : ?>
                <label>
                    <input type="radio" name="organization" value="<?php echo $organization['organizationID'] ?>"><?php echo $organization['organizationName'] ?>
                </label>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
<div class="text-left">
    <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" style="padding-right: 15px;">Cancel</a>
    <input type="submit" class="btn btn-success" value="Update Organization">
</div>
</form