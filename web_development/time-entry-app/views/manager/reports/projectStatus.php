<h1>Project Status</h1>
<hr />

<table class="report-table table table-striped">
    <thead>
        <tr>
            <th>Project ID</th>
            <th>Name</th>
            <th>Budget Spent</th>
            <th>Budget Cap</th>
            <th>Past Due</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projects as $project) : ?>
        <tr class="<?php echo getOverallDanger($project['currentlyApproved'], $project['projectCap'], $project['pastDue']) ?>">
            <td>
                <?php echo $project['project'] ?>
            </td>
            <td>
                <?php echo $project['projectName'] ?>
            </td>
            <td>$
                <?php echo number_format($project['currentlyApproved'], 2, '.', ','); ?>
            </td>
            <td>$
                <?php echo number_format($project['projectCap'], 2, '.', ','); ?>
            </td>
            <td>
                <?php echo $project['pastDue'] ?>
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