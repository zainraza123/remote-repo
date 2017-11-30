<form class="form-horizontal" action="" method="POST">
    <div class="form-group">
        <label class="control-label col-sm-2" for="firstName">First Name:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Ex. John" value="<?php echo $employee->firstName; ?>" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="lastName">Last Name:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Ex. Doe" value="<?php echo $employee->lastName; ?>" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="username">NKU Username:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="username" name="username" placeholder="Ex. doej1" value="<?php echo $employee->username; ?>" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">NKU Email:</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Ex. doej1@nku.edu" value="<?php echo $employee->email; ?>" required>
        </div>
    </div>
    <input type="hidden" name="employeeID" value="<?php echo $employee->employeeID; ?>">
    <div class="text-right">
        <a href="settings.php?setting=Profile" style="padding-right: 15px;">Cancel</a>
        <input type="submit" class="btn btn-success">
    </div>
</form>