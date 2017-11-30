<h1>
    <span>CAI Invoice</span> <br />
</h1>
<p class="header-extra">Created on: <?php $now = new DateTime(); echo $now->format('d/m/Y g:i:s A');?></p>

<hr>
<div class="panel-group" id="accordion">
    <?php foreach ($projects as $project => $projectData) : ?>
    <div class="panel panel-default">
            <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#<?php echo $project ?>Panel">
                <h4 class="panel-title">
                    <a class="accordion-toggle"><?php echo $projectData['projectName'] ?></a>
                </h4>
            </div>
    <div id="<?php echo $project ?>Panel" class="panel-collapse collapse">
        <div class="panel-body">
            <?php $first = true; foreach($projectData['payPeriods'] as $payPeriod => $employees) : ?>
            <?php if ($first) $first = false; else ; ?>
                <strong><?php echo $payPeriod ?></strong>
                <br/>
                <table class="table table-striped">
                    <?php foreach($employees as $employeeName => $hours) : ?>
                        <tr>
                            <td style="width:50%;">
                                <?php echo $employeeName ?>
                            </td>
                            <td style="width:50%;">
                                <?php echo $hours ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endforeach;?>
            <p style="text-align : center; font-size : 18px;"><strong>Total Hours: </strong><?php echo $projectData['projectTotalHours'] ?></p>
        </div>
    </div>
    </div>
<?php endforeach; ?>
</div>

<a onclick="showAllAccordion()">View All</a> / 
<a onclick="hideAllAccordion()">Hide All</a>

