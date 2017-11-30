<?php
include('../../../config.php');

//getting current list of available projects and their names and ids
$sql = file_get_contents('../../../sql/getAllProjects.sql');
$params = array(
    'organizationID' => $employee->organizationID
);
$projects = $database->query($sql, $params);

$sql = file_get_contents('../../../sql/getRecentProjects.sql');
$params = array(
    'EOID' => $employee->EOID
);
$recentProjects = $database->query($sql, $params);
?>

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