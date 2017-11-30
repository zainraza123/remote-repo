<h1 style="text-align: left;">Settings</h1>
<hr />

<?php $options = array('Profile', 'Schedule') ?>
<ul class="nav nav-tabs" id="settings-tabs">
    <?php foreach($options as $option) : ?>
        <?php if($option == $setting) : ?>
            <li role="presentation" class="active"><a href="<?php $_SERVER['PHP_SELF'] ?>?setting=<?php echo $option ?>"><?php echo $option ?></a></li>
        <?php else : ?>
            <li role="presentation"><a href="<?php $_SERVER['PHP_SELF'] ?>?setting=<?php echo $option ?>"><?php echo $option ?></a></li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>