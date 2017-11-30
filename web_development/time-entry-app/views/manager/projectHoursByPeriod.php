<h1>Project Hours: <?php echo $startDateObject->format('F j, Y') ?> to <?php echo $endDateObject->format('F j, Y') ?></h1>
<hr />

<table class="report-table table table-striped">
    <thead>
        <tr>
            <th>Project ID</th>
            <th>Name</th>
            <th>Hours</th>
            <th>Cost</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($projects as $project) : ?>
            <tr class="<?php echo getProjectDanger($project['currentlyApproved'], $project['projectCap']) ?>">
                <td><?php echo $project['project'] ?></td>
                <td><?php echo $project['projectName'] ?></td>
                <td><?php echo $project['projectHours'] ?></td>
                <td>$<?php echo number_format($project['projectTotal'], 2, '.', ',') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br />
<div class="row table-footer">
    <div class="col-md-6 report-export">
        <p>
            <strong>Export Options:</strong>
        </p>
    </div>
</div>


<!--
<!DOCTYPE html>
<html>
<head>
    <title>Project Hour by period </title>
    
</head>
   
<br/>
<body>
    <div class="accordion" >
        <h3 class="employeeName">
        <span>Employee Name</span></h3>
     
   <div class="panel">
      <center> 
       <table style="border-collapse: separate; border-spacing: 10px !important;" >
             <tr>
            <th style = "padding:30px;width:250px; height:40px;">PROJECT NAME</th>
            <th style = "padding:30px;width:250px; height:40;">PROJECT HOURS WORKED </th>
            </tr>
           
		  <tr>
              <td style = "width:400px; height:40px; border-style: solid; padding: 10px; border-spacing:10px;">
                  <span name="projectName" id="projectName" style="border: none;">Project Name</span></td>
           
              <td style= "width:300px; height:40px; border-style: solid; padding:10px;margin-bottom:10px;"> 
                  <span name = "projectHoursWorked"  id="projectHoursWorked" style="border:none;">Project Hours Worked</span></td>
          </tr>
           
          <tr>
              <td style = "width:400px; height:40px; border-style: solid; padding: 10px;">
                  <span name="projectName" id="projectName" style="border: none;">Project Name</span></td>
           
              <td style= "width:300px; height:40px; border-style: solid; padding: 10px ;">
                  <span name = "projectHoursWorked"  id="projectHoursWorked" style="border:none;">Project Hours Worked</span></td>
          </tr>
		 
           <tr>
              <td style = "width:400px; height:40px; border-style: solid; padding: 10px;">
                  <span name="projectName" id="projectName" style="border: none;">Project Name</span></td>
           
              <td style= "width:300px; height:40px; border-style: solid; padding: 10px ;"> 
                  <span name = "projectHoursWorked"  id="projectHoursWorked" style="border:none;">Project Hours Worked</span></td>
        
           </tr>
           <tr>
			 <td style="padding:10px; background-color: gray; width:300px; color:black;">
                 <a class="approve">Total Number of Hours </a></td>
           
           </tr>
          </table>
        </center>   
    </div>
    <h3 class="employeeName">
        <span>Employee Name</span>
    </h3>
  <div class="panel">
      <center> 
       <table style="border-collapse: separate; border-spacing: 10px !important;" >
             <tr>
            <th style = "padding:30px;width:250px; height:40px;">PROJECT NAME</th>
            <th style = "padding:30px;width:250px; height:40;">PROJECT HOURS WORKED </th>
            </tr>
           
		  <tr>
              <td style = "width:400px; height:40px; border-style: solid; padding: 10px; border-spacing:10px;">
                  <span name="projectName" id="projectName" style="border: none;">Project Name</span></td>
           
              <td style= "width:300px; height:40px; border-style: solid; padding:10px;margin-bottom:10px;"> 
                  <span name = "projectHoursWorked"  id="projectHoursWorked" style="border:none;">Project Hours Worked</span></td>
          </tr>
           
          <tr>
              <td style = "width:400px; height:40px; border-style: solid; padding: 10px;">
                  <span name="projectName" id="projectName" style="border: none;">Project Name</span></td>
           
              <td style= "width:300px; height:40px; border-style: solid; padding: 10px ;">
                  <span name = "projectHoursWorked"  id="projectHoursWorked" style="border:none;">Project Hours Worked</span></td>
          </tr>
		 
           <tr>
              <td style = "width:400px; height:40px; border-style: solid; padding: 10px;">
                  <span name="projectName" id="projectName" style="border: none;">Project Name</span></td>
           
              <td style= "width:300px; height:40px; border-style: solid; padding: 10px ;"> 
                  <span name = "projectHoursWorked"  id="projectHoursWorked" style="border:none;">Project Hours Worked</span></td>
        
           </tr>
           <tr>
			 <td style="padding:10px; background-color: gray; width:300px; color:black;">
                 <a class="approve">Total Number of Hours </a></td>
           
           </tr>
          </table>
        </center>   
    </div>
        <h3 class="employeeName">
        <span>Employee Name</span>
    </h3>
    <div class="panel">
      <center> 
       <table style="border-collapse: separate; border-spacing: 10px !important;" >
             <tr>
            <th style = "padding:30px;width:250px; height:40px;">PROJECT NAME</th>
            <th style = "padding:30px;width:250px; height:40;">PROJECT HOURS WORKED </th>
            </tr>
           
		  <tr>
              <td style = "width:400px; height:40px; border-style: solid; padding: 10px; border-spacing:10px;">
                  <span name="projectName" id="projectName" style="border: none;">Project Name</span></td>
           
              <td style= "width:300px; height:40px; border-style: solid; padding:10px;margin-bottom:10px;"> 
                  <span name = "projectHoursWorked"  id="projectHoursWorked" style="border:none;">Project Hours Worked</span></td>
          </tr>
           
          <tr>
              <td style = "width:400px; height:40px; border-style: solid; padding: 10px;">
                  <span name="projectName" id="projectName" style="border: none;">Project Name</span></td>
           
              <td style= "width:300px; height:40px; border-style: solid; padding: 10px ;">
                  <span name = "projectHoursWorked"  id="projectHoursWorked" style="border:none;">Project Hours Worked</span></td>
          </tr>
		 
           <tr>
              <td style = "width:400px; height:40px; border-style: solid; padding: 10px;">
                  <span name="projectName" id="projectName" style="border: none;">Project Name</span></td>
           
              <td style= "width:300px; height:40px; border-style: solid; padding: 10px ;"> 
                  <span name = "projectHoursWorked"  id="projectHoursWorked" style="border:none;">Project Hours Worked</span></td>
        
           </tr>
           <tr>
			 <td style="padding:10px; background-color: gray; width:300px; color:black;">
                 <a class="approve">Total Number of Hours </a></td>
           
           </tr>
          </table>
        </center>   
    </div>
        <h3 class="employeeName">
        <span>Employee Name</span>
    </h3>
   
    <div class="panel">
      <center> 
       <table style="border-collapse: separate; border-spacing: 10px !important;" >
             <tr>
            <th style = "padding:30px;width:250px; height:40px;">PROJECT NAME</th>
            <th style = "padding:30px;width:250px; height:40;">PROJECT HOURS WORKED </th>
            </tr>
           
		  <tr>
              <td style = "width:400px; height:40px; border-style: solid; padding: 10px; border-spacing:10px;">
                  <span name="projectName" id="projectName" style="border: none;">Project Name</span></td>
           
              <td style= "width:300px; height:40px; border-style: solid; padding:10px;margin-bottom:10px;"> 
                  <span name = "projectHoursWorked"  id="projectHoursWorked" style="border:none;">Project Hours Worked</span></td>
          </tr>
           
          <tr>
              <td style = "width:400px; height:40px; border-style: solid; padding: 10px;">
                  <span name="projectName" id="projectName" style="border: none;">Project Name</span></td>
           
              <td style= "width:300px; height:40px; border-style: solid; padding: 10px ;">
                  <span name = "projectHoursWorked"  id="projectHoursWorked" style="border:none;">Project Hours Worked</span></td>
          </tr>
		 
           <tr>
              <td style = "width:400px; height:40px; border-style: solid; padding: 10px;">
                  <span name="projectName" id="projectName" style="border: none;">Project Name</span></td>
           
              <td style= "width:300px; height:40px; border-style: solid; padding: 10px ;"> 
                  <span name = "projectHoursWorked"  id="projectHoursWorked" style="border:none;">Project Hours Worked</span></td>
        
           </tr>
           <tr>
			 <td style="padding:10px; background-color: gray; width:300px; color:black;">
                 <a class="approve">Total Number of Hours </a></td>
           
           </tr>
          </table>
        </center>   
    </div>
</div>
    
    
   
<script>
    $(document).ready(function () {
        $(".accordion").accordion({
            collapsible: true,
            heightStyle: "content",
            active: false
        });
    });
</script>  
    
    
</body>   
</html>-->
