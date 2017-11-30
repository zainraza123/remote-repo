<h1>Clients</h1>
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
            <th>ID</th>
            <th>Company</th>
            <th class="noSort"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $client) : ?>
        <tr>
            <td>
                <?php echo $client['research_agreement']; ?>
            </td>
            <td>
                <?php echo $client['companyName']; ?>
            </td>
            <td>
                <a data-toggle="tooltip" title="EDIT" href="client.php?action=edit&RAID=<?php echo $client['RAID']; ?>" class="text-info h4"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            </td>
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

    <div class="col-md-6">
        <a href="client.php?action=add" class="btn btn-success pull-right">+ Add Client</a>  
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
    
});
</script>
