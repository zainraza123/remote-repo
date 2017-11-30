<?php

include('config.php');

//send student away if navigating here
Employee::checkPrivileges();

//set template
$template = new Template(TEMPLATE_ROOT . 'index.php');
$template->set('page_title', 'Projects');

//Retrieve any and all get variables
$action = get('action');
$id = get('id');

ob_start();

switch ($action) {
    case 'getProject':
        $projectID = get('projectID');

        $sql = get_sql('getProjectDetails');
        $params = array(
            'projectID' => $projectID
        );
        $projects = $database->query($sql, $params);
        $project = $projects[0];

        echo json_encode($project);
        die();
    case 'deactivate':
        $projectID = get('projectID');

        $sql = get_sql('deactivateProject');
        $params = array(
            'projectID' => $projectID
        );
        $projects = $database->executeQuery($sql, $params);

        header('location: project.php');
        die();
        break;
    case 'reactivate':
        $projectID = get('projectID');

        $sql = get_sql('reactivateProject');
        $params = array(
            'projectID' => $projectID
        );
        $projects = $database->executeQuery($sql, $params);

        header('location: project.php');
        die();
        break;
    case 'add':
        $action = 'Add';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $currentDate = new DateTime();
            $currentDateStamp = $currentDate->format('Y-m-d');

            $sql = get_sql('insertProject');
            $params = array(
                'project' => post('project'),
                'projectName'=> post('projectName'),
                'startDate' => $currentDateStamp,
                'endDate' => null,
                'oldestInvoice' => 0,
                'totalInvoice' => 0,
                'projectCap' => post('projectCap'),
                'primaryContactName' => post('primaryContactName'),
                'primaryContactEmail' => post('primaryContactEmail'),
                'APcontactName' => post('APcontactName'),
                'APcontactEmail' => post('APcontactEmail'),
                'rate' => post('rate'),
                'type' => post('type'),
                'RAID' => post('RAID'),
                'pastDue' => 0,
                'isActive' => 1,
                'notes' => $_POST['notes']
            );
            $database->executeQuery($sql, $params);
            setMessage('success', 'You have successfully added the project.');
            header('location: project.php');
            die();
        }

        $sql = get_sql('getClients');
        $params = array(
            'organizationID' => $employee->organizationID
        );
        $clients = $database->query($sql, $params);
        $project = null;
        
        include('views/manager/projectForm.php');
        break;
    case 'edit':
        $projectID = get('projectID');
        $action = 'Edit';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $currentDate = new DateTime();
            $currentDateStamp = $currentDate->format('Y-m-d');

            $sql = get_sql('updateProject');
            $params = array(
                'projectID' => $projectID,
                'project' => post('project'),
                'projectName'=> post('projectName'),
                'startDate' => $currentDateStamp,
                'endDate' => null,
                'oldestInvoice' => 0,
                'totalInvoice' => 0,
                'projectCap' => post('projectCap'),
                'primaryContactName' => post('primaryContactName'),
                'primaryContactEmail' => post('primaryContactEmail'),
                'APcontactName' => post('APcontactName'),
                'APcontactEmail' => post('APcontactEmail'),
                'rate' => post('rate'),
                'type' => post('type'),
                'RAID' => post('RAID'),
                'pastDue' => 0,
                'isActive' => 1,
                'notes' => $_POST['notes']
            );
            $database->executeQuery($sql, $params);
            setMessage('success', 'You have successfully updated the project.');
            header('location: project.php');
            die();
        }

        $sql = get_sql('getClients');
        $params = array(
            'organizationID' => $employee->organizationID
        );
        $clients = $database->query($sql, $params);
        
        $sql = get_sql('getProjectDetails');
        $params = array(
            'projectID' => $projectID
        );
        $projects = $database->query($sql, $params);
        $project = $projects[0];
        $project['project'] = explode('-', $project['project'])[1];
        
        include('views/manager/projectForm.php');
        break;
    default:
        //Get all projects for table
        $sql = get_sql('getProjects');
        $params = array(
            'organizationID' => $employee->organizationID
        );
        $projects = $database->query($sql, $params);
        include('views/manager/allProjects.php');
}

$content = ob_get_clean();
$template->set('content', $content);
echo $template->fetch();
