<script src="<?php echo TEMPLATE_BASE ?>js/weeklyPeriod.js"></script>
<link href="<?php echo TEMPLATE_BASE ?>css/weeklyPeriod.css" rel="stylesheet">

<?php if ($formSuccess) : ?>
    <div id="message" class="alert alert-success">
        <strong>Success!</strong> Your time entry was saved.
    </div>
<?php else : ?>
    <div id="message" class="alert alert-danger" style="display: none;">

    </div>
<?php endif; ?>

<form method="post" id="scheduleForm" onsubmit="return validateSchedule()">
    <div class="accordion panel-group" id="accordion">
        <?php foreach ($daysArray as $day) :?>
        <div class="panel panel-default" id="<?php echo $day ?>Section">
            <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#<?php echo $day ?>Panel">
                <span id="<?php echo $day ?>Date"><?php echo $day ?></span>
            </div>
            <div id="<?php echo $day ?>Panel" class="panel-collapse collapse">
        <div class="panel-body" id="workedSchedulePanel">
            <table data-day="<?php echo $day ?>" class="<?php echo $day ?>" id="<?php echo $day ?>">
                <thead>
                    <tr>
                        <th>Start Shift</th>
                        <th>End Shift</th>
                    </tr>
                </thead>
                <?php if (isset( $scheduleByDay[$day])) : ?>
                    <?php foreach ($scheduleByDay[$day] as $scheduleRow) : ?>
                    <tr onchange="updateTotalHours()">
                        <td style="width: 200px;">
                            <select class="startTime form-control" name="startTime[<?php echo $day ?>][]">
                            <?php foreach ($militaryTimeArray as $hour => $time) : ?>
                                <?php if ($scheduleRow['startTime'] == $time) : ?> 
                                    <option value="<?php echo $hour ?>" selected><?php echo $time ?></option>
                                <?php else : ?>
                                    <option value="<?php echo $hour ?>"><?php echo $time ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        </td>

                        <td style="width: 200px;">
                            <select class="endTime form-control" onchange="validateShift(this)" name="endTime[<?php echo $day ?>][]">
                            <?php foreach ($militaryTimeArray as $hour => $time) : ?>
                                <?php if ($scheduleRow['endTime'] == $time) : ?> 
                                    <option value="<?php echo $hour ?>" selected><?php echo $time ?></option>
                                <?php else : ?>
                                    <option value="<?php echo $hour ?>"><?php echo $time ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        </td>
                        <td class="deleteTimeEntry">&otimes;</td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
            <a class="add<?php echo ucfirst($day) ?> addNewTime btn btn-primary"> + New Time Record </a>
                </div>
                </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div id="toggleWeek"><a onclick="toggleWeekend()">Show / Hide Weekend Shifts</a></div>
    
    <div class="row" id="timeEntryFooter">
        <div class="col-md-6">
            <p id="totalHoursText">
                Total Hours: <span id="totalHours"></span>
            </p>
            <p id="remainingHours" style="display: none;"></p>
        </div>
        <div class="col-md-6">
            <input class="btn btn-success pull-right" type="submit" id="save" value="Save">
        </div>
    </div>
</form>
