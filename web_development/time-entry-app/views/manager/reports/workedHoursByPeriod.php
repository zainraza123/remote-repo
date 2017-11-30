<h1>Worked Hours By Period</h1>
<hr />
    
<div class="accordion panel-group" id="accordion">
    <?php foreach ($workedTimes as $workedTime) : ?>
        <div class="panel panel-default" id="<?php echo $workedTime['employeeID'] ?>Section">
            <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#<?php echo $workedTime['employeeID'] ?>Panel">
                <span><?php echo $workedTime['employeeName'] ?></span>
            </div>
            <div id="<?php echo $workedTime['employeeID'] ?>Panel" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php foreach ($workedTime['shifts'] as $week) : ?>
                        <?php
                            $beginWeek = new DateTime($week['startDate']);
                            $endWeek = new DateTime($week['endDate']);
                        ?>
                        <strong><?php echo $beginWeek->format('F j, Y') ?> - <?php echo $endWeek->format('F j, Y') ?></strong><br />
                    
                        <?php foreach ($week['days'] as $day => $shifts) : ?>
                            <strong><?php echo $day ?>: </strong>
                            
                            <?php foreach ($shifts as $shift) : ?>
                                <?php echo $shift['startTime'] . ' - ' . $shift['endTime'] ?>;
                            <?php endforeach; ?>
                            <br />
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

