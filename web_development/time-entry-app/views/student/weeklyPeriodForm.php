<script src="<?php echo TEMPLATE_BASE ?>js/weeklyPeriod.js"></script>
<link href="<?php echo TEMPLATE_BASE ?>css/weeklyPeriod.css" rel="stylesheet">

<div class="content">
    <?php if ($formSuccess) : ?>
        <div id="message" class="alert alert-success">
            <strong>Success!</strong> Your time entry was saved.
        </div>
    <?php else : ?>
        <div id="message" class="alert alert-danger" style="display: none;">
            
        </div>
    <?php endif; ?>
    
    <?php if (!$inCurrentWeek) : ?>
        <div class="row text-center">
            <a href="index.php">Back to Current Week</a>
        </div>
    <?php endif; ?>
    <h1><span style="float:left;" class="arrow"><a href="<?php echo $_SERVER['PHP_SELF'] . '?date_passed=' . $previousWeekTimestamp ?>">&#8592;</a></span>
            <span id="beginWeek"><?php echo $sundayDate->format('F j, Y') ?></span> - <span id="endWeek"><?php echo $saturdayDate->format('F j, Y') ?></span>
            <?php if (!$inCurrentWeek) : ?>
                <span style="float:right;" class="arrow"><a href="<?php echo $_SERVER['PHP_SELF'] . '?date_passed=' . $nextWeekTimestamp ?>">&#8594;</a></span>
            <?php endif; ?>
    </h1>
    <form method="post" id="timeEntryForm" onsubmit="return validateTimeEntry()">
        <div class="accordion panel-group" id="accordion">
            <?php foreach ($daysArray as $day) : $isHoliday = false; ?>
            <div class="panel panel-default" id="<?php echo $day ?>Section">
                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#<?php echo $day ?>Panel">
                    <span id="<?php echo $day ?>Date">
                        <span><?php echo $scheduleDate->format('l, F j') ?></span>
                        <?php if(in_array($scheduleDate->format('Y-m-d'), $holidays_dates)): $isHoliday = true; // if a holiday ?>
                            <i class="fa fa-exclamation-triangle holiday-warning" aria-hidden="true" data-toggle="tooltip" data-original-title="Holiday!"></i>
                        <?php endif; ?>
                    </span>
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
                            <?php if ( isset($scheduleByDay[$day])) : ?>
                                <?php foreach ($scheduleByDay[$day] as $scheduleRow) : ?>
                                    <?php if($isDefaultSchedule && $isHoliday) : ?>
                                        <?php break; ?>
                                    <?php endif; ?>

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
                                        <td class="deleteTimeEntry"><i class="fa fa-times" aria-hidden="true"></i></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </table>
                        <h3><a class="add<?php echo ucfirst($day) ?> addNewTime btn btn-primary"> + New Time Record </a></h3>
                     </div>
                </div>
            </div>
            <?php $scheduleDate->modify('+1 day') ?>
            <?php endforeach; ?>
        </div>
        
        <div id="toggleWeek"><a onclick="toggleWeekend()">Show / Hide Weekend Shifts</a></div>

        <h2 id="weeklyProjectHoursText"> Weekly Project Hours </h2>
        <table class="project" id="project">
            <?php if (!empty($previousProjectHours)) : ?>
                <?php foreach ($previousProjectHours as $previousProject) :
                    $disabled = $previousProject['approvalStatus'] == 1 ? 'disabled' : '' ?>
                    <tr class="weeklyProjects" id="weeklyProjects">
                        <td style="width: 500px; text-align: left;">
                            <select <?php echo $disabled ?> name="project[]" style="width: 500px;" class="projectName form-control" required>
                                <option value='' disabled selected hidden>-- Select A Project --</option>
                                <optgroup label="Recent Projects">
                                <?php foreach ($recentProjects as $recentProject) : ?>
                                    <option value="<?php echo $recentProject['projectID'] ?>"><?php echo $recentProject['projectName'] ?></option>
                                <?php endforeach; ?>
                                </optgroup>
                                <optgroup label="All Projects">
                                <?php foreach ($projects as $project) : ?>
                                    <?php if ($project['projectID'] == $previousProject['projectID']) : ?>
                                        <option selected value="<?php echo $project['projectID'] ?>"><?php echo $project['projectName'] ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo $project['projectID'] ?>"><?php echo $project['projectName'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </td>
                        <td> <input <?php echo $disabled ?> type="number" min="0.25" max="35" step="0.25" name="projectHours[]" class="projectHoursEntry form-control" onchange="updateTotalHoursRemaining()" style="width: 100px;" value="<?php echo $previousProject['projectHours'] ?>"> </td>
                        <?php if (!$disabled) : // if not approved ?>
                            <td style="border: none;"> <a class="deleteProject"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr class="weeklyProjects" id="weeklyProjects">
                    <td style="width: 500px; text-align: left;">
                        <select name="project[]" style="width: 500px;" class="projectName form-control" required>
                            <option value='' disabled selected hidden>-- Select A Project --</option>
                            <optgroup label="Recent Projects">
                            <?php foreach ($recentProjects as $recentProject) : ?>
                                <option value="<?php echo $recentProject['projectID'] ?>"><?php echo $recentProject['projectName'] ?></option>
                            <?php endforeach; ?>
                            </optgroup>
                            <optgroup label="All Projects">
                            <?php foreach ($projects as $project) : ?>
                                <option value="<?php echo $project['projectID'] ?>"><?php echo $project['projectName'] ?></option>
                            <?php endforeach; ?>
                            </optgroup>
                        </select>
                    </td>
                    <td> <input type="number" min="0.25" max="35" step="0.25" name="projectHours[]" class="projectHoursEntry form-control" value="0" onchange="updateTotalHoursRemaining()" onkeypress="return isNumber(event)" style="width: 100px;"> </td>
                    <td style="border: none;"> <a class="deleteProject"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                </tr>
            <?php endif; ?>
        </table>
        <div class="row">
            <div class="col-md-12">
                <a class="addProject btn btn-primary" id="addProject"> + New Project Hours </a>
            </div>
        </div>
        <div class="row" id="timeEntryFooter">
            <div class="col-md-6">
                <p id="totalRemainingHoursText">
                    Total Remaining Hours: <span id="remainingHours"></span>
                </p>
                <p id="totalHoursText">
                    Total Hours: <span id="totalHours"></span>
                </p>
                <input type="hidden" id="employeeType" name="employeeType" value="<?php echo $employee->role ?>" />
            </div>
            <div class="col-md-6">
                <input class="btn btn-success pull-right" type="submit" id="save" value="Save">
            </div>
        </div>
    </form>
</div>
