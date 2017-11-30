<h1>Edit Employee (<?php echo $employeeInfo['firstName'] . ' ' . $employeeInfo['lastName']?>)</h1>
<hr>

<form class="form" action="" method="POST">
    <div class="form-group">
        <label class="control-label" for="role">Role:</label>
        <?php foreach ($roles as $role) : ?>
            <div class="radio">
                <?php if ($role['roleID'] == $organizationEmployee['roleID']) : ?>
                    <label><input type="radio" name="role" value="<?php echo $role['roleID'] ?>" checked><?php echo $role['role'] ?></label>
                <?php else : ?>
                    <label><input type="radio" name="role" value="<?php echo $role['roleID'] ?>"><?php echo $role['role'] ?></label>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
            <label class="control-label" for="role">Manager:</label>
            <?php foreach ($managers as $manager) : ?>
                <div class="checkbox">
                    <?php if (in_array($manager['EOID'], $employeeManagers)) : ?>
                    <label><input type="checkbox" name="managers[]" value="<?php echo $manager['EOID'] ?>" checked><?php echo $manager['firstName'] . ' ' . $manager['lastName'] ?></label>
                    <?php else : ?>
                    <label><input type="checkbox" name="managers[]" value="<?php echo $manager['EOID'] ?>"><?php  echo $manager['firstName'] . ' ' . $manager['lastName'] ?></label>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            </select>
    </div>
    <input type="hidden" name="employeeID" value="<?php echo $employee->employeeID; ?>">
    <input type="hidden" name="EOID" value="<?php echo $organizationEmployee['EOID']; ?>">
    <div class="text-right">
        <a href="employee.php" style="padding-right: 15px;">Cancel</a>
        <input type="submit" class="btn btn-success">
    </div>
</form>