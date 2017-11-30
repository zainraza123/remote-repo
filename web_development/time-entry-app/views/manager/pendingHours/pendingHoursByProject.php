<div class="panel-group" id="byProjectAccordion">
    <?php foreach ($pendingHoursByProject as $projectID => $project) : ?>
        <div class="panel panel-default">
            <div class="panel-heading" data-toggle="collapse" data-parent="#byProjectAccordion" data-target="#<?php echo $projectID ?>Panel">
                <h4 class="panel-title">
                    <a class="accordion-toggle"><?php echo $project['projectName'] ?></a>
                </h4>
            </div>
            <div id="<?php echo $projectID ?>Panel" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="project-circles" style="text-align: center; padding-bottom: 20px;">
                        <div class="project-circle alert alert-<?php echo getProjectDanger($project['currentlyApproved'], $project['projectCap']) ?>" style="display: inline-block; width: 175px; text-align: center;">
                            <p style="font-weight: bold">Current Total</p>
                            <p>$<?php echo number_format($project['currentlyApproved'], 2, '.', ','); ?></p>
                        </div>
                        <div class="project-circle alert alert-<?php echo getProjectDanger($project['estimatedTotal'], $project['projectCap']) ?>" style="display: inline-block; width: 175px; text-align: center;">
                            <p style="font-weight: bold">Estimated Total</p>
                            <p>$<?php echo number_format($project['estimatedTotal'], 2, '.', ','); ?></p>
                        </div>
                        <div class="project-circle alert alert-<?php echo getProjectDanger($project['currentlyApproved'], $project['projectCap']) ?>" style="display: inline-block; width: 175px; text-align: center;">
                            <p style="font-weight: bold">Project Cap</p>
                            <p>$<?php echo number_format($project['projectCap'], 2, '.', ','); ?></p>
                        </div>
                        <div class="project-circle alert alert-<?php echo getInvoiceDanger($project['pastDue']) ?>" style="display: inline-block; width: 175px; text-align: center;">
                            <p style="font-weight: bold">Days Past Due</p>
                            <p><?php echo number_format($project['pastDue'], 0); ?></p>
                        </div>
                        <div class="disclaimer">* Totals listed above exclude fees, purchases and other cost exceptions</div>
                        <div class="project-note"><?php echo $project['notes'] ?></div>
                    </div>
                    
                    <table class="table"> 
                        <thead> 
                            <tr> 
                                <th>Employee</th>
                                <th>Week</th> 
                                <th>Hours</th> 
                                <th><!--edit time--></th>
                            </tr> 
                        </thead> 
                        <tbody>
                            <?php foreach ($project['hours'] as $pendingHours) : ?>
                                <tr>
                                    <td><?php echo $pendingHours['employeeName'] ?></td>
                                    <td><?php echo date_formatter($pendingHours['startDay'], 'F j, Y') . ' - ' . date_formatter($pendingHours['endDay'], 'F j, Y') ?></td> 
                                    <td><?php echo $pendingHours['projectHours'] ?></td>
                                    <td><a href="managerOverride.php?EOID=<?php echo $pendingHours['EOID'] ?>&weekID=<?php echo $pendingHours['weekID'] ?>"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a></td> 
                                </tr> 
                            <?php endforeach; ?>
                        </tbody> 
                    </table>
                    
                    <a data-project="<?php echo $projectID ?>" class="approveProject btn btn-success pull-right"> Approve </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
    //Approval By Project
    $(document).ready(function() {
        $(".approveProject").click(function () {
            project = $(this).attr('data-project');
            panel = $(this).closest('.panel');
            $(panel).remove();
            
            url = 'pendingHours.php?action=approve&project=' + project;
            $.get(url, function (data) {
                //alert(data);
            });
        });
    });
</script>