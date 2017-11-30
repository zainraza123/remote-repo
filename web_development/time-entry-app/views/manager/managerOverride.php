<script src="<?php echo TEMPLATE_BASE ?>js/weeklyPeriod.js"></script>
<link href="<?php echo TEMPLATE_BASE ?>css/weeklyPeriod.css" rel="stylesheet">

<?php if ($formSuccess) : ?>
    <div id="message" class="alert alert-success">
        <strong>Success!</strong> Time was successfully overriden. Please ensure communication with the employee has occurred.
    </div>
<?php else : ?>
    <div id="message" class="alert alert-danger" style="display: none;">
        
    </div>
<?php endif; ?>

<h1 style="text-align: left;"><?php echo $overrideEmployee['firstName'] . ' ' . $overrideEmployee['lastName']?></h1>
<p class="header-extra">Weekly Project Hours (<?php echo $startDay->format('d/m/Y') ?> through <?php echo $endDay->format('d/m/Y') ?>)</p>
<hr />

<form method="post" id="managerOverrideForm" onsubmit="return validateManagerOverride()">
    <table class="project" id="project">
        <?php foreach ($previousProjectHours as $previousProject) :
            $disabled = $previousProject['approvalStatus'] == 1 ? 'disabled' : '' ?>
            <tr class="weeklyProjects" id="weeklyProjects">
                <td style="width: 500px; text-align: left;">
                    <select <?php echo $disabled ?> name="project[]" style="width: 500px;" class="projectName form-control" required>
                        <option value='' disabled selected hidden>-- Select A Project --</option>
                        <?php foreach ($projects as $project) : ?>
                            <?php if ($project['projectID'] == $previousProject['projectID']) : ?>
                                <option selected value="<?php echo $project['projectID'] ?>"><?php echo $project['projectName'] ?></option>
                            <?php else : ?>
                                <option value="<?php echo $project['projectID'] ?>"><?php echo $project['projectName'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td> <input <?php echo $disabled ?> type="number" min="0.25" max="35" step="0.25" name="projectHours[]" class="projectHoursEntry form-control" onchange="updateTotalHoursRemaining()" style="width: 100px;" value="<?php echo $previousProject['projectHours'] ?>"> </td>
                <?php if (!$disabled) : // if not approved ?>
                    <td style="border: none;"> <a class="deleteProject"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="row">
        <div class="col-md-12">
            <a class="addProject btn btn-primary" id="addProject"> + New Project Hours </a>
        </div>
    </div>
    <div class="row" id="timeEntryFooter">
        <div class="col-md-6">
            <!--<p id="totalRemainingHoursText">
                Total Remaining Hours: <span id="remainingHours"></span>
            </p>
            <p id="totalHoursText">
                Total Hours: <span id="totalHours"><?php echo $totalProjectHours ?></span>
            </p>-->
            <p id="totalHoursText">
                Total Required Hours: <span id="totalRequiredHours"><?php echo $totalProjectHours ?></span>
            </p>
        </div>
        <div class="col-md-6" style="text-align: right">
            <a href="pendingHours.php" style="padding-right: 20px;">Cancel</a>
            <input class="btn btn-success" type="submit" id="save" value="Save">
        </div>
    </div>
</form>