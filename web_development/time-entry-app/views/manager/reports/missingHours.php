<h1>Missing Hours</h1>
<hr />

<table class="report-table table table-striped">
    <thead>
        <tr>
            <th>Employee #</th>
            <th>Name</th>
            <th>E-Mail</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($missingTimes as $missingTime) : ?>
        <tr>
            <td>
                <?php echo $missingTime['employeeID'] ?>
            </td>
            <td>
                <?php echo $missingTime['firstName'] ?> <?php echo $missingTime['lastName'] ?>
            </td>
            <td>
                <?php echo $missingTime['email'] ?> 
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="row table-footer">
    <div class="col-md-6 report-export">
        <p>
            <strong>Export Options:</strong>
        </p>
    </div>
</div>