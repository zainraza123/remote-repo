<?php

include('config.php');

//send student away if navigating here
Employee::checkPrivileges();

//set template
$template = new Template(TEMPLATE_ROOT . 'index.php');
$template->set('page_title', 'Project Hour Override');

//Retrieve any and all get variables
$action = get('action');
$weekID = get('weekID');
$EOID = get('EOID');

ob_start();

$formSuccess = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $projects = isset($_POST['project']) ? $_POST['project'] : array();
    $projectHours = isset($_POST['projectHours']) ? $_POST['projectHours'] : array();

    // Combine two parrallel arrays into one nice one
    $projectHoursByProject = array();
    for ($i = 0; $i < count($projects); $i++) {
        $projectHoursByProject[] = array(
            'projectID' => $projects[$i],
            'hours' => $projectHours[$i]
        );
    }

    // Delete unapproved hours
    $sql = get_sql('deleteProjectHour');
    $params = array(
        'EOID' => $EOID,
        'weekID' => $weekID,
    );
    $database->executeQuery($sql, $params);

    // Insert hour rows for approval
    $sql = get_sql('insertProjectHour');
    $database->prepare($sql);
    foreach ($projectHoursByProject as $project) {
        $params = array(
            'EOID' => $EOID,
            'projectID' => $project['projectID'],
            'projectHours' => $project['hours'],
            'weekID' => $weekID
        );
        $database->queryPrepared($params);
    }

    $addresses = array('howardg3@nku.edu');
    $overrideEmailMessageSubject = "Manager Override occurred";
    $overrideEmailMessage = "Your manager overrided your hours FYI...";
    send_email($overrideEmailMessageSubject, $overrideEmailMessage, $addresses);

    $formSuccess = true;
}

//grab employee info from DB
$sql = get_sql('getOrganizationEmployee');
$params = array(
    'EOID' => $EOID
);
$employees = $database->query($sql, $params);
$overrideEmployee = $employees[0];

//getting current list of available projects and their names and ids
$sql = get_sql('getAllProjects');
$params = array(
    'organizationID' => $employee->organizationID
);
$projects = $database->query($sql, $params);
        
//Get all previously submitted project hours
$sql = get_sql('previouslySubmittedProjectHours');
$params = array(
    // 'EOID' => 54,
    // 'weekID' => 858
    'EOID' => $EOID,
    'weekID' => $weekID
);
$previousProjectHours = $database->query($sql, $params);

$totalProjectHours = 0;
foreach ($previousProjectHours as $projectHours) {
    $totalProjectHours += $projectHours['projectHours'];
}

//getting current week by is
$sql = get_sql('getWeekByID');
$params = array(
    'weekID' => $weekID
);
$weeks = $database->query($sql, $params);
$week = $weeks[0];
$startDay = new DateTime($week['startDay']);
$endDay = new DateTime($week['endDay']);
include('views/manager/managerOverride.php');

$content = ob_get_clean();
$template->set('content', $content);
echo $template->fetch();
