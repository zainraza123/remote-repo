<h1><?php echo $action ?> Project</h1>
<hr />
<form class="form" action="" method="POST">
    <div class="form-group">
        <label class="control-label" for="RAID">Client:</label>
        <select name="RAID" class="form-control" required>
            <option disabled>Select a project...</option>
            <?php foreach ($clients as $client) : ?>
                <?php if ($client['RAID'] == $project['RAID']) : ?>
                    <option value="<?php echo $client['RAID'] ?>" selected><?php echo $client['research_agreement'] ?> - <?php echo $client['companyName'] ?></option>
                <?php else : ?>
                    <option value="<?php echo $client['RAID'] ?>"><?php echo $client['research_agreement'] ?> - <?php echo $client['companyName'] ?></option>
                <?php endif; ?>
            <?php endforeach; echo $project['RAID'] ?>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="project">Project ID:</label>
        <input type="text" class="form-control" id="project" name="project" placeholder="Ex. 1" value="<?php echo $project['project']; ?>" required>
    </div>
    <div class="form-group">
        <label class="control-label" for="projectName">Name:</label>
        <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Test Project" value="<?php echo $project['projectName']; ?>" required>
    </div>
    <div class="form-group">
        <label class="control-label" for="APcontactEmail">Project Type:</label>
        <?php $choices = array('Time and Materials', 'Fixed Cost'); ?>
        <select name="type" class="form-control" required>
            <?php foreach ($choices as $choice) : ?>
                <?php if ($choice == $project['type']) : ?>
                    <option selected><?php echo $choice ?></option>
                <?php else : ?>
                    <option><?php echo $choice ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="rate">Hourly Rate:</label>
        <input type="decimal" class="form-control" id="rate" name="rate" placeholder="Ex. 30" value="<?php echo $project['rate']; ?>" required>
    </div>
    <div class="form-group">
        <label class="control-label" for="projectCap">Estimate / Project Cap:</label>
        <input type="decimal" class="form-control" id="projectCap" name="projectCap" placeholder="Ex. 50000" value="<?php echo isset($project['projectCap']) ? $project['projectCap'] : 0; ?>">
    </div>
    <div class="form-group">
        <label class="control-label" for="primaryContactName">Primary Contact:</label>
        <input type="text" class="form-control" id="primaryContactName" name="primaryContactName" placeholder="Ex. John Smith" value="<?php echo $project['primaryContactName']; ?>" required>
    </div>
    <div class="form-group">
        <label class="control-label" for="primaryContactEmail">Primary Email:</label>
        <input type="email" class="form-control" id="primaryContactEmail" name="primaryContactEmail" placeholder="Ex. John.Smith@gmail.com" value="<?php echo $project['primaryContactEmail']; ?>" required>
    </div>
    <div class="checkbox">
        <?php $checked = $project['primaryContactName'] == $project['APcontactName'] && $project['primaryContactName'] != '' ? 'checked' : '' ?>
        <label id="sameAPCheck"><input type="checkbox" value="" <?php echo $checked ?>><strong>Primary</strong> and <strong>Accounts Payable</strong> are the same</label>
    </div>
    <div id="APcontact">
        <div class="form-group">
            <label class="control-label" for="APcontactName">Accounts Payable Contact:</label>
            <input type="text" class="form-control" id="APcontactName" name="APcontactName" placeholder="Ex. John Smith" value="<?php echo $project['APcontactName']; ?>" required>
        </div>
        <div class="form-group">
            <label class="control-label" for="APcontactEmail">Accounts Payable Email:</label>
            <input type="email" class="form-control" id="APcontactEmail" name="APcontactEmail" placeholder="Ex. John.Smith@gmail.com" value="<?php echo $project['APcontactEmail']; ?>" required>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label" for="notes">Notes:</label>
        <textarea name="notes" class="editor"><?php echo $project['notes']; ?></textarea>
    </div>
    

    <input type="hidden" name="formType" value="<?php echo $employee->organizationID; ?>">
    <div class="text-right">
        <!--<a href="employee.php" style="padding-right: 15px;">Cancel</a>-->
        <a href="project.php" style="padding-right: 15px;">Cancel</a>
        <input type="submit" class="btn btn-success" value="Submit">
    </div>
</form>

<script type="text/javascript">
$(document).ready(function(){
    $('#sameAPCheck').click(function () {
        handleSameContact();
    });  
});

function handleSameContact() {
    if($("#primaryContactName").val() == "") {
        $('input', '#sameAPCheck').prop('checked', false);
        return;
    }

    if($('input', '#sameAPCheck').is(':checked') && $("#primaryContactName").val() != "" ) {
        $("#APcontactName").val( $("#primaryContactName").val() );
        $("#APcontactEmail").val( $("#primaryContactEmail").val() );
        $("#APcontact").slideUp();
    } else {
        $("#APcontact").slideDown();
    }
}

handleSameContact();
</script>