<div class="col-md-6">
    <div class="media">
        <div class="media-left">
            <img src="https://www.w3schools.com/bootstrap/img_avatar3.png" class="media-object" style="width:60px">
        </div>
        <div class="media-body">
            <h4 class="media-heading"><?php echo $employee->firstName . ' ' . $employee->lastName ?> <a data-toggle="tooltip" title="EDIT" href="settings.php?setting=Profile&action=editEmployee&username=<?php echo $employee->username; ?>" class="text-info h4"><i class="fa fa-pencil" aria-hidden="true"></i></a></h4>
            <p>
                <?php echo $employee->email ?> <br />
                859 - 867 - 5309 <br />
                <?php echo $employee->role ?> <br />
            </p>

            <div>
                <!--Linkedin-->
                <a class="btn btn-li"><i class="fa fa-linkedin left"></i></a>
                <!--Stack Overflow-->
                <a class="btn btn-so"><i class="fa fa-stack-overflow left"></i></a>
                <!--Slack-->
                <a class="btn btn-slack"><i class="fa fa-slack left"></i></a>
                <!--Github-->
                <a class="btn btn-git"><i class="fa fa-github left"></i></a>
            </div>

            <br />

        </div>
    </div>
</div>

<div class="col-md-6 skills">
    <h3>Skills</h3>
    <div>
    <?php foreach($skills as $skill) : ?>
        <span class="skill"><a><?php echo $skill['skill']?></a></span>
    <?php endforeach;?>
    </div>
</div>