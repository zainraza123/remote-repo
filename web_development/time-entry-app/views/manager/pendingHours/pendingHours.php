<link href="<?php echo TEMPLATE_BASE ?>css/css-toggle-switch\dist\toggle-switch.css" rel="stylesheet">
<style>
    html {
    overflow-y: scroll;
}
</style>
<script>
    function updateStudents()
    {
        $.get( "pendingHours.php?action=getStudentView", function( data ) 
        {
            $("#byStudent").html(data);
        });
    }
    function updateProjects()
    {
        $.get( "pendingHours.php?action=getProjectView", function( data ) 
        {
            $("#byProject").html(data);
        });
    }
</script>

<h1>Hours Pending Approval</h1>

<hr />

<div style="width: 100%; text-align:center; padding: 0 33%;">
    <h3>Project Hours By</h3>
    <label class="switch-light" onclick="">
    <input type="checkbox" id="viewToggle">
    <span class="alert alert-light" style="cursor:pointer;">
        <span id="project-bubble">Project</span>
        <span id="student-bubble">My Students</span>
        <a style="background-color: #FFC72C; border-radius: 5px; border: 1px solid black;"></a>
    </span>
    </label>
</div>

<hr />
<div class="byProject" id="byProject">
   <script>
       updateProjects();
   </script>
</div>

<div class="byStudent" style="display: none;" id="byStudent">
    <script>
        updateStudents();
    </script>
</div>

<script>
    //For the toggle switch
    $(document).ready(function() 
    {
        $("#viewToggle").change(function() 
        {
            //toggle starts as unchecked
            //unchecked = project
            //checked = student 
            if ($("#viewToggle").is(':checked')) 
            {
                updateStudents();
                $(".byProject").hide();
                $(".byStudent").show();
            } else 
            {
                updateProjects();
                $(".byStudent").hide();
                $(".byProject").show();
            }
        })
    });
</script>