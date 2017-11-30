<h1>Add New Employee</h1>
<hr />

<form class="form-horizontal" action="employee.php?action=submitNewEmployee" method="POST">
    <div class="form-group">
        <label for="employeeID" class="control-label col-sm-2">Employee ID</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="employeeID" id="employeeID" placeholder="Ex. 12345" pattern="\d*">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="firstName">First Name:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Ex. John" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="lastName">Last Name:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Ex. Doe" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="username">NKU Username:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="username" name="username" placeholder="Ex. doej1" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">NKU Email:</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Ex. doej1@nku.edu" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="password">Temporary Password</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="password" name="password" value="password" disabled>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Role:</label>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="roleID" value="1" checked>Student</label>
            <label class="radio-inline"><input type="radio" name="roleID" value="2">Manager</label>
        </div>
    </div>
    <div class="text-right">
        <a href="employee.php" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>