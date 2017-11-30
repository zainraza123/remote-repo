<h1><?php echo $action ?> Client</h1>
<hr />

<form class="form" action="" method="POST">
    <div class="form-group">
        <label class="control-label" for="research_agreement">Client #:</label>
        <input type="text" class="form-control" id="research_agreement" name="research_agreement" placeholder="Ex. 10000" value="<?php echo $client['research_agreement']; ?>" required>
    </div>
    <div class="form-group">
        <label class="control-label" for="companyName">Company Name:</label>
        <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Ex. Test Client" value="<?php echo $client['companyName']; ?>" required>
    </div>
    <input type="hidden" name="RAID" value="<?php echo $RAID; ?>">
    <div class="text-right">
        <!--<a href="employee.php" style="padding-right: 15px;">Cancel</a>-->
        <a href="client.php" style="padding-right: 15px;">Cancel</a>
        <input type="submit" class="btn btn-success">
    </div>
</form>