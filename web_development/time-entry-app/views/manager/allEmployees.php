<h1>Employees</h1>
<hr />

<div id="messageCenter" class="fade in">
    <?php foreach (getMessages() as $message) : ?>
        <div class="alert alert-<?php echo $message['type'] ?> alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $message['message']; ?>
        </div>
    <?php endforeach; ?>
</div> 
    
<table class="report-table table table-striped">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th class="noSort"></th>
            <th class="noSort"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employees as $employee) : ?>
        <tr>
            <td> 
                <?php echo $employee['firstName']; ?>
            </td>
            <td>
                <?php echo $employee['lastName']; ?>
            </td>
            <td>
                <?php echo $employee['email']; ?>
            </td>
            <td>
                <?php echo $employee['role']; ?>
            </td>
            <td>
                <a data-toggle="tooltip" title="EDIT" href="employee.php?action=editEmployee&EOID=<?php echo $employee['EOID']; ?> ?>" class="text-info h4"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            </td>
            <td> 
                <?php if ($employee['isActive'] == 0) : ?>
                    <a data-toggle="tooltip" title="ACTIVATE" href="employee.php?action=activateEmployee&EOID=<?php echo $employee['EOID']; ?>" class="text-danger h4"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                <?php else : ?>
                    <a data-toggle="tooltip" title="DEACTIVATE" href="employee.php?action=deactivateEmployee&EOID=<?php echo $employee['EOID']; ?>" class="text-primary h4"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br />

<form class="form-inline" method="post" action="employee.php?action=addNewEmployee">
    <div class="form-group">
        <input type="text" class="form-control" id="username" name="username" placeholder="NKU Username" value="" required>
    </div>
    <div class="form-group">
        <input type="number" class="form-control" name="employeeID" value="" placeholder="NKU Employee ID #" required>
    </div>
    <input type="submit" class="btn btn-success" value="+ New Employee"><br><br>
</form>

<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
    
});
</script>
