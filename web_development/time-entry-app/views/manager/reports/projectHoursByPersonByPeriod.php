<h1>Project Hours: <?php echo $startDateObject->format('F j, Y') ?> to <?php echo $endDateObject->format('F j, Y') ?></h1>
<hr />

<table class="report-table table table-striped">
    <thead>
        <tr>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Project</th>
            <th>Hours</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($workHoursByPeriod as $project) : ?>
            <tr class="<?php echo getProjectDanger($project['currentlyApproved'], $project['projectCap']) ?>">
                <td><?php echo $project['employeeID'] ?></td>
                <td><?php echo $project['employeeName'] ?></td>
                <td><?php echo $project['projectName'] ?></td>
                <td><?php echo $project['projectHours'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br />
<div class="row table-footer">
    <div class="col-md-6 report-export">
        <p>
            <strong>Export Options:</strong>
        </p>
    </div>
</div>
