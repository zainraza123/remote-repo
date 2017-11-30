<h1>Schedules</h1>
<hr />
    
<div class="accordion panel-group" id="accordion">
    <?php foreach ($schedules as $schedule) :?>
        <div class="panel panel-default" id="<?php echo $schedule['employeeID'] ?>Section">
            <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#<?php echo $schedule['employeeID'] ?>Panel">
                <span><?php echo $schedule['employeeName'] ?></span>
            </div>
            <div id="<?php echo $schedule['employeeID'] ?>Panel" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php foreach ($schedule['schedule'] as $day => $shifts) : ?>
                        <strong><?php echo $day ?>: </strong>
                        <?php foreach ($shifts as $shift) : ?>
                            <?php echo $shift['startTime'] . ' - ' . $shift['endTime'] ?>;
                        <?php endforeach; ?>
                        <br />
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<a onclick="showAllAccordion()">View All</a> / 
<a onclick="hideAllAccordion()">Hide All</a>

