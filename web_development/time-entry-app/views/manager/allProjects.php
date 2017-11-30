<h1>Projects</h1>
<hr />

<div id="messageCenter" class="fade in">
    <?php foreach (getMessages() as $message) : ?>
        <div class="alert alert-<?php echo $message['type'] ?> alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $message['message']; ?>
        </div>
    <?php endforeach; ?>
</div> 

<div class="table-responsive">
<table class="report-table table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th class="noSort"></th>
            <th class="noSort"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projects as $project) : ?>
        <tr data-toggle="modal" data-target="#myModal">
            <td>
                <input type="hidden" class="projectID" value="<?php echo $project['projectID']; ?>" />
                <?php echo $project['project']; ?>
            </td>
            <td>
                <?php echo $project['projectName']; ?>
            </td>
            <td>
                <a data-toggle="tooltip" title="EDIT" href="project.php?action=edit&projectID=<?php echo $project['projectID']; ?>" class="text-info h4"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            </td>
            <td>
                <?php if ($project['isActive']) : ?>
                    <a data-toggle="tooltip" title="DEACTIVATE" href="project.php?action=deactivate&projectID=<?php echo $project['projectID']; ?>" class="text-primary h4"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <?php else : ?>
                    <a data-toggle="tooltip" title="ACTIVATE" href="project.php?action=reactivate&projectID=<?php echo $project['projectID']; ?>" class="text-danger h4" ><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<br />
<div class="row table-footer">
    <div class="col-md-6 report-export">
        <p>
            <strong>Export Options:</strong>
        </p>
    </div>

    <div class="col-md-6">
        <a href="project.php?action=add" class="btn btn-success pull-right">+ Add Project</a>  
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="projectTitle"></h4>
      </div>
      <div class="modal-body">
        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
                <li role="presentation"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">Contact Information</a></li>
                <li role="presentation"><a href="#finance" aria-controls="finance" role="tab" data-toggle="tab">Financials</a></li>
                <li role="presentation"><a href="#note" aria-controls="notes" role="tab" data-toggle="tab">Notes</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="general">
                    <p class="modal-content-heading">Basic Information</p>
                    <table class="table-condensed borderless">
                        <tbody>
                        <tr>
                            <td><strong>ID #:</strong></td>
                            <td id="projectID"></td>
                        </tr>
                        <tr>
                            <td><strong>Project:</strong></td>
                            <td id="projectTitle"></td>
                        </tr>
                        <tr>
                            <td><strong>Company:</strong></td>
                            <td id="client"></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div role="tabpanel" class="tab-pane" id="contact">
                    <p class="modal-content-heading">Primary Contact</p>
                    <table class="table-condensed borderless">
                        <tbody>
                        <tr>
                            <td><strong>Name:</strong></td>
                            <td id="primaryContactName"></td>
                        </tr>
                        <tr>
                            <td><strong>E-Mail:</strong></td>
                            <td id="primaryContactEmail"></td>
                        </tr>
                        </tbody>
                    </table>

                    <p class="modal-content-heading">Accounts Payable</p>
                    <table class="table-condensed borderless">
                        <tbody>
                        <tr>
                            <td><strong>Name:</strong></td>
                            <td id="APcontactName"></td>
                        </tr>
                        <tr>
                            <td><strong>E-Mail:</strong></td>
                            <td id="APcontactEmail"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="finance">
                    <p class="modal-content-heading">Contract Details</p>
                    <table class="table-condensed borderless">
                        <tbody>
                        <tr>
                            <td><strong>Type:</strong></td>
                            <td id="projectType"></td>
                        </tr>
                        <tr>
                            <td><strong>Hourly Rate:</strong></td>
                            <td id="hourlyRate"></td>
                        </tr>
                        <tr>
                            <td><strong>Budget Cap:</strong></td>
                            <td id="budgetCap"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="note">
                    <div id="notes" style="padding-top: 15px;"></div>
                </div>
            </div>

</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    
    $('[data-toggle="tooltip"]').click(function (e) {
        e.stopPropagation();
    });   
    
    $('.report-table tbody tr').click(function () {
        $('#projectModal .nav-tabs a[href="#general"]').tab('show');
        
        projectID = $('.projectID', this).val();
        
        $.get( "project.php", {action: 'getProject', projectID: projectID}, function( project ) {
            
            $('#projectModal #projectTitle').html(project.projectName);
            $('#projectModal #projectID').html(project.project);
            $('#projectModal #client').html(project.companyName);

            $('#projectModal #primaryContactName').html(project.primaryContactName);
            $('#projectModal #primaryContactEmail').html(project.primaryContactEmail);
            $('#projectModal #APcontactName').html(project.APcontactName);
            $('#projectModal #APcontactEmail').html(project.APcontactEmail);

            $('#projectModal #projectType').html(project.type);
            $('#projectModal #hourlyRate').html('$' + project.rate );
            $('#projectModal #budgetCap').html('$' + project.projectCap);

            $('#projectModal #notes').html(project.notes);
        }, 'json');
        
        
        $('#projectModal').modal('show');
    });
});
</script>
