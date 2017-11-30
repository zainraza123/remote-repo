<h1>Days Past Due</h1>
<hr />

<form method="POST">
<table class="report-table table table-striped">
    <thead>
        <tr>
            <th>ID #</th>
            <th>Project</th>
            <th>Past Due</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projects as $project) : ?>
        <tr class="<?php echo getInvoiceDanger($project['pastDue']) ?>">
            <td>
                <?php echo $project['project'] ?>
            </td>
            <td>
                <?php echo $project['projectName'] ?>
            </td>
            <td>
                <input name="daysPastDue[<?php echo $project['projectID'] ?>][daysPastDue]" class="pastDueEntryBox" type="number" value="<?php echo $project['pastDue'] ?>"  />
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="row table-footer">
    <div class="col-md-6 pull-right">
        <input type="submit" class="btn btn-success pull-right" value="Save" />  
    </div>
</div>

</form>