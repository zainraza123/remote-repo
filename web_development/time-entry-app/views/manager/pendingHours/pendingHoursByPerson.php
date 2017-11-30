<div class="panel-group" id="byStudentAccordion">
    <?php foreach ($projectHoursByStudent as $employeeID => $employee) : ?>
        <div class="panel panel-default">
            <div class="panel-heading" data-toggle="collapse" data-parent="#byStudentAccordion" data-target="#<?php echo $employeeID ?>Panel">
                <h4 class="panel-title">
                    <a class="accordion-toggle"><?php echo $employee['employeeName'] ?></a>
                </h4>
            </div>
            <div id="<?php echo $employeeID ?>Panel" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table"> 
                        <thead> 
                            <tr> 
                                <th>Project ID</th>
                                <th>Project Name</th>
                                <th>Week</th>
                                <th>Hours</th>
                            </tr> 
                        </thead> 
                        <tbody>
                            <?php foreach ($employee['projects'] as $project) : ?>
                                <tr>
                                    <td><?php echo $project['project'] ?></td>
                                    <td><?php echo $project['projectName'] ?></td> 
                                    <td><?php echo date_formatter($project['startDay'], 'F j, Y') . ' - ' . date_formatter($project['endDay'], 'F j, Y') ?></td>
                                    <td><?php echo $project['projectHours'] ?></td>
                                </tr> 
                            <?php endforeach; ?>
                        </tbody> 
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>